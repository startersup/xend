
$(document).on('click', '.modal-close', function () {
    $('#myModal').hide();
});

$(document).on('click', '.order-items-show', function () {
    var inp_id = $(this).attr("inp-id");
    var data = JSON.parse($('#' + inp_id).val());
    var item = {};
    item["id"] = data.id;
    var myData = {};
    myData["data"] = item;
    $('.order-title').attr('order-id', item["id"]);
    $('.order-title').html('Order ID : ' + item["id"]);
    var url = myUrl + myApiCalls["current_api"] + "items/";
    get_url_response('GET', url, myData, 'show_items');
});

function show_items(objData) {
    var items = objData.data;
    var list = '';
    var total = 0.00;
    for (var i = 0; i < items.length; i++) {
        total = total + parseFloat(items[i].price);
        list = list + '<li sno="' + items[i].sno + '" item-status="' + items[i].item_status + '" class="products req-products-li ">' + items[i].item_name + ' <input class="xd-rate-box item-price  xend-numeric" whole="5" decimal="2" value="' + items[i].price + '">';
        if (items[i].item_status == 0) {
            list = list + '<a class="item-cross"> ❌ </a> <a style="display:none" class="item-tick">✔️</a></li>';
        } else {
            list = list + '<a style="display:none" class="item-cross"> ❌ </a> <a  class="item-tick">✔️</a></li>';
        }


    }
    $('.order-item-list').html(list);
    var inp_id = 'input_' + $('.order-title').attr('order-id');
    var data = JSON.parse($('#' + inp_id).val());
    $('#payment_type').val(data.pay_type);
    $('#payment_status').val(data.pay_status);
    $('#order_status').val(data.statusId);
    $('#grand_total').val(total);
    $('#myModal').show();
}

$(document).on('click', '.item-cross', function () {

    $(this).closest(".products").find("input").attr("disabled", true);
    if ($(this).closest(".products").find("input").val() != 'NA') {
        var total = parseFloat($('#grand_total').val()) - parseFloat($(this).closest(".products").find("input").val());
        $('#grand_total').val(total);
    }
    $(this).closest(".products").find(".item-tick").show();
    $(this).hide();
    $(this).closest(".products").find("input").val('NA');
    $(this).closest(".products").attr("item-status", "1");

});

$(document).on('click', '.item-tick', function () {

    $(this).closest(".products").find("input").attr("disabled", false);
    $(this).closest(".products").find("input").val('0');

    $(this).closest(".products").find(".item-cross").show();
    $(this).hide();

    $(this).closest(".products").attr("item-status", "0");


});
$(document).on('blur', '.item-price', function () {

    var val = 0.00;
    var total = 0.00;
    $('.item-price').each(function () {
        if ($(this).val() !== 'NA' && $(this).val() !== '') {
            val = parseFloat($(this).val());
            total = total + val;
        }
    });
    $('#grand_total').val(total);

});

$(document).on('click', '.order-cancel-comments', function () {

    $('#comments').val('');
    $('#comments').show();

});

$(document).on('click', '.order-cancel-close', function () {

    $('#comments').val('');
    $('#comments').hide();

});

$(document).on('click', '.order-cancel', function () {

    var inp_id = 'input_' + $('.order-title').attr('order-id');
    var data = JSON.parse($('#' + inp_id).val());
    var item = {};
    item["id"] = data.id;
    item["type"] = "cancel";
    item["comments"] = $('#comments').val();
    var myData = {};
    myData["data"] = item;
    var url = myUrl + myApiCalls["current_api"] + "order_update/";
    get_url_response('POST', url, myData, 'update_order');
});

$(document).on('click', '.order-update', function () {

    var inp_id = 'input_' + $('.order-title').attr('order-id');
    var data = JSON.parse($('#' + inp_id).val());
    var item = {};
    item["id"] = data.id;
    item["type"] = "update";
    item["comments"] = $('#comments').val();

    var products = [];
    $('.req-products-li').each(function () {
        var temp = {};
        temp["sno"] = $(this).attr('sno');
        if ($(this).attr('item-status') == 0) {
            temp["item_status"] = 0;
            temp["price"] = parseFloat($(this).find("input").val());
        } else {
            temp["item_status"] = 1;
            temp["price"] = parseFloat('0.0');
        }
        products.push(temp);
    });

    var orders = {};
    orders['payment_type'] = $('#payment_type').val();
    orders['payment_status'] = $('#payment_status').val();
    orders['order_status'] = $('#order_status').val();
    orders['total'] = $('#grand_total').val();

    var myData = {};
    myData["data"] = item;
    myData["products"] = products;
    myData["orders"] = orders;
    var url = myUrl + myApiCalls["current_api"] + "order_update/";
    get_url_response('POST', url, myData, 'update_order');
});

function update_order(objData) {
    showAlert(objData.status, objData.msg);
    if (objData.status) {
        var inp_id = 'input_' + $('.order-title').attr('order-id');
        var data = JSON.parse($('#' + inp_id).val());

        data.statusId = $('#order_status').val();
        data.pay_type = $('#payment_type').val();
        data.pay_status = $('#payment_status').val();

        $('#' + inp_id).val(JSON.stringify(data));
        $('#' + inp_id).parent().find("p").html(data.pay_type);
    }
    $('#myModal').hide();
}