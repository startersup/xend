
$(document).ready(function () {
    console.log("ready!");
});

$(document).on('click', '.add', function () {
    $('.xd-mid-pos').hide();
    add();
});

$(document).on('click', '.order-details-proceed', function () {
    var data = {};
    data["address"] = $('#address').val();
    data["payment"] = $('#payment').val();
    data["tempId"] = $('#tempId').val();
    var proceed = true;
    if (data["address"] == '') {
        message = 'Please Enter Address';
        proceed = false;
    }
    if (data["payment"] == '') {
        message = 'Please choose payment type';
        proceed = false;
    }
    if (proceed) {
        var myData = {};
        myData["data"] = data;
        var url = myUrl + myApiCalls["current_api"] + "add_address/";
        get_url_response('POST', url, myData, 'set_address');
    } else {
        showAlert(proceed, message);
        return false;
    }
});
$(document).on('click', '.product-details-proceed', function () {

    var products = [];
    $('.req-products').each(function () {
        var data = {};
        data["product"] = $(this).val();
        products.push(data);
    });
    if (products.length == 0) {
        showAlert(false, 'Please add some products to proceed');
    } else {
        var myData = {};
        myData["data"] = products;
        var url = myUrl + myApiCalls["current_api"] + "add_cart/";
        get_url_response('POST', url, myData, 'set_cart');
    }
});

$(document).on('click', '.pay-check', function () {

    if ($(this).prop('checked')) {
        $('#payment').val($(this).val());
    }

});

$(document).on('click', '.product-details-save', function () {

    var products = [];
    $('.req-products').each(function () {
        var data = {};
        data["product"] = $(this).val();
        products.push(data);
    });
    if (products.length == 0) {
        showAlert(false, 'Please add atleast 1 product to proceed');
    } else {
        var myData = {};
        myData["data"] = products;
        var url = myUrl + myApiCalls["current_api"] + "add_cart/";
        get_url_response('POST', url, myData, 'save_cart');
    }
});

$(document).on('click', '.confirm-order-proceed', function () {

    var products = [];
    $('.req-products-li').each(function () {
        var data = {};
        data["product"] = $(this).attr('val');
        products.push(data);
    });
    if (products.length == 0) {
        showAlert(false, 'Please add some products to proceed');
    } else {
        var myData = {};
        myData["data"] = products;
        var url = myUrl + myApiCalls["current_api"] + "orders/";
        get_url_response('POST', url, myData, 'confirm_order');
    }
});

$(document).on('click', '.product-remove', function () {
    $(this).parent().remove();
});

function add() {
    var new_input = "<div class='xd-add-wrapper'><input type='text' class='form-control xd-form-md-inputs req-products' placeholder='eg: Maida Maavu - 1kg' > <button class='remove xd-remove-pos product-remove' > x </button></div>";
    $('#new_chq').append(new_input);
}
$(document).on('click', '.basic-details-proceed', function () {
    var data = {};
    data["name"] = $('#name').val();
    data["mobile"] = $('#mobile').val();
    data["mailId"] = $('#mailId').val();
    var proceed = true;
    if (data["name"] == '') {
        message = 'Please Enter Name';
        proceed = false;
    }
    if (data["mobile"] == '') {
        message = 'Please Enter Mobile';
        proceed = false;
    }
    if (proceed) {
        var myData = {};
        myData["data"] = data;
        var url = myUrl + myApiCalls["current_api"] + "user_info/";
        get_url_response('POST', url, myData, 'set_user');
    } else {
        showAlert(proceed, message);
        return false;
    }

});

function set_user(data) {
    $('#home').removeClass('in');
    $('#home').removeClass('active');

    $('#menu1').addClass('in');
    $('#menu1').addClass('active');
}

function set_cart(data) {
    $('#menu1').removeClass('in');
    $('#menu1').removeClass('active');

    $('#menu2').addClass('in');
    $('#menu2').addClass('active');
}
function set_address(data) {
    $('#menu2').removeClass('in');
    $('#menu2').removeClass('active');

    $('#menu3').addClass('in');
    $('#menu3').addClass('active');

    var products = data.USER_INFO.product;
    var temp_list = '';
    for (var i = 0; i < products.length; i++) {
        temp_list = temp_list + ' <li class="products req-products-li" val="' + products[i]["product"] + '">' + products[i]["product"] + '<a class=" product-remove "> ❌ </a></li>'
    }
    $('.product-list').html(temp_list);
}

function confirm_order(data) {
    showAlert(data.status, data.msg);
    if (data.status) {
        $('#menu3').removeClass('in');
        $('#menu3').removeClass('active');
        // success order details
        $('#menu4').addClass('in');
        $('#menu4').addClass('active');
        $('#order_id').html('Order Id: ' + data.order_id);
    }
}
function save_cart() {
    showAlert(true, 'Cart saved Successfully');
}
function showAlert(type, message) {
    var msgClass = 'alert-success';
    if (type) {
        message = '<strong></strong>' + message
    } else {
        msgClass = 'alert-danger';
        message = '<strong></strong>' + message
    }

    $('.' + msgClass).html(message);
    $('.' + msgClass).show();

    setTimeout(function () { $('.' + msgClass).hide(); }, 3000);
}
/*
var items = document.querySelectorAll(".products");
for (var index = 0; index < items.length; index++) {
    items[index].addEventListener("click", function() {
        this.classList.toggle("active");
    });
    items[index].querySelector("a").addEventListener("click",
        function() {
            this.closest(".products").remove();
        });
}

*/