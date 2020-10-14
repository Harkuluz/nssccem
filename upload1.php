<title>Upload Photos</title>
<?php require_once './header.php'; ?>
<?php
//check_admin();
check_login();
$err = "";
//if (isset($_FILES["at1"])) {
////if (isset($_POST["name"])) {
//    if (check_img() != null) {
//        $err = check_img();
//    } else {
//        $query = "INSERT INTO `photo`(`name`,`date`) 
//       VALUES ('$_POST[name]_$_POST[date]','$_POST[date]');";
//        $r = run_sql($query);
////        $id = mysqli_insert_id($con);
//        $id = "$_POST[name]_$_POST[date]"; 
//        if (isset($_FILES["at1"]) && empty($_FILES["at1"]["name"]) != true) {
//            move_uploaded_file($_FILES["at1"]["tmp_name"], "upload/$id.jpg");
//        }
//        redirect("gallery.php?msg=2");
//    }
//}

if (isset($_FILES["photo"])) {
//if (isset($_POST["name"])) {
    if (check_img() != null) {
        $err = check_img();
    } else {
        $query = "INSERT INTO `photo`(`name`,`date`) 
       VALUES ('$_POST[name]_$_POST[date]','$_POST[date]');";
        $r = run_sql($query);
//        $id = mysqli_insert_id($con);
        $id = "$_POST[name]_$_POST[date]"; 
//        if (isset($_FILES["at1"]) && empty($_FILES["at1"]["name"]) != true) {
//            move_uploaded_file($_FILES["at1"]["tmp_name"], "upload/$id.jpg");
//        }
        $maxDimW = 500;
        $maxDimH = 250;
    list($width, $height, $type, $attr) = getimagesize( $_FILES['photo']['tmp_name'] );
    if ( $width > $maxDimW || $height > $maxDimH ) {
        $target_filename = $_FILES['photo']['tmp_name'];
        $fn = $_FILES['photo']['tmp_name'];
        $size = getimagesize( $fn );
        $ratio = $size[0]/$size[1]; // width/height
        if( $ratio > 1) {
            $width = $maxDimW;
            $height = $maxDimW/$ratio;
        } else {
            $width = $maxDimW*$ratio;
            $height = $maxDimW;
        }
        $src = imagecreatefromstring(file_get_contents($fn));
        $dst = imagecreatetruecolor( $width, $height );
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
        imagejpeg($dst, $target_filename); // adjust format as needed
}
//move_uploaded_file($_FILES['pdf']['tmp_name'],"pdf/".$_FILES['pdf']['name']);
move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/$id.jpg");
//redirect("gallery.php?msg=2");
//    echo 'success';   
        redirect("gallery.php?msg=2");
    }
}

//if(isset($_FILES["photo"])){
//$maxDimW = 100;
//$maxDimH = 50;
//list($width, $height, $type, $attr) = getimagesize( $_FILES['photo']['tmp_name'] );
//if ( $width > $maxDimW || $height > $maxDimH ) {
//    $target_filename = $_FILES['photo']['tmp_name'];
//    $fn = $_FILES['photo']['tmp_name'];
//    $size = getimagesize( $fn );
//    $ratio = $size[0]/$size[1]; // width/height
//    if( $ratio > 1) {
//        $width = $maxDimW;
//        $height = $maxDimH/$ratio;
//    } else {
//        $width = $maxDimW*$ratio;
//        $height = $maxDimH;
//    }
//    $src = imagecreatefromstring(file_get_contents($fn));
//    $dst = imagecreatetruecolor( $width, $height );
//    imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
//    imagejpeg($dst, $target_filename); // adjust format as needed
//}
////move_uploaded_file($_FILES['pdf']['tmp_name'],"pdf/".$_FILES['pdf']['name']);
//move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/$id.jpg");
////redirect("gallery.php?msg=2");
//    echo 'success';
//}
?>
<div class="row">    
    <div class="col-sm-8 offset-sm-2">    
        <h1 class="myhead2">Add Photos</h1>
        <hr>
        <form method="post" enctype="multipart/form-data">
            <label>Photo Name</label>
            <input required class="form-control" type="text" value="<?php echo $_POST["name"] ?>" name="name"/>
            <input type="hidden" name="date" value="<?php echo date('Y-m-d H-i-s') ?>" />
            <h4 style="color: red;"><?php echo $err; ?></h4>
            <input class="form-control" type="file" name="photo" placeholder="Image"/><br>     
            <button type="submit" class="btn btn-primary btn-block" >Submit</button>
        </form>
    </div>
</div>
<?php require_once './footer.php';