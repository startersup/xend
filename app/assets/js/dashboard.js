$(document).on('click', '.order-items-show', function () {
    var inp_id = $(this).attr("inp-id");
    var data = JSON.parse($('#' + inp_id).val());
    var item = {};
    item["id"] = data.id;
    var myData = {};
    myData["data"] = item;
    $('.order-title').attr('order-id', item["id"]);
    $('.order-title').html('input_' + item["id"]);
    var url = myUrl + myApiCalls["current_api"] + "items/";
    get_url_response('GET', url, myData, 'show_items');
});

function show_items(objData) {
    var items = objData.data;
    var list = '';
    for (var i = 0; i < items.length; i++) {
        list = list + '<li sno="' + items[i].sno + '" item-status="' + items[i].item_status + '" class="products">' + items[i].item_name + ' <input class="xd-rate-box item-price" value="' + items[i].price + '">';
        if (items[i].item_status == 0) {
            list = list + '<a class="item-cross"> ❌ </a> <a style="display:none" class="item-tick">✔️</a></li>';
        } else {
            list = list + '<a style="display:none" class="item-cross"> ❌ </a> <a  class="item-tick">✔️</a></li>';
        }


    }
    $('.order-item-list').html(list);
    var inp_id = $('.order-title').attr('order-id');
    var data = JSON.parse($('#' + inp_id).val());
    $('#payment_type').val(data.pay_type);
    $('#payment_status').val(data.pay_status);
    $('#order_status').val(data.statusId);
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

});

$(document).on('click', '.item-tick', function () {

    $(this).closest(".products").find("input").attr("disabled", false);
    $(this).closest(".products").find("input").val('0');

    $(this).closest(".products").find(".item-cross").show();
    $(this).hide();

});
$(document).on('click', '.item-price', function () {

    var val = 0.00;
    if ($(this).val() !== 'NA') {
        val = parseFloat($(this).val());
    }
    var total = val + parseFloat($('#grand_total').val());
    $('#grand_total').val(total);

});

$(document).on('click', '.order-cancel', function () {
    var inp_id = $(this).attr("inp-id");
    var data = JSON.parse($('#' + inp_id).val());
    var item = {};
    item["id"] = data.id;
    item["type"] = "cancel";
    var myData = {};
    myData["data"] = item;
    var url = myUrl + myApiCalls["current_api"] + "orders_update/";
    get_url_response('POST', url, myData, 'update_order');
});

$(document).on('click', '.order-update', function () {
    var inp_id = $(this).attr("inp-id");
    var data = JSON.parse($('#' + inp_id).val());
    var item = {};
    item["id"] = data.id;
    item["type"] = "update";
    var myData = {};
    myData["data"] = item;
    var url = myUrl + myApiCalls["current_api"] + "orders_update/";
    get_url_response('POST', url, myData, 'update_order');
});

function update_order(objData) {
    showAlert(objData.status, objData.msg);
    $('#myModal').hide();
}