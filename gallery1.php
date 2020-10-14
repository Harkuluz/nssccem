<title>Gallery</title>
<?php
$currentPage = 'gallery'; 
require_once './header.php'; ?>
<?php
if (is_admin()or is_login()) {
    echo "<a href='./upload.php' class='btn btn-dark text-white my-3'>Add New Photo</a>";
}
?>
<div class="row">
    <div class="offset-md-2 col-md-8">
        <h1 class="myhead2">Photo Gallery</h1>
        <?php
        $query = "select * from photo $whr order by id desc;";
        $r = run_sql($query);
        $brd = "style='border-color: black; border-width: 3px; border-style: solid; font-size: 25px; text-align: center;'";
        while ($row = mysqli_fetch_array($r)) {
//            echo"<div class='col-md-4 text-center float-left p-3'>
//              <div class='card shd anim1'>
//                 <div class='card-body'>
//                   <a title='$row[name]' href='upload/$row[name].jpg'data-lightbox='uping'><img class='card-img-top shd img-fluid' src='upload/$row[name].jpg'/>
//                 </div>
//               </div>
//            </div> ";
            
            echo"<div class='col-md-4 text-center float-left p-3'>
             <div class='card shd anim1'>
              <div class='card-body'>
               <img id='myImg' onclick='gallFun(this)' class='card-img-top shd img-fluid' src='upload/$row[name].jpg' alt='$row[name]'style='width:100%;max-width:300px'/>
              </div>
             </div>
            </div> ";
            $imgSrc[] = "upload/$row[name].jpg";

              
//            $firstN = array();
//$min = 1;
//$max = 3;
//$number1 = rand($min, $max);
//for ($i = 0; $i < $number1; $i++){
//    $firstN[] = "<img src='upload/$row[name].jpg' border='0' id='myImg' onclick='gallFun(this)'alt='$row[name]'>";
//    $imgSrc[] = "upload/$row[name].jpg";
//}   
//echo $firstN[0];
        }
        ?>
    </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
<!--  <input id="previous" type="button" value="<< Prev" name="cb_prev" onclick="f_slideshow(-1)">-->
  <a href="#" class="previous round" value="<< Prev" name="cb_prev" onclick="f_slideshow(-1)">&#8249;</a>

  <!--<input id="next" type="button" value="Next >>" name="cb_next" onclick="f_slideshow(1)">-->
  <a href="#" class="next round"  name="cb_next" onclick="f_slideshow(1)">&#8250;</a>

  <div id="caption"></div>
</div>
<script>
//image array
var imgArray = <?php echo json_encode($imgSrc); ?>;
//alert(imgArray[0]);

// Get the modal
var modal = document.getElementById("myModal");
// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");



//img.onclick = function(){
function gallFun(pic){
  modal.style.display = "block";
//  modalImg.src = this.src;
//  captionText.innerHTML = this.alt;
    modalImg.src = pic.src;
    captionText.innerHTML = pic.alt;
  };
  ///new///
numImages = 8;
curImage = 1;

function f_slideshow( xflip ) {
curImage = curImage + xflip;
if (curImage > numImages)
{ curImage = 1 ; } 
if (curImage === 0)
{ curImage = numImages ; } 
//document.images[2].src = imgArray[curImage - 1];
    modalImg.src = imgArray[curImage - 1];
//    captionText.innerHTML = pic.alt;
}
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
};
</script>
<!--
<script>
    $(document).ready(function() {

if ((screen.width>=1024) && (screen.height>=768)) {
}
else {
    lightbox.option({
      'resizeDuration': 200,
      'positionFromTop': 200,
      'fitImagesInViewport': true
    });
}
});
</script>-->
<?php require_once './footer.php';