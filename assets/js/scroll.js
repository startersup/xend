
$(document).ready(function(){
    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if (scroll > 100) {
          $(".xd-navbar").addClass("xd-navbar-fixed")
        }
  
        else{
            $(".xd-navbar").removeClass("xd-navbar-fixed")
        }
    })
  })


  