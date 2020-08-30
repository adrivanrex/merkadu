// Custom scripts
username = localStorage.getItem("username");
password = localStorage.getItem("password");

$(document).ready(function () {
    $("#cartNavigation").click(function(){
                //alert(0);
            });

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


    setInterval(function(){  
        test = Http = new XMLHttpRequest();
        server = window.location.hostname;
        url = '/graph/storelist.php?username='+username+'&password='+password+'';
        test.open("GET", url);
        //console.log(url);
        test.send();

        Http.onreadystatechange = (e) => {
            if (test.readyState == 4 && test.status == 200) {
                //console.log(test.responseText);

            data = JSON.parse(test.responseText);
                storeList = document.getElementById("storeItems");
                if(storeList){
                    storeList = document.getElementById("storeItems").innerHTML = "";
                }
                //console.log("store",data);

                if(data.data){
                    //
                    //console.log($("#storeItems").val());
                    for (var i = data.data.length - 1; i >= 0; i--) {
                        //console.log(data);
                        
                        name = data.data[i]["name"];

                        description = data.data[i]["description"];
                       

                        $("#storeItems").append('<div class="faq-item"><div class="row"><div class="col-md-7"><a href="addProducts.html" class="faq-question">'+name+'</a></div></div><div class="row"><div class="col-lg-12"><div class="faq-answer"><p>'+description+'</p></div></div></div></div>');
                        

                    }
                }else{
                    $("#storeItems").append('<div class="text-center p-lg"><h2>If you dont have a store  yet. Create a store now</h2><span>add your store  by selecting </span><button title="Create new cluster" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> <span class="bold">Create Store</span></button> button</div>');
                }


            };


        };

    }, 1000);


    setInterval(function(){  


        Http = new XMLHttpRequest();
        const server = window.location.hostname;


        url = '/graph/productList.php?username='+username+'&password='+password+'';
        Http.open("GET", url);
        //console.log(url);
        Http.send();

        Http.onreadystatechange = (e) => {
            if (Http.readyState == 4 && Http.status == 200) {

            data = JSON.parse(Http.responseText);
                productList = document.getElementById("productList");
                if(productList){
                    productList = document.getElementById("productList").innerHTML = "";
                }

                if(data.data){
                    //
                    //console.log($("#storeItems").val());
                    for (var i = data.data.length - 1; i >= 0; i--) {
                        //console.log(data);
                        if(data.data.length > 0){
                           $("#productList").append('<tr><td class="project-status"><span class="label label-primary">Active</span></td><td class="project-title"><a href="#">'+data.data[i]["name"]+'</a><br/><small>Created '+data.data[i]["date"]+'</small></td><td class="project-completion"><strong>Description:</strong><br><small>'+data.data[i]["description"]+'</small><br><strong>Quantity:</strong><small>'+data.data[i]["quantity"]+'</small><br><!--<div class="progress progress-mini"><div style="width: 48%;" class="progress-bar"></div>--></div></td><td class="project-people"><a href=""><img alt="image" class="img-circle" src="uploads/'+data.data[i]["picture"]+'"></a></td><td class="project-actions"><a href="#" id="'+data.data[i]["id"]+'editProduct" data-toggle="modal" data-target="#editProductModal" class="editProduct btn btn-white btn-sm"><i class="fa fa-folder"></i> Edit </a><a href="#" id="'+data.data[i]["id"]+'" class="disableProduct btn btn-white btn-sm"><i class="fa fa-pencil"></i> Delete</a></td></tr>');
                         
                        }
                        

                    }
                }else{
                    $("#productList").append('<div class="text-center p-lg"><h2>If you dont have a product  yet. Create a product now</h2><span>add your product  by selecting </span><button title="Create new cluster" data-toggle="modal" data-target="#productModal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> <span class="bold">Add Product</span></button> button</div>');
                }


            };


        };

        

    }, 1000);
$('.wrapper').on('click', '.disableProduct', function() {
        //alert(this.id);
        
        removeProduct = new XMLHttpRequest();
        server = window.location.hostname;


        url = '/graph/removeProduct.php?username='+username+'&password='+password+'&productID='+this.id+'';
        removeProduct.open("GET", url);
        console.log(url);
        removeProduct.send();

        removeProduct.onreadystatechange = (e) => {
            if (removeProduct.readyState == 4 && removeProduct.status == 200) {

            };
        };
        });

$('.wrapper').on('click', '.editProduct', function() {
        
        $(".editProductSubmit").attr("id", this.id);

        
        id = this.id;

        var id = id.replace("editProduct", "");

        editProduct = new XMLHttpRequest();
        server = window.location.hostname;


        url = '/graph/productInfo.php?username='+username+'&password='+password+'&productID='+id+'';
        editProduct.open("GET", url);
        console.log(url);
        editProduct.send();

        editProduct.onreadystatechange = (e) => {
            if (editProduct.readyState == 4 && editProduct.status == 200) {
                    data = JSON.parse(editProduct.responseText);
                    console.log("edit", data.data[0].name);
                    $("#editProductName").attr("placeholder", data.data[0].name);
                    $("#editProductName").val(data.data[0].name);

                    $("#editProductDescription").attr("placeholder", data.data[0].description);
                    $("#editProductDescription").val(data.data[0].description);

                    $("#editUnitPrice").attr("placeholder", data.data[0].unitPrice);
                    $("#editUnitPrice").val(data.data[0].unitPrice);

                    $("#editProductQuantity").attr("placeholder", data.data[0].quantity);
                    $("#editProductQuantity").val(data.data[0].quantity);
                    







            };
        }; 

        });


       
    



    $("#createStoreSubmit").click(function(){
        storeName = $("#createStoreStoreName").val();
        storeDescription = $("#createStoreDescription").val();
        primaryPicture = "none";
        username = localStorage.getItem("username");
        password = localStorage.getItem("password");

        Http = new XMLHttpRequest();
        server = window.location.hostname;


        url = '/graph/createStore.php?username='+username+'&password='+password+'&storeName='+storeName+'&storeDescription='+storeDescription+'&primaryPicture='+primaryPicture+'';
        Http.open("GET", url);
        //console.log(url);
        Http.send();

        Http.onreadystatechange = (e) => {
            data = JSON.parse(Http.responseText);
            if(data.status == 1){
                $("#createStoreCancel").click();
                document.location = "addProducts.html";
            }else{
                alert(data.message);
            }

        };
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
    $(".buy").click(function(){
        //alert(this.id);
    });

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


