<title>Event Info</title>
<?php require_once './header.php'; ?>
<?php
$query = "select * from events where eid = $_REQUEST[id]";
$res = run_sql($query);
$row = mysqli_fetch_array($res);
?>

<?php
$msg = "";
if (isset($_REQUEST["msg"])) {
    if ($_REQUEST["msg"] == 1) {
        $msg = "Thanks for informing!";
    }
}
if (!empty($msg)) {
    echo "<div class='alert alert-success alert-dismissible fade show'>
    <button class='close' data-dismiss='alert'>&times;</button>
    <strong>NSSCCEM</strong> $msg
    </div>";
}
?>

<h1 class="myhead2"><?= $row['e_name'] ?></h1>
<div class="row">
    <div class="col-sm-6">
        <p>
            <strong>Event</strong> : <?= $row["e_name"] ?><br>
            <strong>Organizer</strong> : <?= $row["e_organizor"] ?><br>
            <strong>Contact No</strong> : <?= $row["phone_no"] ?><br>
            <strong>Date</strong> : <?= $row["e_date"] ?><br>
            <strong>Event Venue</strong> : <?= $row["e_addr"] ?><br>
            <strong>Description</strong> : <?= $row["e_desc"] ?><br>
            <strong>Sponsor</strong> : <?= $row["sponsor"] ?><br>
            <br><br>
            <?php
            if (is_login()) {
                $interested = false;
                $query3 = "select * from events_vol where eid = $_REQUEST[id] and email = '$_SESSION[email]'";
                $r = run_sql($query3);
                if (mysqli_num_rows($r) > 0) {
                    $interested = true;
                }
                if ($interested) {
                    echo "<a href='./remove_interested.php?id=$_REQUEST[id]' class='btn btn-danger text-white my-3 mx-3'>Unable To Come</a>";
                } else {
                    echo "<a href='./add_interested.php?id=$_REQUEST[id]' class='btn btn-danger text-white my-3 mx-3'>Interested To Come</a>";
                }
            }
            ?>
        </p>
    </div>
    <div class="col-sm-6">
        <img class="img img-fluid rounded" src="<?= $row['image'] ?>" />
    </div>
</div>
<a class="btn btn-dark my-3" href='events.php'>Back</a>
<?php
if (is_admin()) {
    $no = 0;
    $query4 = "select * from events_vol where eid = $_REQUEST[id]";
    $r = run_sql($query4);
    if (mysqli_num_rows($r) > 0) {
        $no = mysqli_num_rows($r);
        echo "<h1 class='my-3'>Interested Members <span class='badge badge-pill badge-dark'>$no</span></h1>";
        echo "<hr>";
        echo "<table class='table table-striped'>";
        while ($row = mysqli_fetch_array($r)) {
            echo "    <tr>
                <td>$row[uname]</td>
                <td>$row[email]</td>
            </tr>";
        }
        echo "</table>";
    }
}
?>
<hr />

<!-- ==========================Comments =============================================-->
<div class="commentContainer">
    <?php
    if (isset($_POST["comment"])) {
        echo  $query = "INSERT INTO comments (cid ,eid,name,date, comment) 
    VALUES ('$_POST[cid]','$_REQUEST[id]','$_POST[user_name]','$_POST[date]','$_POST[comment]');";
        $r = run_sql($query);
        redirect("event_det.php?id=$row[eid]");
    }
    ?>
    <?php
    if (is_login()) {
        if (isset($_SESSION['uname'])) {
    ?>
    <div class="panel panel-default">
        <div class="panel-heading mb-3">
            <h1>Comments</h1>
        </div>
        <div class="panel-body">
            <form method="post">
                <div class="form-group">
                    <input type="hidden" name="cid" />
                    <input type="hidden" name="user_name" value="<?php echo $_SESSION["uname"] ?>" />
                    <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s') ?>" />
                    <textarea name="comment" id="comment" placeholder="Write your comment" /></textarea><br />
                    <button type="submit" class="btn btn-dark text-white ">Comment</button>
                </div>
            </form>
        </div>
    </div>
    <?phP
        }
    } else {
        // echo "You need to loggen in to comment";
        ?>
    <div class="panel panel-default">
        <div class="panel-heading mb-3">
            <h1>Comments</h1>
        </div>
        <div class="panel-body">
            <form method="post">
                <div class="form-group">
                    <input type="hidden" name="cid" />
                    <input type="text" placeholder="Enter Your Name" name="user_name" /><br />
                    <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s') ?>" />
                    <textarea name="comment" id="comment" placeholder="Write your comment" /></textarea><br />
                    <button type="submit" class="btn btn-dark text-white ">Comment</button>
                </div>
            </form>
        </div>
    </div>
    <?php

    }
    $query1 = "SELECT * FROM comments where eid = '$_REQUEST[id]' order by cid desc;";
    $r1 = run_sql($query1);
    while ($row = mysqli_fetch_array($r1)) {
        echo nl2br("<div class='com'><b>$row[name]</b><br>$row[date]<p>$row[comment]</p>");
        echo "<br>";

        echo "</div>
          </div>
        </div>
      </div>";
    }
    ?>
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
    <?php require_once './footer.php'; ?>