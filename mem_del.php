<?php require_once 'header.php'; ?>
<?php
check_admin();
$query = "delete from app_users where uid = $_REQUEST[uid] ";
$r = run_sql($query);
if (mysqli_affected_rows($con) > 0) {
    unlink("upload/$_REQUEST[uid].jpg");
}
redirect("search.php?msg=3");
?>
<?php require_once 'footer.php'; ?>
