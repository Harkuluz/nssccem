<title>Register</title>
<?php
$currentPage = 'reg';
require_once './header.php'; ?>
<?php
if (isset($_POST["name"])) {
    if (null != check_pass($_POST["pass"])) {
        $err = check_pass($_POST["pass"]);
    } else if ($_POST["pass"] != $_POST["cpass"]) {
        $err = "Password does not match!";
    } else if (is_exist($_POST["email"])) {
        $err = $_POST["email"] . ' already registered!';
    } else {
        if (isset($_FILES["at1"])) {
            if (check_img() != null) {
                $err = check_img();
            } else {
                $pic = "";
                if (isset($_FILES["at1"]) && empty($_FILES["at1"]["name"]) != true) {
                    $pic = "upload/dp/u" . rand() . ".jpg";
                    move_uploaded_file($_FILES["at1"]["tmp_name"], "$pic");
                }
                $query = "INSERT INTO `app_users` 
                (`user_name`, `email`, `pass`, `phone_no`, 
                `sec_q`, `sec_a`, `branch`,`dp`, `sem`, `status`) 
                VALUES ('$_POST[name]', '$_POST[email]', '$_POST[pass]', '$_POST[phone_no]', 
                '$_POST[sec_q]', '$_POST[sec_a]', '$_POST[branch]','$pic', '$_POST[sem]', 'approved');";
                $r = run_sql($query);
                redirect("login.php?msg=3");
            }
        }
    }
}
?>
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="myhead2">Register</h1>
        <hr>
        <form method="post" class="form-horizontal row" enctype="multipart/form-data">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input required class="form-control" type="text" value="<?php echo $_POST["name"] ?>" name="name" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Profile Picture</label>
                    <div class="row">
                        <div class="col-md-4" style="padding-right: 0 !important;">
                            <img src="./images/ccem.jpg"
                                style="height: auto;object-fit:cover;max-width: 100%;max-height: 100px;"
                                onclick="document.querySelector('#dp').click()" alt="" id="uploadPreview">
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="dpin" readonly
                                onclick="document.querySelector('#dp').click()" placeholder="Upload Image"
                                style="background: white;" />
                            <input class="form-control" type="file" name="at1" id="dp" onchange="readURL(this);"
                                placeholder="Image" style="display: none;" />
                        </div>
                    </div>
                </div>
            </div>
            <hr clear="all">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Branch</label>
                    <select class="form-control" name="branch" id="branch">
                        <option>CSE</option>
                        <option>Mech</option>
                        <option>ET&T</option>
                        <option>Civil</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Year</label>
                    <select class="form-control" name="sem" id="sem">
                        <option>1st</option>
                        <option>2nd</option>
                        <option>3rd</option>
                        <option>4th</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>E Mail</label>
                    <input required class="form-control" type="email" value="<?php echo $_POST["email"] ?>"
                        name="email" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Contact No</label>
                    <input required class="form-control" pattern="0?[7-9]{1}\d{9}" type="tel"
                        value="<?php echo $_POST["phone_no"] ?>" name="phone_no" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" type="password" name="pass" autocomplete="new-password" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input class="form-control" type="password" name="cpass" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Security Question</label>
                    <select class="form-control" value="<?php echo $_POST["sec_q"] ?>" name="sec_q">
                        <option>What was your childhood nickname?</option>
                        <option>What is the name of your favorite childhood friend?</option>
                        <option>What is your favorite color?</option>
                        <option>What is your favorite movie?</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <label>Security Answer</label>
                    <input required class="form-control" type="text" value="<?php echo $_POST["sec_a"] ?>"
                        name="sec_a" />
                </div>
            </div>
            <div class="form-group">
                <h4 style="color: red;"><?php echo $err; ?></h4>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
            <div class="form-group">
                <button type="reset" class="btn btn-danger btn-block">Reset</button>
            </div>
        </form>
    </div>
</div>
<?php require_once './footer.php'; ?>
<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        document.querySelector('#dpin').setAttribute('value', input.files[0].name);
        reader.onload = function(e) {
            $('#uploadPreview')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>