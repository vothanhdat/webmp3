<script>
    $(document).ready(function () {
        manufacter("manufacter", "sql.php?manufacture=123");
        cagetory("cagetory", "sql.php?cagetory=123");
    });
</script>
<?php
if (isset($_SESSION['login'])) {
    include 'user.php';
}
?>


