$(document).on('keyup', '.xend-numeric', function () {

    var ele = $(this).val();
    var wnum = $(this).attr("whole");
    var dnum = $(this).attr("decimal");
    if (dnum === "0" || dnum === "" || dnum === undefined || dnum === 'undefined') {
      const regex = new RegExp("^\\d{0," + wnum + "}?$");
      if (!regex.test($(this).val())) {
        $(this).val( $(this).val().substring(0, $(this).val().length - 1) );
      }
    } else {
      var regex = new RegExp("^\\d{0," + wnum + "}(\\.\\d{0," + dnum + "})?$");
      if (!regex.test($(this).val())) {
        $(this).val( $(this).val().substring(0, $(this).val().length - 1) );
      }
    }
  });

  function xendnumeric(dnum,wnum,val)
  {
    var status =true;
    if (dnum === "0" || dnum === "" || dnum === undefined || dnum === 'undefined') {
      const regex = new RegExp("^\\d{0," + wnum + "}?$");
      if (!regex.test(val)) {
        status=false;
      }
    } else {
      var regex = new RegExp("^\\d{0," + wnum + "}(\\.\\d{0," + dnum + "})?$");
      if (!regex.test(val)) {
        status=false;
      }
    }
    return status;
  }

  $(document).on('keyup', '.xend-name', function () {
    const regex = /^[a-zA-Z][a-zA-Z\s]*$/;
    if (!regex.test($(this).val())) {
      $(this).val( $(this).val().substring(0, $(this).val().length - 1) );
    }
  });
/*
  $(document).on('blur', '.xend-password', function () {
   
    const regex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    $(this).removeClass("xend-alert-input");
    $(this).next("p").remove();
    if (! xendpassword($(this).val())) {
      $(this).addClass("xend-alert-input");
      $('<p class="xend-alert-label">Password should have one lowerCase,upperCase,special Character and minimum length should be 8</p>').insertAfter($(this));  
    }
  });
  $(document).on('blur', '.xend-mail', function () {
   
    const regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    $(this).removeClass("xend-alert-input");
    $(this).next("p").remove();
    if (! xendmail($(this).val())) {
      $(this).addClass("xend-alert-input");
      $('<p class="xend-alert-label">Enter a valid Email*</p>').insertAfter($(this));  
    }
  });

  $(document).on('blur', '.xend-mobile', function () {
    const regex = /[6-9]{1}[0-9]{9}/;
    $(this).removeClass("xend-alert-input");
    $(this).next("p").remove();
    if (! xendmobile($(this).val())) {
      $(this).addClass("xend-alert-input");
      $('<p class="xend-alert-label">Enter a valid Mobile Number*</p>').insertAfter($(this));
    }
  });
  */
  function xendpassword(val)
  {
      var regex = /^(.*[a-z].*)$/;
      var status= '';
      if (!regex.test(val)) {
        status='Enter Atleast one Lower Case';
      }
      regex = /^(.*[A-Z].*)$/;
      if ( (!regex.test(val)) && status == '') {
        status='Enter Atleast one Upper Case';
      }
      regex = /^(.*\d.*)$/;
      if ( (!regex.test(val)) && status == '') {
        status='Enter Atleast one Number';
      }
      regex = /^(.*[!@#$%^&*].*)$/;
      if ( (!regex.test(val)) && status == '') {
        status='Enter Atleast one Special Character';
      }
      regex = /^.{8,}$/;
      if ( (!regex.test(val)) && status == '') {
        status='Password Length should be atleast 8 ';
      }
      return status;
  }
  function xendname(val)
  {
    const regex = /^[a-zA-Z][a-zA-Z\s]*$/;
    var status= true;
    if (!regex.test(val)) {
      status=false;
    }
    return status;
  }


function xendmail(val)
{
  const regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  var status= true;
  if (!regex.test(val)) {
    status=false;
  }
  return status;
}

function xendmobile (val)
{
  const regex = /[6-9]{1}[0-9]{9}/;
  var status= true;
  if (!regex.test(val)) {
    status=false;
  }
  return status;
}
  function showYesNo(message,eve)
  {
    if(eve.hasClass("re-trigger"))
    {
     return true;
    }else if(!($("#confirmPopup").is(":visible")) ){
      eve.addClass("re-trigger")
      $('#confirmPopupMessage').html(message);
      $('#confirmPopup').show();
      return false;
    }else{
      return false;
    }
  }

  $(document).on('click', '#confirmPopupNo', function () { 
    $('.re-trigger').removeClass('re-trigger'); 
      $('#confirmPopup').hide();
  });
  
 
  $(document).on('click', '#confirmPopupYes', function () { 
  
     $('.re-trigger').trigger("click");
     $('.re-trigger').removeClass('re-trigger');
     $('#confirmPopup').hide();
  });
  function userSignUpEvent(){
    var temp ='<b>Hi! </b>'+$('#signUpUserName').val();
    $('#welcomeId').html(temp);
    $($('#' + 'userSignUp').prop('elements')).each(function () {
            
      $(this).val('');
  
});
    return false;
  }
  function userSignInEvent(){
    var temp ='<b>Hi! </b>'+$('#userName').val();
    $('#welcomeId').html(temp);
    $($('#' + 'userLogin').prop('elements')).each(function () {
            
      $(this).val('');
  
});
    return false;
  }



  