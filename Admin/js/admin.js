$(document).ready(function () {
	alert(0);

$('#iframeContent').attr('src', '../billing.html');
    $("#monthlyBilling").click(function(){
    	alert(0);
        $('#iframeContent').attr('src', '../billing.html');
        $("body").toggleClass("mini-navbar");
            SmoothlyMenu();
    });

};
