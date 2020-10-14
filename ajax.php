<?php require_once 'include/const.php'; ?>
<?php require_once 'include/db.php'; ?>
<?php require_once 'include/my_mail.php'; ?>
<?php require_once 'include/myfun.php'; ?>
<?php
if (isset($_POST['checklogin'])) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $query = "select * from app_users 
    where email = '$email' 
    and pass = '$pass' and status = 'approved'";
    $r = run_sql($query);
    if (mysqli_num_rows($r) > 0) {
        $row = mysqli_fetch_array($r);
        $_SESSION["uname"] = $row["user_name"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["role"] = $row["role"];
        // redirect("index.php");
        echo "pass";
    } else {
        echo "fail";
    }
}

/////
if (isset($_POST["name"])) {
    if (check_img() != null) {
        echo $err = check_img();
    } else {
        $eid = $_POST["eid"];
        $pic = "";
        if (isset($_FILES["at1"]) && empty($_FILES["at1"]["name"]) != true) {
            $pic = "upload/events/e" . rand() . ".jpg";
            move_uploaded_file($_FILES["at1"]["tmp_name"], "$pic");
        }
        if ($eid > 0) {
            $query = "update events set
            e_name = '$_POST[name]', e_addr = '$_POST[addr]', e_organizor = '$_POST[oname]', e_date = '$_POST[edate]', 
            phone_no = '$_POST[phone_no]', status = '0' , e_desc ='$_POST[edesc]', sponsor = '$_POST[sname]' ,
            `image` = '$pic' where eid = $eid ;";
            $r = run_sql($query);
            echo "Event Updated";
        } else {
            $query = "INSERT INTO events 
            (`e_name`, `e_addr`, `e_organizor`, `e_date`, `phone_no`, `status`, `e_desc`, `sponsor`, `image`) 
            VALUES ('$_POST[name]', '$_POST[addr]', '$_POST[oname]', '$_POST[edate]', '$_POST[phone_no]', '0', '$_POST[edesc]',
            '$_POST[sname]', '$pic');";
            $r = run_sql($query);
            echo "Event Submitted";
        }
        // $msg = "<h3>$_POST[name] is on $_POST[edate] at $_POST[addr]</h3>";
        // //for send email to all students
        // $query = "select * from app_users where user_name != 'admin' order by uid desc ";
        // $res = run_sql($query);
        // while ($row = mysqli_fetch_array($res)) {
        //     mail_it("$row[email]", "New Event is Added!", $msg);
        // }
    }
}
//delete data
if (isset($_POST['table'])) {
    $table = $_POST['table'];
    $table_id = $_POST['table_id'];
    $id = $_POST['id'];
    echo $query = "update `$table` set status = 1  where $table_id = $id;";
    $r = run_sql($query);
}