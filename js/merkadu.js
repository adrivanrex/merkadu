// Custom scripts
$(document).ready(function () {
    
    $('#iframeContent').attr('src', 'search.html');
    $("#search").click(function(){
        $('#iframeContent').attr('src', 'search.html');
        $("body").toggleClass("mini-navbar");
            SmoothlyMenu();
    });

    $("#paymentCenter").click(function(){
        $('#iframeContent').attr('src', 'managePayments.html');
    });
    $("#purchased").click(function(){
         $('#iframeContent').attr('src', 'purchased.html');
    });
    $("#addProducts").click(function(){
        $('#iframeContent').attr('src', 'addProducts.html');
    });
    $("#manageOrders").click(function(){
        $('#iframeContent').attr('src', 'manageOrders.html');
    });

    $('#createStore').click(function(){
        $('#iframeContent').attr('src', 'createStore.html');
    });

    $('#trackOrders').click(function(){
    
        $('#iframeContent').attr('src', 'completedOrders.html');
    });

    $('#profile').click(function(){
        $('#iframeContent').attr('src', 'profile.html');
    });

    $('#updatePassword').click(function(){
        lastPassword = $("#lastPassword").val();
        newPassword = $("#newPassword").val();
        verifyNewPassword = $("#verifyNewPassword").val();

        updatePasswordHttp = new XMLHttpRequest();
                //var server = "http://hantakserver/";

                username = localStorage.getItem("username");
                //password = localStorage.getItem("password");
                /**
                if(lastPassword == undefined){
                    alert("please input last password");
                }
                if(newPassword == undefined){
                    alert("please input new password");
                }
                if(verifyNewPassword == undefined   ){
                    alert("please input verify new password");
                }
                **/



                url = 'http://merkaducentral.tk/graph/updatePassword.php?username=' + username + '&password=' + lastPassword + '&newPassword='+newPassword+'&verifyNewPassword='+verifyNewPassword+'';
                updatePasswordHttp.open("GET", url);
                console.log(url);
                updatePasswordHttp.send();

                updatePasswordHttp.onreadystatechange = (e) => {

                    if (updatePasswordHttp.readyState == 4 && updatePasswordHttp.status == 200) {
                        data = JSON.parse(updatePasswordHttp.responseText);
                        console.log("data",data);
                        alert(data.message);
                        if(data.login == 1){
                            document.location.href="login.html";
                        }

                    }


                };

    });

     Http = new XMLHttpRequest();
            //var server = "http://hantakserver/";
    var server = "http://merkaducentral.tk/";
    username = localStorage.getItem("username");
    password = localStorage.getItem("password");
    
    url = '/graph/userinfo.php?username='+username+'&password='+password+'';
    console.log(url);
    Http.open("GET", url);

    Http.send();

    Http.onreadystatechange = (e) => {
        if (Http.readyState == 4 && Http.status == 200) {
            data = JSON.parse(Http.responseText);
           
           if(data.login == 0){
            window.location.href = "login.html";
           }

           console.log(data);
           localStorage.setItem("data", JSON.stringify(data.details));
           fullName = ''+data.details.firstName+' '+data.details.lastName+''

      var s = document.getElementById("fullName");
        s.innerHTML = fullName;
        console.log(s);
        }
        

    };

    var server = "http://merkaducentral.tk/";
    username = localStorage.getItem("username");
    password = localStorage.getItem("password");
    
    
    

    // MetsiMenu
    $('#side-menu').metisMenu();

    // Collapse ibox function
    $('.collapse-link').click( function() {
        var ibox = $(this).closest('div.ibox');
        var button = $(this).find('i');
        var content = ibox.find('div.ibox-content');
        content.slideToggle(200);
        button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
        ibox.toggleClass('').toggleClass('border-bottom');
        setTimeout(function () {
            ibox.resize();
            ibox.find('[id^=map-]').resize();
        }, 50);
    });

    // Close ibox function
    $('.close-link').click( function() {
        var content = $(this).closest('div.ibox');
        content.remove();
    });

    // Small todo handler
    $('.check-link').click( function(){
        var button = $(this).find('i');
        var label = $(this).next('span');
        button.toggleClass('fa-check-square').toggleClass('fa-square-o');
        label.toggleClass('todo-completed');
        return false;
    });

    // Append config box / Only for demo purpose
    $.get("skin-config.html", function (data) {
        $('body').append(data);
    });

    // minimalize menu
    $('.navbar-minimalize').click(function () {
        $("body").toggleClass("mini-navbar");
        SmoothlyMenu();
    })

    // tooltips
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // Move modal to body
    // Fix Bootstrap backdrop issu with animation.css
    $('.modal').appendTo("body")

    // Full height of sidebar
    function fix_height() {
        var heightWithoutNavbar = $("body > #wrapper").height() - 61;
        $(".sidebard-panel").css("min-height", heightWithoutNavbar + "px");
    }
    fix_height();

    // Fixed Sidebar
    // unComment this only whe you have a fixed-sidebar
            //    $(window).bind("load", function() {
            //        if($("body").hasClass('fixed-sidebar')) {
            //            $('.sidebar-collapse').slimScroll({
            //                height: 'auto',
            //                railOpacity: 0.9,
            //            });
            //        }
            //    })

    $(window).bind("load resize click scroll", function() {
        if(!$("body").hasClass('body-small')) {
            fix_height();
        }
    })

    $("[data-toggle=popover]")
        .popover();
});


// For demo purpose - animation css script
function animationHover(element, animation){
    element = $(element);
    element.hover(
        function() {
            element.addClass('animated ' + animation);
        },
        function(){
            //wait for animation to finish before removing classes
            window.setTimeout( function(){
                element.removeClass('animated ' + animation);
            }, 2000);
        });
}

// Minimalize menu when screen is less than 768px
$(function() {
    $(window).bind("load resize", function() {
        if ($(this).width() < 769) {
            $('body').addClass('body-small')
        } else {
            $('body').removeClass('body-small')
        }
    })
})

function SmoothlyMenu() {
    if (!$('body').hasClass('mini-navbar') || $('body').hasClass('body-small')) {
        // Hide menu in order to smoothly turn on when maximize menu
        $('#side-menu').hide();
        // For smoothly turn on menu
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 100);
    } else if ($('body').hasClass('fixed-sidebar')){
        $('#side-menu').hide();
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 300);
    } else {
        // Remove all inline style from jquery fadeIn function to reset menu state
        $('#side-menu').removeAttr('style');
    }
}

// Dragable panels
function WinMove() {
    var element = "[class*=col]";
    var handle = ".ibox-title";
    var connect = "[class*=col]";
    $(element).sortable(
        {
            handle: handle,
            connectWith: connect,
            tolerance: 'pointer',
            forcePlaceholderSize: true,
            opacity: 0.8,
        })
        .disableSelection();
};


