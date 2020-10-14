<?php $page = "forgot" ?>
<?php require_once 'header.php'; ?>
<?php
$err = "";
if (isset($_POST["email"])) {
    if (empty($_POST["email"])) {
        $err = "E-Mail is req!!";
    } else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
        $err = "E-Mail is incorrect!!";
    } else if (!is_exist($_POST["email"])) {
        $err = "E-Mail is not registered!!";
    } else if (empty($_POST["sec_q"])) {
        $err = "Security Question is req!!";
    } else if (empty($_POST["sec_a"])) {
        $err = "Security Answer is req!!";
    } else {
        $email = filter_var($_POST["email"], FILTER_SANITIZE_MAGIC_QUOTES);
        $sec_q = filter_var($_POST["sec_q"], FILTER_SANITIZE_MAGIC_QUOTES);
        $sec_a = filter_var($_POST["sec_a"], FILTER_SANITIZE_MAGIC_QUOTES);
        $query = "select * from app_users 
    where email = '$email' 
    and sec_q = '$sec_q'
    and sec_a = '$sec_a'
    ";
        $r = run_sql($query);
        if (mysqli_num_rows($r) > 0) {
            $row = mysqli_fetch_array($r);
            $body = " Your password is $row[pass]";
            echo "<h4>Your password is : $row[pass]</h4>";
//       mail_it($row["email"], "Your password", $body, null);
//       redirect("login.php?msg=1");
        } else {
            $err = "Incorrect information!";
        }
    }
}
?>
<div class="row">    
    <div class="col-sm-8 offset-sm-2">    
        <h1>Forgot Password!</h1>
        <form method="post"  class="form-horizontal">
            <div class="form-group">
                <input required type="email" class="form-control" id="email" name='email' placeholder="Email" value="<?php echo $_POST["email"] ?>"/>
            </div>
            <div class="form-group">
                <select class="form-control" value="<?php echo $_POST["sec_q"] ?>" name="sec_q">
                    <option>What was your childhood nickname?</option>
                    <option>What is the name of your favorite childhood friend?</option>
                    <option>What is your favorite color?</option>
                    <option>What is your favorite movie?</option>
                </select>   </div>
            <div class="form-group">
                <input required type="text" class="form-control" id="sec_a" name='sec_a' placeholder="Security Answer" value="<?php echo $_POST["sec_a"] ?>"/>
            </div>    
            <div  class="form-group">
                <h4 style="color: red;"><?php echo $err; ?></h4>
            </div>    
            <div class="form-group"> 
                <button type="submit" class="btn btn-primary" style="background-color: #660000">Submit</button>
            </div>
            <div class="form-group"> 
                <a class="btn btn-primary" style="background-color: #660000" href="forgot_pass.php">Reset</a>
            </div>    
        </form>
    </div>
</div>        
<?php require_once 'footer.php'; ?>
