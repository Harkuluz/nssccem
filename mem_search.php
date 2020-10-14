<?php require_once 'include/const.php'; ?>
<?php require_once 'include/db.php'; ?>
<?php require_once 'include/my_mail.php'; ?>
<?php require_once 'include/myfun.php'; ?>

<table class="memtable" id='resShow'>
    <thead>
        <tr>
            <!--            <th style="border-color: black; font-size: 20px; text-align: left;">Name</th>
            <th style="border-color: black; font-size: 20px; text-align: center;">Branch</th>
            <th style="border-color: black; font-size: 20px; text-align: center;">Semester</th>
            <th style="border-color: black; font-size: 20px; text-align: center;">Mobile No</th>
            <th style="border-color: black; font-size: 20px; text-align: center;">Action</th>-->
            <th>Name</th>
            <th>Branch</th>
            <th>Semester</th>
            <th>Mobile No</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $whr = "where user_name != 'admin'";
        if (!empty($_REQUEST["si"])) {
            $whr = " where sem like '%$_REQUEST[si]%' or user_name like '%$_REQUEST[si]%' or branch like '%$_REQUEST[si]%' or phone_no like '%$_REQUEST[si]%'";
        }
        $query = "select * from app_users $whr order by uid desc ";
        $res = run_sql($query);

        if (isset($_GET['searchValue'])) {
            $searchValue = $_GET['searchValue'];

            if (!empty($searchValue)) {
                while ($row = mysqli_fetch_array($res)) {
                    if (stripos($row['user_name'], $searchValue) !== false || strpos($row['branch'], $searchValue) !== false || strpos($row['sem'], $searchValue) !== false) {
                        echo " <div class='tab'>
                    <tr>
                    <td>$row[user_name]</td>
                    <td>$row[branch]</td>
                    <td>$row[sem]</td>
                    <td>$row[phone_no]</td>";
                        echo "<td id='del'><a href='./mem_del.php?uid=$row[uid]' class='btn btn-danger text-white'>Remove Member</a></td>" .
                            "</tr></div>";
                    }
                }
            } else {
                while ($row = mysqli_fetch_array($res)) {
                    echo " <div class='tab'>
                 <tr>
                  <td>$row[user_name]</td>
                  <td>$row[branch]</td>
                  <td>$row[sem]</td>
                  <td>$row[phone_no]</td>";
                    echo "<td id='del'><a href='./mem_del.php?uid=$row[uid]' class='btn btn-danger text-white'>Remove Member</a></td>" .
                        "</tr></div>";
                }
            }
        }
        ?>