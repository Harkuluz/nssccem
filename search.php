<title>Members</title>
<?php
$currentPage = 'search';
require_once './header.php'; ?>
<div class="memsearch my-2">
    <form class="form-inline text-center">
        <a class="btn btn-dark btn" href="add_user.php">Add Members</a>
    </form>
</div>
<?php
check_admin();
$msg = "";
if (isset($_REQUEST["msg"])) {
    if ($_REQUEST["msg"] == 1) {
        $msg = "Thanks for contacting!";
    } else if ($_REQUEST["msg"] == 2) {
        $msg = "Member Added Successfully!";
    } else if ($_REQUEST["msg"] == 3) {
        $msg = "Member has been removed!";
    } else if ($_REQUEST["msg"] == 4) {
        $msg = "Event has been updated!";
    }
}
?>
<table class="memtable table  table-bordered table-striped" style="width:100%">
    <thead class="bg-primary text-white">
        <tr>
            <th>Name</th>
            <th>Branch</th>
            <th>Year</th>
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
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Branch</th>
            <th>Year</th>
            <th>Mobile No</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
<?php require_once './footer.php'; ?>

<script>
$(".memtable").DataTable({
    "scrollX": true,
});
</script>