<?php
require_once './include/const.php';
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or exit('could not connect');
echo "connected<br>";

$query = "drop schema if exists $dbname ";
$r = mysqli_query($con, $query) or exit(mysqli_error($con));
echo "db dropped<br>";

$query = "create schema $dbname ";
$r = mysqli_query($con, $query) or exit(mysqli_error($con));
echo "db created<br>";

mysqli_select_db($con, $dbname);

$query = "CREATE  TABLE app_users (
  uid INT NOT NULL AUTO_INCREMENT ,
  user_name VARCHAR(45) NULL ,
  email VARCHAR(100) NULL ,  
  pass VARCHAR(45) NULL ,
  phone_no VARCHAR(45) NULL ,
  sec_q VARCHAR(200) NULL ,
  sec_a VARCHAR(100) NULL ,
  role VARCHAR(45) NULL ,
  branch VARCHAR(200) NULL ,
  dp VARCHAR(200) NULL ,
  sem VARCHAR(100) NULL ,
  status VARCHAR(45) NULL ,
  PRIMARY KEY (uid) ,
  UNIQUE INDEX email_UNIQUE (email ASC) );";
$r = mysqli_query($con, $query) or exit(mysqli_error($con));
echo "table created<br>";

$query = "insert into app_users(user_name, email, pass, phone_no, branch, sem, sec_q, sec_a, role, status ) values "
        . "                   ('admin', 'admin', 'ABcd12!@', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'approved') ";
$r = mysqli_query($con, $query) or exit(mysqli_error($con));
echo "inserted<br>";

$query = "CREATE  TABLE events (
  eid INT NOT NULL AUTO_INCREMENT ,
  e_name VARCHAR(45) NULL ,
  e_addr VARCHAR(100) NULL ,  
  e_organizor VARCHAR(100) NULL ,  
  e_date date NULL ,  
  phone_no VARCHAR(45) NULL ,
  status VARCHAR(45) NULL ,
  e_desc TEXT NULL ,
  sponsor VARCHAR(200) NULL ,
  PRIMARY KEY (eid));";
$r = mysqli_query($con, $query) or exit(mysqli_error($con));
echo "table created<br>";


$query = "CREATE  TABLE events_vol (
  id INT NOT NULL AUTO_INCREMENT ,
  eid INT NULL ,
  uname VARCHAR(100) NULL ,  
  email VARCHAR(100) NULL ,  
  FOREIGN KEY (eid) REFERENCES events (eid),
  PRIMARY KEY (id));";
$r = mysqli_query($con, $query) or exit(mysqli_error($con));
echo "table created<br>";

$query = "CREATE  TABLE photo (
  id INT NOT NULL AUTO_INCREMENT ,
  name VARCHAR(100) NULL ,  
  email VARCHAR(100) NULL , 
  date datetime not null,
  PRIMARY KEY (id));";
$r = mysqli_query($con, $query) or exit(mysqli_error($con));
echo "pic table created<br>";

$query = "CREATE  TABLE comments (
  cid INT NOT NULL AUTO_INCREMENT ,
  name VARCHAR(100) NULL ,
  date datetime not null,  
  comment TEXT NULL ,
  uid INT ,  
  FOREIGN KEY (uid) REFERENCES app_users(uid),
  PRIMARY KEY (cid));";
$r = mysqli_query($con, $query) or exit(mysqli_error($con));
echo "comments table created<br>";

$query = "CREATE  TABLE reply (
  rid INT NOT NULL AUTO_INCREMENT ,
  name VARCHAR(100) NULL ,
  date datetime not null,  
  reply TEXT NULL ,
  cid INT ,  
  FOREIGN KEY (cid) REFERENCES comments(cid),
  PRIMARY KEY (rid));";
$r = mysqli_query($con, $query) or exit(mysqli_error($con));
echo "reply table created<br>";

// Table for links

$query = "CREATE  TABLE links (
  id INT NOT NULL AUTO_INCREMENT ,
  name VARCHAR(100) NULL ,
  path VARCHAR(200) NULL,
  PRIMARY KEY (id));";
$r = mysqli_query($con, $query) or exit(mysqli_error($con));
echo "links table created<br>";

$query = "insert into links(name, path) values "
          . "('Home', 'index.php'), "
          . "('About Us', 'about.php'), "
          . "('Events', 'events.php'), "
          . "('Gallery', 'gallery.php')";
$r = mysqli_query($con, $query) or exit(mysqli_error($con));
echo "inserted<br>";
