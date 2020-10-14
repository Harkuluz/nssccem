<title>Home</title>
<?php
$currentPage = 'index';
require_once './header.php'; ?>
<?php
if (!empty($msg)) {
    echo "<div class='alert alert-success alert-dimdissible fade show'>
    <button class='close' data-dimdiss='alert'>&times;</button>
    <strong>NSS CCEM</strong> $msg
    </div>";
}
?>
<?php
$msg = "";
if (isset($_REQUEST["msg"])) {
    if ($_REQUEST["msg"] == 1) {
        $msg = "Profile Updated Successfully!";
    }
}
if (!empty($msg)) {
    echo "<div class='alert alert-success alert-dismissible fade show'>
    <button class='close' data-dismiss='alert'>&times;</button>
    <strong>$msg</strong> 
    </div>";
}
?>

<div class="col-md-8 offset-md-2 mb-3">
    <div class="carousel slide" data-ride="carousel" id="car1">
        <ul class="carousel-indicators">
            <li data-target="#car1" data-slide-to="0" class="active"></li>
            <li data-target="#car1" data-slide-to="1"></li>
            <li data-target="#car1" data-slide-to="2"></li>
        </ul>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="img-fluid" src="images/ccem_h2.jpg " />
            </div>
            <div class="carousel-item">
                <img class="img-fluid" src="images/ccem_h3 .jpg" />
            </div>
            <div class="carousel-item">
                <img class="img-fluid" src="images/ccem.jpg" />
            </div>
        </div>
        <a href="#car1" data-slide="prev" class="carousel-control-prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a href="#car1" data-slide="next" class="carousel-control-next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</div>
<div class="carousel slide bg-dark text-center text-white pt-2 sol" data-ride="carousel" id="ca1">
    <div class="carousel-inner">
        <div class="carousel-item active">
            NOT ME BUT YOU
        </div>
        <div class="carousel-item">
            Clean India Beautiful India.
        </div>
        <div class="carousel-item">
            This is My city, keep clean in my city is my duty.
        </div>
        <div class="carousel-item">
            Healthy water, healthy habbit, healthy people, healthy society.
        </div>
    </div>
    <a href="#ca1" data-slide="prev" class="carousel-control-prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a href="#ca1" data-slide="next" class="carousel-control-next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>
<div class="row">
    <div class="col-md-3 head2 px-5">
        <h1>Welcome to</h1>
        <h3>National Service Scheme</h3>
    </div>
    <div class="col-md-9 px-5">
        <p style="text-align: justify">
            The National Service Scheme (NSS) is a Central Sector Scheme of Government of India, Ministry of Youth
            Affairs & Sports. It provides opportunity to the student youth of 11th & 12th Class of schools at +2 Board
            level and student youth of Technical Institution, Graduate & Post Graduate at colleges and University level
            of India to take part in various government led community service activities & programmes.The sole aim of
            the NSS is to provide hands on experience to young students in delivering community service. Since inception
            of the NSS in the year 1969, the number of students strength increased from 40,000 to over 3.8 million up to
            the end of March 2018 students in various universities, colleges and Institutions of higher learning have
            volunteered to take part in various community service programmes.
            <a href="about.php">Read More</a>
        </p>
    </div>

</div>
<br clear="all">
<div class="row">
    <div class="col-md-12 head2 px-5">
        <h4>The NSS Badge Proud to Serve the Nation:</h4>
    </div>
    <br clear="all">
    <div class="col-md-3 px-5">
        <img class="one" src="images/NSS.png">
    </div>

    <div class="col-md-9 px-5">
        <p>
            All the youth volunteers who opt to serve the nation through the NSS led community service wear the NSS
            badge with pride and a sense of responsibility towards helping needy.
        </p>
        <P>
            The Konark wheel in the NSS badge having 8 bars signifies the 24 hours of a the day, reminding the wearer to
            be ready for the service of the nation round the clock i.e. for 24 hours.
        </P>
        <p>
            Red colour in the badge signifies energy and spirit displayed by the NSS volunteers.
        </p>
        <p>
            The Blue colour signifies the cosmos of which the NSS is a tiny part, ready to contribute its share for the
            welfare of the mankind.
        </p>
    </div>
</div>
<br clear="all">
<div class="row">
    <div class="col-md-6 offset-md-3">
        <a href="events.php">
            <div class="col-md-6 text-center float-left p-3">
                <div class="card shd anim1">
                    <div class="card-body">
                        <img class="card-img-top shd img-fluid" src="images/events.jpg" />
                    </div>
                </div>
            </div>
        </a>
        <a href="reg.php">
            <div class="col-md-6 text-center float-left p-3">
                <div class="card shd anim1">
                    <div class="card-body">
                        <img class="card-img-top shd img-fluid" src="images/joinus.jpg" />
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<?php require_once './footer.php';