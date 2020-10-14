<title>Add User</title>
<?php require_once './header.php'; ?>
<?php
if (isset($_POST["name"])) {
    if (is_exist($_POST["email"])) {
        $err = $_POST["email"] . ' already registered!';
    } else {
        $query = "INSERT INTO `app_users` 
    (`user_name`, `email`,  `phone_no`, `branch`, `sem`, `status`) 
    VALUES ('$_POST[name]', '$_POST[email]',  '$_POST[phone_no]', 
    '$_POST[branch]', '$_POST[sem]', 'approved');";
        $r = run_sql($query);
        redirect("search.php?msg=3");
    }
}
?>
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="myhead2">Add New Member</h1>
        <hr>
        <form method="post" class="form-horizontal row">
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
            <div class="form-group">
                <h4 style="color: red;"><?php echo $err; ?></h4>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-danger" href="reg.php">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php require_once './footer.php'; ?>