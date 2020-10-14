<title>Profile</title>
<?php
$currentPage = 'profile'; 
 require_once './header.php'; ?>
<?php 
if(isset($_REQUEST[uid])){
    $uid = $_REQUEST["uid"];
    $query = "select * from app_users 
    where uid = '$uid'";
    $r = run_sql($query);
    if (mysqli_num_rows($r) > 0) {
        $row = mysqli_fetch_array($r);
        $name = $row["user_name"];
        $email = $row["email"];
        $pic = $row["dp"];
        $phone = $row["phone_no"];
        $branch = $row["branch"];
        $sem = $row["sem"];
    }    
}
 else {
    $email = $_SESSION["email"];
    $name = $_SESSION["uname"];    
 if (isset($_POST["name"])) {
    $query = "update app_users set user_name = '$_POST[name]' where user_name = '$name' and email = '$email'";
    $r = run_sql($query);
    $_SESSION["uname"] = $_POST["name"];
}
   $name = $_SESSION["uname"];
    $query = "select * from app_users 
    where email = '$email' 
    and user_name = '$name' and status = 'approved'";
    $r = run_sql($query);
    if (mysqli_num_rows($r) > 0) {
        $row = mysqli_fetch_array($r);
        $name = $row["user_name"];
        $email = $row["email"];
        $pic = $row["dp"];
        $phone = $row["phone_no"];
        $branch = $row["branch"];
        $sem = $row["sem"];
        // redirect("index.php");
    }
 }
?>
<div class="profile">
    <div class="profilehead">
        <a class="upbtn" href="update.php">Update Profile</a>
        <a class="chpass" href="chpass.php">Change Password</a>
        <img class="dp" src='<?php echo"$pic" ?>.jpg'/>
        <br/>
        <div class="dname"><?php echo"$name" ?></div>
    </div>
    <div class="profilebody">
    <div class="row" style="text-align: center;">
        <div class="col-md-4"><h4>Name</h4></div>
        <div class="col-md-8">
            <div class='new_name'id="pro">
                <div id="oname"><?php echo "$name"; ?></div>
               <!--   &nbsp &nbsp &nbsp<button class='btn btn-outline-primary' id="changen" onclick="namefun()">Change</button>
                <form method='post'>
                    <input type="text" name="name" id="name">
                    <input type="submit" value="Change" id="nchange" class='btn btn-outline-primary'/>
                </form> -->
            </div>
        </div>
    </div>
    <hr>
    <div class="row" style="text-align: center;">
        <div class="col-md-4"><h4>Email</h4></div>
        <div class="col-md-8"><?php echo "$email"; ?></div>
    </div>
    <hr>
    <div class="row" style="text-align: center;">
        <div class="col-md-4"><h4>Phone Number</h4></div>
        <div class="col-md-8"><?php echo "$phone"; ?></div>
    </div>
    <hr>
    <div class="row" style="text-align: center;">
        <div class="col-md-4"><h4>Branch</h4></div>
        <div class="col-md-8"><?php echo "$branch"; ?></div>
    </div>
    <hr/>
    <div class="row" style="text-align: center;">
        <div class="col-md-4"><h4>Semester</h4></div>
        <div class="col-md-8"><?php echo "$sem"; ?></div>
    </div>
    <hr/>
    </div>
</div>
<script>
   function namefun(){
//       alert("hel");
  document.getElementById("changen").style.cssText = "transform: translateY(-38px) !important; visibility : hidden !important;";
  document.getElementById("name").style.cssText = "transform: translateY(32px) !important; visibility : visible !important;";
  document.getElementById("oname").style.cssText = "transform: translateY(-32px) !important; visibility : hidden !important;";
  document.getElementById("nchange").style.cssText = "transform: translateY(-38px) !important; visibility : visible !important;";
}
</script>
<?php require_once './footer.php';