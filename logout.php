<script>
	localStorage.clear();
	document.location = "login.html";
</script>
<?php
session_start();
session_destroy();
?>