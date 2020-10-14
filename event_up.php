<?php require_once './header.php'; ?>
<?php
check_admin();
if (!isset($_REQUEST["id"])) {
    redirect("index.php");
}
$query = "select * from events where eid = $_REQUEST[id]";
$r = run_sql($query);
$orow = mysqli_fetch_array($r);

$err = "";
if (isset($_POST["name"])) {
    if (check_img() != null) {
        $err = check_img();
    } else {
        $query = "update events set
    e_name = '$_POST[name]', e_addr = '$_POST[addr]', e_organizor = '$_POST[oname]', e_date = '$_POST[edate]', 
    phone_no = '$_POST[phone_no]', status = 'new' , e_desc ='$_POST[edesc]', sponsor = '$_POST[sname]' 
    where eid = $_REQUEST[id] ;";
        $r = run_sql($query);
        $lid = $_REQUEST["id"];
        if (isset($_FILES["at1"]) && empty($_FILES["at1"]["name"]) != true) {
            move_uploaded_file($_FILES["at1"]["tmp_name"], "upload/e_$lid.jpg");
        }
        redirect("events.php?msg=4");
    }
}
?>
<div class="row">    
    <div class="col-sm-8 offset-sm-2">    
        <h1 class="myhead2">Event Update</h1>
        <hr>
        <form method="post" enctype="multipart/form-data">
            <input required class="form-control" type="text" value="<?= $orow["e_name"] ?>" name="name" placeholder="Event Name"/><br>
            <input required class="form-control" type="text" value="<?= $orow["e_organizor"] ?>" name="oname" placeholder="Organizer Name"/><br>
            <input required class="form-control" pattern="0?[7-9]{1}\d{9}" type="tel" value="<?= $orow["phone_no"] ?>" name="phone_no" placeholder="Contact No"/><br>
            <input class="form-control" type="text" value="<?= $orow["sponsor"] ?>" name="sname" placeholder="Sponser Name"/><br>
            <input required  min="<?= date("Y-m-d") ?>" class="form-control" type="date" value="<?= $orow["e_date"] ?>" name="edate" placeholder="Event Date"/><br>      
            <input required class="form-control" type="text" value="<?= $orow["e_addr"] ?>" name="addr" placeholder="Addrress"/><br>     
            <textarea rows="4" class="form-control" name="edesc" placeholder="Description"><?= $orow["e_desc"] ?></textarea>
            <img style="height: 300px;" class="img img-fluid rounded" src="upload/e_<?= $_REQUEST["id"] ?>.jpg" />
            <h3>Change Image</h3>
            <input class="form-control" type="file" name="at1" placeholder="Image"/><br>     
            <h4 style="color: red;"><?php echo $err; ?></h4>
            <button type="submit" class="btn btn-primary btn-block" >Submit</button>
            <a class="btn btn-danger btn-block" href="event_add.php">Reset</a>
        </form>
    </div>
</div>    
<?php require_once './footer.php'; ?>

