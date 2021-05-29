$(document).on('click', '.loginNow', function () {

    var message = '';
    var proceed = true;
    if ($('#userName').val() == "") {
        message = 'UserName cannot be empty..';
        proceed = false;
    }
    if ($('#password').val() == "") {
        message = 'Password cannot be empty..';
        proceed = false;
    }
    if (proceed) {
        var url = myUrl + "/apis/v1/login/";
        var myData = {};
        myData["userName"] = $('#userName').val();
        myData["password"] = $('#password').val();
        var data = {};
        data['data'] = myData;
        get_url_response('POST', url, data, 'loginDone');
    }
    else {
        showAlert(proceed, message);
    }
});

function loginDone(Obj) {
    if (Obj.status) {
        window.location.href = myUrl + "pos/admin/orders/"
    } else {
        showAlert(Obj.status, Obj.msg);
    }

}