<title>Members</title>
<?php
$currentPage = 'search'; 
require_once './header.php'; ?>
<div class="memsearch">
        <form class="form-inline text-center">
            <!-- <input id="searchBox" class="form-control" type="search" name="si" placeholder="Search"/> -->
    <div class="searchContainer">
        <input type="text" name="si" id="searchBox" class="search-text" placeholder="search">
        <span class="search-btn"><i class="fa fa-search"></i></span>
    </div>
            &nbsp
            <?php echo "<br>\t" ?>
            <!-- <input  class="form-control btn btn-dark" type="submit" value="Search"/> -->
            <a class="btn btn-dark btn" href="add_user.php">Add Members</a>
        </form>
</div>
<br/>

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
    <!-- <p ></p> -->
    <?php
    $whr = "where user_name != 'admin'";
    // if (!empty($_REQUEST["si"])) {
    //     $whr = " where sem like '%$_REQUEST[si]%' or user_name like '%$_REQUEST[si]%' or branch like '%$_REQUEST[si]%' or phone_no like '%$_REQUEST[si]%'";
    // }
    $query = "select * from app_users $whr order by uid desc ";
    $res = run_sql($query);
//    $brd1 = "style='border-color: black; font-size: 20px; text-align: left;'";
//    $brd = "style='border-color: black; font-size: 20px; text-align: center;'";
//    $brd = 'class = "brd"';
//    $bd = "style='border-color: black; width: 3px font-size: 10px; text-align: right;'";
    while ($row = mysqli_fetch_array($res)) {
      echo " <div class='tab'>
       <tr>
        <td>$row[user_name]</td>
        <td>$row[branch]</td>
        <td>$row[sem]</td>
        <td>$row[phone_no]</td>";
        echo "<td id='del'><a href='./mem_del.php?uid=$row[uid]' class='btn btn-danger text-white'>Remove Member</a></td>";
       echo"</tr></div>";
//        echo "<td id='del'><a href='./profile.php?uid=$row[uid]' class='btn btn-primary text-white'>Detail</a>&nbsp"
//                . "<a href='./mem_del.php?uid=$row[uid]' class='btn btn-danger text-white'>Remove Member</a></td>" .
//        "</tr></div>";        
//        echo " <div class='tab'>   <tr>
//        <td $brd1>$row[user_name]</td>
//        <td $brd>$row[branch]</td>
//        <td $brd>$row[sem]</td>
//        <td $brd>$row[phone_no]</td>";
//        echo "<td $brd id='del'><a href='./profile.php?uid=$row[uid]' class='btn btn-primary text-white'>Detail</a>&nbsp"
//                . "<a href='./mem_del.php?uid=$row[uid]' class='btn btn-danger text-white'>Remove Member</a></td>" .
//        "</tr></div>";
    }
    ?>
    </tbody>
</table>
<script>
    $(document).ready(function(){
        $("#searchBox").keyup(function (e) { 
            var target = "mem_search.php";

            var name = $("#searchBox").val();
            $.get(target,{
                searchValue: name
            }, function(data, status){
                $("#resShow").html(data);
                // alert(status)
            });
            
        });

    });
</script>
<?php require_once './footer.php';