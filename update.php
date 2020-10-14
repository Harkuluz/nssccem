<title>Profile Update</title>
<?php
$currentPage = 'reg'; 
 require_once './header.php'; ?>
<?php
  if (!is_login()) {
    redirect("login.php");
  }

// to update fetch data
   $email = $_SESSION["email"];
    $query = "select * from app_users 
    where email = '$email'";
    $r = run_sql($query);
    if (mysqli_num_rows($r) > 0) {
        $row = mysqli_fetch_array($r);
        $name = $row["user_name"];
        $email = $row["email"];
        $pic = $row["dp"];
        $phone = $row["phone_no"];
        $branch = $row["branch"];
        $sem = $row["sem"];
        $sec_q = $row["sec_q"];
        $sec_a = $row["sec_a"];
}   
////fetch end

if (isset($_POST["name"])) {
    if (null != check_pass($_POST["pass"])) {
        $err = check_pass($_POST["pass"]);
    } 
    else if ($_POST["pass"] != $_POST["cpass"]) {
        $err = "Password does not match!";
    } 
    // else if (is_exist($_POST["email"])) {
    //     $err = $_POST["email"] . ' already registered!';
    // } 
    else {
        if (isset($_FILES["at1"])) {

            if (check_img() != null) {
            $err = check_img();
        }
         else {
                  // $query = "INSERT INTO `photo`(`name`,`date`) 
                  //   VALUES ('$_POST[name]_$_POST[date]','$_POST[date]');";
                  //   $r = run_sql($query);
                    $pic = "upload/dp/".rand(); 
                    if (isset($_FILES["at1"]) && empty($_FILES["at1"]["name"]) != true) {
                    move_uploaded_file($_FILES["at1"]["tmp_name"], "$pic.jpg");
                    $query = "update app_users set `user_name` = '$_POST[name]', `email` = '$_POST[email]', `pass` = '$_POST[pass]', `phone_no`= '$_POST[phone_no]',`sec_q` = '$_POST[sec_q]', `sec_a` = '$_POST[sec_a]', `branch` = '$_POST[branch]', `dp` = '$pic' , `sem` = '$_POST[sem]' , `status` = 'approved' where email = '$email';";
                    $r = run_sql($query);
                    echo "$query";
                    redirect("index.php?msg=1");
               }
         }
    }
  }
}
?>
<div class="row">    
    <div class="col-sm-8 offset-sm-2">    
        <h1 class="myhead2">Register</h1>
        <hr>
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name</label>
                <input required class="form-control" type="text" value="<?php echo $name ?>" name="name"/>
            </div>
            <div class="form-group">
                <label>Profile Picture</label>
                <input class="form-control" type="file" name="at1" placeholder="Image"/><br>     
            </div>
            <div class="form-group">
                <label>Branch</label>
                <select class="form-control" name="branch" id="branch" >
                    <option>CSE</option>
                    <option>Mech</option>
                    <option>ET&T</option>
                    <option>Civil</option>
                </select>
            </div>
            <div class="form-group">
                <label>Sem</label>
                <select class="form-control" name="sem" id="sem">
                    <option>1st</option>
                    <option>2nd</option>
                    <option>3rd</option>
                    <option>4th</option>
                    <option>5th</option>
                    <option>6th</option>
                    <option>7th</option>
                    <option>8th</option>
                </select>
            </div>
            <div class="form-group">
                <label>E Mail</label>
                <input required class="form-control" type="email" value="<?php echo $email ?>" name="email"/>
            </div>
            <div class="form-group">
                <label>Contact No</label>
                <input required class="form-control" pattern="0?[7-9]{1}\d{9}" type="tel" value="<?php echo $phone ?>" name="phone_no"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="pass"/>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input class="form-control" type="password" name="cpass"/>
            </div>   
            <div class="form-group">
                <label>Security Question</label>
                <select class="form-control" value="<?php echo $sec_q ?>" name="sec_q">
                    <option>What was your childhood nickname?</option>
                    <option>What is the name of your favorite childhood friend?</option>
                    <option>What is your favorite color?</option>
                    <option>What is your favorite movie?</option>
                </select>            
            </div>

            <div class="form-group">
                <label>Security Answer</label>
                <input required class="form-control" type="text" value="<?php echo $sec_a ?>" name="sec_a"/>
            </div>      
            <div  class="form-group">
                <h4 style="color: red;"><?php echo $err; ?></h4>
            </div>    
            <div class="form-group"> 
                <button type="submit" class="btn btn-primary btn-block" >Submit</button>
            </div>
            <div class="form-group"> 
                <a class="btn btn-danger btn-block" href="reg.php">Reset</a>
            </div>    
        </form>
    </div>
</div>    
<?php require_once './footer.php';