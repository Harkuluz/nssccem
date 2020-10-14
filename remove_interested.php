<?php require_once 'header.php'; ?>
<?php

check_login();
$query = "delete from events_vol where eid = $_REQUEST[id] and email = '$_SESSION[email]'";
$r = run_sql($query);
redirect("event_det.php?msg=1&id=$_REQUEST[id]");
?>
<?php require_once 'footer.php'; ?>
