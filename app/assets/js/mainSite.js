
$(document).ready(function () {
    console.log("ready!");
});

$(document).on('click', '.add', function () {
    $('.xd-mid-pos').hide();
    add();
});

$(document).on('click', '.product-save', function () {

    var products = {};
    $('.req-products').each(function () {
        products.push($(this).val());
    });
    var myData = {};
    myData["data"] = products;
    myData["mobile"] = $('#mobile').val();
    var url = myUrl + myApiCalls["current_api"] + "add_cart/";
    get_url_response('POST', url, myData, 'set_cart');
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
    if (data["mailId"] == '') {
        message = 'Please Enter E-Mail Id';
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
  }

  function confirm_order(data) {
    $('#menu3').removeClass('in');
    $('#menu3').removeClass('active');
  // success order details
    $('#menu4').addClass('in');
    $('#menu4').addClass('active');
  }
function showAlert(type, message) {
    var msgClass = 'alert-success';
    if (type) {
        message = '<strong>Success!</strong>' + message
    } else {
        msgClass = 'alert-danger';
        message = '<strong>Fail!</strong>' + message
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