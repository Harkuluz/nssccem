<?php require_once 'header.php';?>
<?php
check_admin();
$query = "delete from events where eid = $_REQUEST[id] ";
$r = run_sql($query);
if(mysqli_affected_rows($con)>0){
    unlink("upload/e_$_REQUEST[id].jpg");
}
redirect("events.php?msg=3");
?>
<?php require_once 'footer.php';?>
