<?php require_once 'header.php';?>
<?php
check_login();
$query = "insert into events_vol (eid, email, uname ) values ('$_REQUEST[id]', '$_SESSION[email]', '$_SESSION[uname]'); ";
echo "$query";
$r = run_sql($query);
redirect("event_det.php?msg=1&id=$_REQUEST[id]");
?>
<?php require_once 'footer.php';?>
