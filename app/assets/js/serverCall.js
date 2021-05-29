
function get_url_response(callType, url, data, func) {
  $.ajax({
    type: callType,
    url: url,
    data: data,
    async: false,
    success: function (data) {
      var objData = JSON.parse(data);
      formHandler(objData);
      if (func != '') {
        window[func](objData);
      }
    },
    error: function (xhr) { }
  });

}