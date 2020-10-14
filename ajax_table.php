<?php require_once 'include/const.php'; ?>
<?php require_once 'include/db.php'; ?>
<?php require_once 'include/my_mail.php'; ?>
<?php require_once 'include/myfun.php'; ?>
<?php
$query = "select * from events where status = 0 and CURDATE() < e_date  order by eid desc ";
$res = run_sql($query);
while ($row = mysqli_fetch_array($res)) {
    $data[] = $row;
}
if (!empty($data)) {
    $results = [
        "sEcho" => 1,
        "iTotalRecords" => count($data),
        "iTotalDisplayRecords" => count($data),
        "aaData" => $data
    ];
} else {
    $results = [
        "sEcho" => 1,
        "iTotalRecords" => 0,
        "iTotalDisplayRecords" => 0,
        "aaData" => []

    ];
}
echo json_encode($results);
?>