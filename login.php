<title>Login</title>
<?php
$currentPage = 'login';
require_once './header.php';
?>
<?php
if (is_login()) {
    redirect("logout.php");
}
$msg = "";
if (isset($_REQUEST["msg"])) {
    if ($_REQUEST["msg"] == 1) {
        $msg = "Your password has been sent!";
    } else if ($_REQUEST["msg"] == 2) {
        $msg = "Your password has been changed!";
    } else if ($_REQUEST["msg"] == 3) {
        $msg = "Registration Successful!";
    } else if ($_REQUEST["msg"] == 4) {
        // $msg = "Registration Successful!";
        $err = "Incorrect User Name or Password!!";
    }
}
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
    } else {
        $err = "Incorrect User Name or Password!!";
    }
}
?>
<STYle>
/*Login Design*/

.loginContainer {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    perspective: preserve-3d;
    height: 80vh;
}

.loginBody {
    background: linear-gradient(-224deg, #11ddff 25%, #0011ff 66%);
    height: 380px;
    width: 380px;
    /*margin-top: 9%;*/
    box-shadow: #616bff8a 8px 4px 10px 2px;
    -moz-transform: rotateY(0deg) rotate(45deg);
    -ms-transform: rotateY(0deg) rotate(45deg);
    -webkit-transform: rotateY(0deg) rotate(45deg);
    transform: rotateY(0deg) rotate(45deg);
    /*transform: rotateX(46deg);*/
    display: flex;
    align-items: center;
    justify-content: center;
}

.loginBody:hover {
    background-color: red;
    /*transform: rotateY(180deg) rotate(45deg);*/
}


.loginHead {
    /*position: absolute;*/
    top: 0;
    transform-style: preserve-3d;
    /*background: linear-gradient(#11ddff, #0011ff);*/
    /*background-color: green;*/
    width: 200px;
}


.loginCol {
    position: relative;
    bottom: -17px;
    left: 10px;
    -moz-transform: rotate(-45deg);
    -ms-transform: rotate(-45deg);
    -webkit-transform: rotate(-45deg);
    transform: rotate(-45deg);
    transform-style: preserve-3d;
    /*backface-visibility: hidden;*/
}

.myheadLogin {
    /*background: linear-gradient(45deg,#ff3322,20%,#0011ff,30%,#ff3322);*/
    background: repeating-linear-gradient(45deg, #0400ff, 50%, #7d86f1 100%, #0013fd);
    border: red 5px 3px 13px 3px;
    /*border-top-color: green;*/
    box-shadow: #1816fc57 5px 5px 8px 2px;
    border-width: 5px;
    font-size: 35px;
    border-radius: 30px 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    -moz-right: -10px;
    position: relative;
    font-weight: bold;
    font-family: Georgia, 'Times New Roman', Times, serif
}

.myheadLogin:hover {
    background: #2420fd;
    /* cursor: pointer; */
}

.loginBody input.form-control {
    /*background-color: #00ff3c;*/
    /*color: white;*/
    display: block;
    width: 100%;
    margin-left: 1px;
}

.loginBody input[type=submit].form-control {
    /*background-color: #00ff3c;*/
    background: repeating-linear-gradient(45deg, #00ff3c, 50%, #9cff7d 100%, #00ff3c);
    color: white;
    font-weight: bold;
}

.loginBody input[type=submit]:hover {
    background: #00ff33;
}

.loginBody a.btn {
    /* background-color: orangered; */
    background: repeating-linear-gradient(45deg, orangered, 50%, #ffa6a6ef 100%, orangered);
    color: white;
    margin-bottom: -5px;
    font-weight: bold;
}

.loginBody a.btn:hover {
    background: orangered;
}

.loginBody a:not(.btn) {
    color: white;
    display: flex;
    justify-content: center;
    margin: -10px;
}

#error {
    color: yellow;
    font-size: 16px;
    margin-top: -10px;
}

@media only screen and (max-width: 768px) {

    /*Login Design*/
    .loginBody {
        height: 300px;
        width: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .loginHead {
        width: 180px;
    }

    .loginCol {
        position: relative;
        bottom: -13px;
        left: 8px;
        -moz-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
        transform-style: preserve-3d;
        /*backface-visibility: hidden;*/
    }

    .myheadLogin {
        padding: 0.215rem .30rem;
        border-width: 5px;
        font-size: 20.5px;
        border-radius: 25px 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .loginBody form {
        width: 180px;
    }

    .loginBody input.form-control {
        background-color: #00ff3c;
        /*color: white;*/
        display: block;
        width: 100%;
        margin-left: 0.5px !important;
        padding: 0.215rem .30rem;
        margin: -5px;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        -moz-transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        -ms-transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        -webkit-transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .loginBody input[type=submit].form-control {
        /*background-color: #00ff3c;*/
        color: white;
        margin: -5px;
        margin-top: -15px;
    }

    .loginBody a.btn {
        background-color: orangered;
        color: white;
        padding: 0.215rem .30rem;
        width: 180px;
    }

    .loginBody a:not(.btn) {
        color: white;
        display: flex;
        justify-content: center;
        margin: -10px;
    }

    #error {
        color: yellow;
        font-size: 13.5px;
    }
}

@media only screen and (max-width: 440px) {

    /*Login Design*/
    .loginBody {
        height: 220px;
        width: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .loginHead {
        width: 130px;
    }

    .loginCol {
        position: relative;
        bottom: -4px;
        left: 1px;
        -moz-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        transform: rotate(-45deg);
        -moz-transform-style: preserve-3d;
        -ms-transform-style: preserve-3d;
        transform-style: preserve-3d;
        /*backface-visibility: hidden;*/
    }

    .myheadLogin {
        background: repeating-linear-gradient(45deg, #0400ff, 50%, #7d86f1 100%, #0013fd);
        /*border: red  5px 3px 13px 3px;*/
        /*border-top-color: green;*/
        padding: 0.115rem .20rem;
        box-shadow: #1816fc57 5px 5px 8px 2px;
        border-width: 5px;
        font-size: 15.5px;
        border-radius: 18px 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .loginBody form {
        width: 130px;
    }

    .loginBody input.form-control {
        background-color: #00ff3c;
        /*color: white;*/
        display: block;
        width: 100%;
        padding: 0.105rem .20rem;
        margin: -7px;
        font-size: 0.85rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        -moz-transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        -ms-transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .loginBody input[type=submit].form-control {
        /*background-color: #00ff3c;*/
        color: white;
        margin: -7px;
        margin-top: -23px;
    }

    .loginBody input[type=submit]:hover {
        background: #00ff3c;
    }

    .loginBody a.btn {
        background-color: orangered;
        color: white;
        padding: 0.105rem .20rem;
        width: 130px;
        font-size: 14px;
    }

    .loginBody a:not(.btn) {
        color: white;
        display: flex;
        justify-content: center;
        margin: -10px;
    }

    #error {
        color: yellow;
        font-size: 11px;
        margin-top: -13px;
        margin-bottom: 22px;
    }
}

button.close {
    -moz-transform: translateY(-13px);
    -ms-transform: translateY(-13px);
    transform: translateY(-13px);
}
</STYle>
<div class="loginContainer">
    <div class="loginBody">
        <div class="loginCol">
            <div class="loginHead">
                <div class="myheadLogin">Login</div>
                <hr>
            </div>
            <div class="loginForm">
                <form method="post" onsubmit="return checklogin(this)">
                    <input class="form-control" type="text" name="email" id="email" placeholder="EMail" /><br>
                    <input class="form-control" type="password" name="pass" id="password" placeholder="Password" /><br>
                    <?php
                    if (!empty($msg)) {
                    ?>
                    <script>
                    $.alert({
                        title: 'Message!',
                        content: '<?php echo $msg ?>',
                        type: 'blue',
                        typeAnimated: true,
                        closeIcon: true,
                        closeIconClass: 'fa fa-close',
                    });
                    </script>
                    <?php

                    }
                    ?>
                    <input class="form-control" type="submit" value="Login" /><br>
                    <!-- <input class="form-control btn btn-success btn-block" type="submit" value="Login"/><br> -->
                    <a class="btn btn-block" href="login.php">Reset</a><br>
                    <!-- <a class="btn btn-danger btn-block" href="login.php">Reset</a><br> -->
                    <a href="reg.php">Register Now</a><br>
                    <a href="forgot_pass.php">Forgot Password</a><br>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once './footer.php'; ?>
<script>
function checklogin(thiss) {
    console.log(thiss);
    event.preventDefault();
    let email = document.querySelector("#email").value;
    let password = document.querySelector("#password").value;
    $.ajax({
        url: "ajax.php",
        method: "POST",
        data: {
            checklogin: 1,
            email: email,
            pass: password,
        },
        success: function(data) {
            console.log("os" + data + "<?php echo "T_T" . $_SESSION['email'] ?>");
            if (data == "pass") {
                thiss.submit();
            } else {
                $.alert({
                    title: 'Alert!',
                    content: 'Incorrect User Name or Password!!',
                    type: 'red',
                    typeAnimated: true,
                    closeIcon: true,
                    closeIconClass: 'fa fa-close',
                });
            }
        },
        failure: function(data) {
            $.alert({
                title: 'Alert!',
                content: 'Oops Something went wrong !!!',
                type: 'red',
                typeAnimated: true,
                closeIcon: true,
                closeIconClass: 'fa fa-close',
            });
        }
    })
    return false;
}
</script>