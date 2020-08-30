<?php
include_once('class/class.manageUsers.php');
$datetime = date_create()->format('Y-m-d H:i:s');
$users = new ManageUsers();
$productID = $_GET["id"];
$productInfo = $users->productInfo($productID);
//print_r($productInfo);
?>
<html>
<head>
	<title><?php echo $productInfo[0]["name"];?></title>
</head>
<body>
	
</body>
</html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>merkadu | Contacts</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <meta property="og:title" content="Merkadu <?php echo $productInfo[0]["name"];?> <?php echo $productInfo[0]["description"];?>" />
    <meta property="og:description" content="<?php echo $productInfo[0]["description"];?>" />
    <meta property="og:type" content="video.movie" />
    <meta property="og:url" content="http://merkadu.tk">
    <meta property="og:image" content="http://merkadu.tk/uploads/<?php echo $productInfo[0]["picture"];?>" />
    <meta property="fb:app_id" content="795273954611940">
</head>

<body style="background-color: white">


    <div id="wrapper">
        <div class="row">
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="input-group form-inline">
        	<!--
            <div class="col-lg-4">
                <select id="citySearchProduct" type="text" class="form-control input-lg">
                
            <option id="mainLocation" value=""></option>
        
                </select>
            </div>
            
            <div class="col-lg-8">
                <input id="searchTerm" type="text" placeholder="Search" name="search" class="form-control input-lg">
            </div>
            <div class="input-group-btn">
                <button id="searchProduct" class="search btn btn-lg btn-primary" type="submit">
                    Search
                </button>
            </div>
        -->
        </div>
        <div class="row">
            <br>
        <center>
        <div class="btn-group">
                                        <button id="backwardProductList" class="btn btn-white" type="button"><i class="fa fa-chevron-left"></i></button>
                                        <button id="forwardProductList" class="btn btn-white" type="button"><i class="fa fa-chevron-right"></i> </button>
                                    </div>
        </center>
        <br>
        </div>
        <div id="itemList" class="row">

        	<div class="contact-box">
        		<div class="col-sm-6">
        			<div class="text-center">
        				<img width="500px" src="uploads/<?php echo $productInfo[0]["picture"];?>"><br><br> </div>
        </div>
        <div class="col-sm-3"><a href="pages.php?id=<?php echo $productInfo[0]["id"];?>&title=<?php echo $productInfo[0]["name"];?>"><h3><strong><?php echo $productInfo[0]["name"];?></strong></h3></a><p><i class="fa fa-map-marker"><a href="http://merkadutk/storeProducts.html?id=13&name=<?php echo $productInfo[0]["storeName"];?>&storeUsername=<?php echo $productInfo[0]["username"];?>"></i> <?php echo $productInfo[0]["storeName"];?></a></p><address><strong>Description</strong><br><?php echo $productInfo[0]["description"];?><form"><input class="form-control" id="<?php echo $productInfo[0]["id"];?>Quantiy" type="number" min="0" placeholder="quantity"></input></form ><h3><strong>Price:<?php echo $productInfo[0]["unitPrice"];?></strong></h3><button id=<?php echo $productInfo[0]["id"];?> type="submit" class="buy btn-primary btn-lg">Buy</button> </div><div class="clearfix"> </div>
        </div></div>
        <center>
        <div class="btn-group">
                                        <button id="backwardProductList" class="btn btn-white" type="button"><i class="fa fa-chevron-left"></i></button>
                                        <button id="forwardProductList" class="btn btn-white" type="button"><i class="fa fa-chevron-right"></i> </button>
                                    </div>
        </center>

        <div id="productOutput"></div>
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
    </div>
    </div>
    </div>
    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
    <script>
    	$('.wrapper').on('click', '.buy', function() {
        //alert(this.id);
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

                if (Http.readyState == 4 && Http.status == 200) {
                    console.log(JSON.parse(Http.responseText));
                    data = JSON.parse(Http.responseText);
                    //alert(typeof  data.status);
                    if(typeof  data.status === "undefined"){
                    document.location = "login.html"; 
                    localStorage.setItem("lastBuy", this.id);
                    localStorage.setItem("quantity", quantity);
                    }
                    if(data.status == 1){
                    document.location = 'Managepayments.html';
                }

                };
            };

        }

    });</script>