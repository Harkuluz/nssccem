<?php
require_once './header.php';
if (isset($_POST["email"])) {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_MAGIC_QUOTES);
    $pass = filter_var($_POST["pass"], FILTER_SANITIZE_MAGIC_QUOTES);
    $query = "select * from app_users 
    where email = '$email' 
    and pass = '$pass' and status = 'approved'";
    $r = run_sql($query);
    if (mysqli_num_rows($r) > 0) {
        $row = mysqli_fetch_array($r);
        $_SESSION["uname"] = $row["user_name"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["role"] = $row["role"];
        redirect("index.php");
        echo "string";
    } else {
        $err = "Incorrect User Name or Password!!";
        redirect("login.php?msg=4");

    }
}else{
    redirect("login.php");
}