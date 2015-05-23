<script>
    $(document).ready(function () {
        manufacter("manufacter", "sql.php?manufacture=123");
        cagetory("cagetory", "sql.php?cagetory=123");
		//$("font").hide();
		//$("br")[0].style.display = "none";
    });
</script>
<?php
if (isset($_SESSION['admin']) && isset($_SESSION['login'])) {
    include 'admin.php';
}
?>


