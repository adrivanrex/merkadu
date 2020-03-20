<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>merkadu | Dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Morris -->
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> 
                            <span>
                                <img alt="image" width="50px" height="50px" class="img-circle" src="img/def_face.jpg" />
                            </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> 
                                    </span> <strong id="fullName" class="font-bold"></strong><b class="caret"></b></span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a id="profile" href="#">Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            M+
                        </div>
                    </li>
                    <li class="active">
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a id="search" href="#">Search</a></li>
                            <li id="createStore"><a href="#">Market</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Orders</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a id="manageOrders" href="#">Incoming</a></li>
                            <li><a id="purchased" href="#">Purchased</a></li>
                            <li><a id="trackOrders" href="#">Completed</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a id="paymentCenter" href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Cart</span></a>
                    </li>
                    <!--
                    <li class="">
                        <a target="_blank" id="paymentCenter" href="#"><i class="fa fa-star"></i> <span class="nav-label">Delivery Team</span> <span class="label pull-right">NEW</span></a>
                    </li>
                    -->
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <!--
                        <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                        -->
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a id="cartNavigation" class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-shopping-cart"></i> <span id="cartBuy" class="label label-warning"></span>
                            </a>
                        </li>
                        <!--
                        <li>
                            <a href="http://merkadu-support.tk"><i class="fa fa-question-circle fa-6"></i></a>
                        </li>
                        -->
                        <li>
                            <a href="logout.php">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
        <!--        
        <div class="input-group">
            <input id="searchTerm" type="text" placeholder="Search" name="search" class="form-control input-lg">
            <div class="input-group-btn">
                <button id="searchProduct" class="search btn btn-lg btn-primary" type="submit">
                    Search
                </button>
            </div>
        </div>
        -->
        <br>
        <div id="itemList" class="row">
        </div>


    <div class="modal inmodal" id="reportModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <form action="upload.php" class="dropzone" id="dropzonewidget">
                                        <div class="dropzone-previews"></div>
                                    </form>
                                    <!--

                                            <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                                        -->
                                </div>
                                <div class="modal-body">
                                    <!--
                                            <p><strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                                                printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
                                                remaining essentially unchanged.</p>
                                            -->
                                    
                                    <div class="form-group"><label>Description</label> <input id="reportDescription" type="text" placeholder="Enter Report Description" class="form-control"></div>
                                   
                                </div>
                                <div class="modal-footer">
                                    <button id="productCancel" type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button id="reportSubmit" type="button" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>

            <iframe width="100%" style="overflow:hidden;" scrolling="no" frameBorder="0" height="20000px" id="iframeContent" src=""></iframe>

        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="js/merkadu.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- GITTER -->
    <script src="js/plugins/gritter/jquery.gritter.min.js"></script>
    <!-- EayPIE -->
    <script src="js/plugins/easypiechart/jquery.easypiechart.js"></script>
    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>
    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>
    <script>
    $(document).ready(function() {
        
        server = window.location.hostname;
        setInterval(function(){ getCartBuyNumber(server); }, 1000);


        
        function getCartBuyNumber(server) {
            Http = new XMLHttpRequest();
            //var server = "http://hantakserver/";
            server = window.location.hostname;
            //var server = "http://merkadu/";

            url = '/graph/cartList.php?username=' + username + '&password=' + password + '';
            //console.log(url);
            Http.open("GET", url);

            Http.send();

            Http.onreadystatechange = (e) => {

                if (Http.readyState == 4 && Http.status == 200) {
                    //console.log(JSON.parse(Http.responseText));
                    data = JSON.parse(Http.responseText);
                    //console.log("cartList", );
                    $("#cartBuy").empty();
                    $("#cartBuy").append(data.data.length);

                };
            };


        }
        $("#cartNavigation").click(function() {
            //alert(0);

            $("#paymentCenter").click();
        });

        setTimeout(function() {
            $.gritter.add({
                title: 'Latest News',
                text: 'Its a beautiful year!',
                time: 2000
            });
        }, 2000);


        $('.chart').easyPieChart({
            barColor: '#f8ac59',
            //                scaleColor: false,
            scaleLength: 5,
            lineWidth: 4,
            size: 80
        });

        $('.chart2').easyPieChart({
            barColor: '#1c84c6',
            scaleLength: 5,
            lineWidth: 4,
            size: 80
        });

        var data1 = [
            [0, 4],
            [1, 8],
            [2, 5],
            [3, 10],
            [4, 4],
            [5, 16],
            [6, 5],
            [7, 11],
            [8, 6],
            [9, 11],
            [10, 30],
            [11, 10],
            [12, 13],
            [13, 4],
            [14, 3],
            [15, 3],
            [16, 6]
        ];
        var data2 = [
            [0, 1],
            [1, 0],
            [2, 2],
            [3, 0],
            [4, 1],
            [5, 3],
            [6, 1],
            [7, 5],
            [8, 2],
            [9, 3],
            [10, 2],
            [11, 1],
            [12, 0],
            [13, 2],
            [14, 8],
            [15, 0],
            [16, 0]
        ];
        $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
            data1, data2
        ], {
            series: {
                lines: {
                    show: false,
                    fill: true
                },
                splines: {
                    show: true,
                    tension: 0.4,
                    lineWidth: 1,
                    fill: 0.4
                },
                points: {
                    radius: 0,
                    show: true
                },
                shadowSize: 2
            },
            grid: {
                hoverable: true,
                clickable: true,
                tickColor: "#d5d5d5",
                borderWidth: 1,
                color: '#d5d5d5'
            },
            colors: ["#1ab394", "#464f88"],
            xaxis: {},
            yaxis: {
                ticks: 4
            },
            tooltip: false
        });

        var doughnutData = [{
                value: 300,
                color: "#a3e1d4",
                highlight: "#1ab394",
                label: "App"
            },
            {
                value: 50,
                color: "#dedede",
                highlight: "#1ab394",
                label: "Software"
            },
            {
                value: 100,
                color: "#b5b8cf",
                highlight: "#1ab394",
                label: "Laptop"
            }
        ];

        var doughnutOptions = {
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 2,
            percentageInnerCutout: 45, // This is 0 for Pie charts
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false,
        };

        var ctx = document.getElementById("doughnutChart").getContext("2d");
        var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

        var polarData = [{
                value: 300,
                color: "#a3e1d4",
                highlight: "#1ab394",
                label: "App"
            },
            {
                value: 140,
                color: "#dedede",
                highlight: "#1ab394",
                label: "Software"
            },
            {
                value: 200,
                color: "#b5b8cf",
                highlight: "#1ab394",
                label: "Laptop"
            }
        ];

        var polarOptions = {
            scaleShowLabelBackdrop: true,
            scaleBackdropColor: "rgba(255,255,255,0.75)",
            scaleBeginAtZero: true,
            scaleBackdropPaddingY: 1,
            scaleBackdropPaddingX: 1,
            scaleShowLine: true,
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 2,
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false,
        };
        var ctx = document.getElementById("polarChart").getContext("2d");
        var Polarchart = new Chart(ctx).PolarArea(polarData, polarOptions);

    });

    user =  localStorage.getItem("username");
    if(user){

    }else{
        document.location = 'login.html';
    }

    $(document).load(function () {
     // code here

    });





    var username = localStorage.getItem("username");
    var password = localStorage.getItem("password");

    sHttp = new XMLHttpRequest();
    searchTerm = null;

    //var server = "http://hantakserver/";
    //var server = "http://merkadu/";
    var server = window.location.hostname;
    console.log(server);

    url = '/graph/getuserinfo.php?username=' + username + '&password=' + password + '&searchTerm=' + searchTerm + '';
    sHttp.open("GET", url);

    sHttp.send();

    sHttp.onreadystatechange = (e) => {

        if (sHttp.readyState == 4 && sHttp.status == 200) {
           data = JSON.parse(sHttp.responseText);
           localStorage.setItem("userinfo", JSON.stringify(data));
            

        };
    };



    Http = new XMLHttpRequest();
    searchTerm = null;

    //var server = "http://hantakserver/";
    //var server = "http://merkadu/";
    var server = window.location.hostname;
    console.log(server);

    url = '/graph/globalSearch.php?username=' + username + '&password=' + password + '&searchTerm=' + searchTerm + '';
    console.log(url);
    Http.open("GET", url);

    Http.send();

    Http.onreadystatechange = (e) => {

        if (Http.readyState == 4 && Http.status == 200) {
            console.log("global",JSON.parse(Http.responseText));
            data = JSON.parse(Http.responseText);
            //console.log(data);
            for (var i = data.data.length - 1; i >= 0; i--) {
                server = window.location.hostname;
                picture = '/uploads/' + data.data[i].picture + '';
                link = '/buy.html?id=' + data.data[i].id + '';
                console.log(data);
                name = data.data[i].name;
                id = data.data[i].id;
                description = data.data[i].description;
                owner = data.data[i].productOwner;
                price = data.data[i].unitPrice;
                
                userinfo = localStorage.getItem("userinfo");
                userinfo = JSON.parse(userinfo);
                titleLink = 'view.php?id='+id+'';
                console.log("userinfos", userinfo.data[0].role);
                if(userinfo.data[0].role == "admin"){
                    bannedUser = '<button id=' + id + ' type="submit"  class="banProduct btn-primary btn-lg">BanProduct</button>';
                }else{
                    bannedUser = '';
                }

                $("#itemList").append('<div class="col-lg-4"><div class="contact-box"><div class="col-sm-4"><div class="text-center"><img alt="image"  class="m-t-xs img-responsive" src="' + picture + '"><br><br> </div></div><div class="col-sm-8"><a href="'+titleLink+'"><h3><strong>' + name + '</strong></h3></a><p><i class="fa fa-map-marker"></i> '+owner+'</p><address><strong>Description</strong><br>'+description+'<form"><input class="form-control" id="' + id + 'Quantiy" type="number" min="0" placeholder="quantity"></input></form ><h3><strong>Price:'+price+'</strong></h3> </div><div class="clearfix"><button id=' + id + ' type="submit" class="buy btn-primary btn-lg">Buy</button><!--<button id=' + id + ' type="submit"  class="banProduct btn-primary btn-lg">Report</button>-->'+bannedUser+'</div>');
            }

        };
    };

    $(".search").click(function(){
    var username = localStorage.getItem("username");
    var password = localStorage.getItem("password");
    searchHttp = new XMLHttpRequest();
    searchTerm = $("#searchTerm").val();

    //var server = "http://hantakserver/";
    //var server = "http://merkadu/";
    server = window.location.hostname;

    url = '/graph/globalSearch.php?username=' + username + '&password=' + password + '&searchTerm=' + searchTerm + '';
    console.log(url);
    searchHttp.open("GET", url);

    searchHttp.send();

    searchHttp.onreadystatechange = (e) => {

        if (searchHttp.readyState == 4 && searchHttp.status == 200) {
            console.log(JSON.parse(searchHttp.responseText));
            data = JSON.parse(searchHttp.responseText);
            //console.log(data);
            $("#itemList").empty();
            for (var i = data.data.length - 1; i >= 0; i--) {
                server = window.location.hostname;
                picture = '/uploads/'+data.data[i].picture+'';
                link = '/buy.html?id=' + data.data[i].id + '';
                console.log(data);
                name = data.data[i].name;
                id = data.data[i].id;
                description = data.data[i].description;
                price =  data.data[i].unitPrice;
                userinfo = localStorage.getItem("userinfo");
                userinfo = JSON.parse(userinfo);
                owner = data.data[i].productOwner;
                console.log("userinfos", userinfo.data.role);
                if(userinfo.data[0].role == "admin"){
                    bannedUser = '<button id=' + id + ' type="submit" class="banProduct btn-primary btn-lg">BanProduct</button>';
                }else{
                    bannedUser = '';
                }


                $("#itemList").append('<div class="col-lg-4"><div class="contact-box"><div class="col-sm-4"><div class="text-center"><img alt="image"  class="m-t-xs img-responsive" src="' + picture + '"><br><br> </div></div><div class="col-sm-8"><h3><strong>' + name + '</strong></h3><p><i class="fa fa-map-marker"></i> '+owner+'</p><address><strong>Description</strong><br>'+description+'<form"><input class="form-control" id="' + id + 'Quantiy" type="number" min="0" placeholder="quantity"></input></form ><h3><strong>Price:</strong>'+price+'</h3></div><div class="clearfix"><button id=' + id + ' type="submit" class="buy btn-primary btn-lg">Buy</button><!--<button id=' + id + ' type="submit" data-toggle="modal" data-target="#reportModal" class="report btn-primary btn-lg">Report</button>--> '+bannedUser+'</div>');
            }

        };
    };
    });

    $('.wrapper').on('click', '.banProduct', function() {
        id = this.id;
        banProductHttp = new XMLHttpRequest();
            //var server = "http://hantakserver/";
            //var server = "http://merkadu/";
            server = window.location.hostname;

            url = '/graph/bannedPostingProduct.php?userAccount='+username+'&username=' + username + '&password=' + password + '&productID=' + id + '&reportDescription=' + reportDescription + '';
            console.log(url);
            banProductHttp.open("GET", url);

            banProductHttp.send();

            banProductHttp.onreadystatechange = (e) => {

                if (banProductHttp.readyState == 4 && banProductHttp.status == 200) {
                    console.log(JSON.parse(banProductHttp.responseText));
                    data = JSON.parse(banProductHttp.responseText);
                    alert("success");

                };
            };

    });
    $('.wrapper').on('click', '.report', function() {
        id = this.id;
        reportDescription = $("#reportDescription").val();
        $("#reportSubmit").click(function(){
            reportSubmitHttp = new XMLHttpRequest();
            //var server = "http://hantakserver/";
            //var server = "http://merkadu/";
            server = window.location.hostname;

            url = '/graph/addReport.php?username=' + username + '&password=' + password + '&productID=' + id + '&reportDescription=' + reportDescription + '';
            console.log(url);
            reportSubmitHttp.open("GET", url);

            reportSubmitHttp.send();

            reportSubmitHttp.onreadystatechange = (e) => {

                if (reportSubmitHttp.readyState == 4 && reportSubmitHttp.status == 200) {
                    console.log(JSON.parse(reportSubmitHttp.responseText));
                    data = JSON.parse(reportSubmitHttp.responseText);

                };
            };


            $('#productCancel').click();
        });
    });
    $('.wrapper').on('click', '.buy', function() {
        quantity = $('#' + this.id + 'Quantiy').val();
        if (quantity == 0) {
            alert("please input quantity");
        } else {
            this.innerText = "Added to cart";
            Http = new XMLHttpRequest();
            //var server = "http://hantakserver/";
            //var server = "http://merkadu/";
            server = window.location.hostname;

            url = '/graph/addToCart.php?username=' + username + '&password=' + password + '&productID=' + this.id + '&quantity=' + quantity + '';
            console.log(url);
            Http.open("GET", url);

            Http.send();

            Http.onreadystatechange = (e) => {

                if (Http.re-adyState == 4 && Http.status == 200) {
                    console.log(JSON.parse(Http.responseText));
                    data = JSON.parse(Http.responseText);

                };
            };

        }

    });

    document.getElementById("searchProduct").click(); 
    $(document).load(function () {
     // code here
    document.getElementById("searchProduct").click(); 
    });
    </script>


    </script>
</body>

</html>