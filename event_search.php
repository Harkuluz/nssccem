<?php require_once 'include/const.php'; ?>
<?php require_once 'include/db.php'; ?>
<?php require_once 'include/my_mail.php'; ?>
<?php require_once 'include/myfun.php'; ?>


<table class="memtable" id="resShow">
    <tr>
        <th>Event</th>
        <th>Organizer</th>
        <th>Contact No</th>
        <th>Action</th>
    </tr>
<?php
    $whr = "where CURDATE()<=e_date";
    if (!empty($_REQUEST["si"])) {
        $whr = " where e_name like '%$_REQUEST[si]%'";
    }
    $query = "select * from events $whr order by eid desc ";
    $res = run_sql($query);
    
    if (isset($_GET['searchValue'])) {
        $searchValue = $_GET['searchValue'];

        if (!empty($searchValue)) {
            while ($row = mysqli_fetch_array($res)) {
                if ( stripos($row['e_name'],$searchValue) !== false ) {
                    echo "    <tr>
                    <td>$row[e_name]</td>
                    <td>$row[e_organizor]</td>
                    <td>$row[phone_no]</td>
                    <td><a class='btn btn-sm btn-dark' href='event_det.php?id=$row[eid]'>Read More</a></td>
                </tr>";
                }
            }
        }else{
            while ($row = mysqli_fetch_array($res)) {
                echo "    <tr>
                    <td>$row[e_name]</td>
                    <td>$row[e_organizor]</td>
                    <td>$row[phone_no]</td>
                    <td><a class='btn btn-sm btn-dark' href='event_det.php?id=$row[eid]'>Read More</a></td>
                </tr>";
            }
        }
    }