<script>
    $(document).ready(function () {
        manufacter("manufacter", "sql.php?manufacture=123");
        cagetory("cagetory", "sql.php?cagetory=123");
    });
</script>
<?php
if (isset($_SESSION['admin'])) {
    include 'admin.php';
} else if (isset($_SESSION['content'])) {
    
} else if (isset($_SESSION['user'])) {
    include 'user.php';
}else{
	include 'admin.php';
}
?>


