<title>Change Password</title>
<?php require_once 'header.php'; ?>
<?php
check_login();
$err = "";
if (isset($_POST["opass"])) {
    if (empty($_POST["opass"])) {
        $err = "Old Password is req!!";
    } else if (empty($_POST["npass"])) {
        $err = "New Password is req!!";
    } else if (check_pass($_POST["npass"]) != "") {
        $err = check_pass($_POST["npass"]);
    } else if ($_POST["npass"] != $_POST["cpass"]) {
        $err = "Does not match!!";
    } else {
        $query = "update `app_users` 
     set `pass` =  '$_POST[npass]'
     where `pass` =  '$_POST[opass]'
        and email = '$_SESSION[email]'";
        $r = run_sql($query);
        if (mysqli_affected_rows($con) > 0) {
            redirect("login.php?msg=2");
        } else {
            $err = "Old password is incorrect!!";
        }
    }
}
?>
<div class="row">    
    <div class="col-sm-8 offset-sm-2">    
        <h1>Change Password</h1>
        <hr>
        <form method="post" class="form-horizontal">
            <div class="form-group  has-feedback">
                <input required type="password" class="form-control" id="opass"  name='opass' placeholder="Old Password"  />
                <span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
            </div>
            <div class="form-group  has-feedback">
                <input required type="password" class="form-control" id="npass"  name='npass' placeholder="New Password"  />
                <span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
            </div>
            <div class="form-group  has-feedback">
                <input required type="password" class="form-control" id="cpass"  name='cpass' placeholder="Confirm Password"  />
                <span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
            </div>
            <div  class="form-group">
                <h4 style="color: red;"><?php echo $err; ?></h4>
            </div>    
            <div class="form-group"> 
                <button type="submit" class="btn btn-primary btn-block" style="background-color: #0000aa">Change Password</button>
            </div>
            <div class="form-group"> 
                <a class="btn btn-danger btn-block"  href="chpass.php">Reset</a>
            </div>    
        </form>
    </div>
</div>
<div class="row mx-5">
    <div class="col-sm-12 px-5 text-white">
        <h1>1</h1>
        <h1>1</h1>
        <h1>1</h1>
    </div>
    
</div>

<?php require_once 'footer.php'; ?>
