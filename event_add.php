<title>Add Event</title>
<?php require_once './header.php'; ?>
<?php
check_admin();
$err = "";
if (isset($_POST["name"])) {
    if (check_img() != null) {
        $err = check_img();
    } else {
        $query = "INSERT INTO events 
    (e_name, e_addr, e_organizor, e_date, 
    phone_no, status, e_desc, sponsor) 
    VALUES ('$_POST[name]', '$_POST[addr]', '$_POST[oname]', '$_POST[edate]', 
    '$_POST[phone_no]', 'new', '$_POST[edesc]', '$_POST[sname]');";

        $r = run_sql($query);
        $lid = mysqli_insert_id($con);
        if (isset($_FILES["at1"]) && empty($_FILES["at1"]["name"]) != true) {
            move_uploaded_file($_FILES["at1"]["tmp_name"], "upload/e_$lid.jpg");
        }
        $msg = "<h3>$_POST[name] is on $_POST[edate] at $_POST[addr]</h3>";
        //for send email to all students
        $query = "select * from app_users where user_name != 'admin' order by uid desc ";
        $res = run_sql($query);
        while ($row = mysqli_fetch_array($res)) {
            mail_it("$row[email]", "New Event is Added!", $msg);
        }

        redirect("events.php?msg=2");
    }
}
?>
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="myhead2">Event Add</h1>
        <hr>
        <form method="post" enctype="multipart/form-data">
            <input required class="form-control" type="text" value="<?= $_POST["name"] ?>" name="name"
                placeholder="Event Name" /><br>
            <input required class="form-control" type="text" value="<?= $_POST["oname"] ?>" name="oname"
                placeholder="Organizer Name" /><br>
            <input required class="form-control" pattern="0?[7-9]{1}\d{9}" type="tel" value="<?= $_POST["phone_no"] ?>"
                name="phone_no" placeholder="Contact No" /><br>
            <input class="form-control" type="text" value="<?= $_POST["sname"] ?>" name="sname"
                placeholder="Sponser Name" /><br>
            <input required min="<?php echo date("Y-m-d") ?>" class="form-control" type="datetime-local"
                value="<?= $_POST["edate"] ?>" name="edate" placeholder="Event Date" /><br>
            <input required class="form-control" type="text" value="<?= $_POST["addr"] ?>" name="addr"
                placeholder="Addrress" /><br>
            <textarea rows="4" class="form-control" name="edesc"
                placeholder="Description"><?= $_POST["edesc"] ?></textarea>
            <h4 style="color: red;"><?php echo $err; ?></h4>
            <input class="form-control" type="file" name="at1" placeholder="Image" /><br>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
            <a class="btn btn-danger btn-block" href="event_add.php">Reset</a>
        </form>
    </div>
</div>
<?php require_once './footer.php'; ?>