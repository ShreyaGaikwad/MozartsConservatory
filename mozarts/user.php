<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
     <title>Home</title>
     <link rel="stylesheet" type="text/css" href="style2.css">
	 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
     <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
* {
    box-sizing: border-box;
}
.column {
    float: left;
    width: 25%;
    padding: 10px;
    height: 300px; /* Should be removed. Only for demonstration */
}
.row:after {
    content: "";
    display: table;
    clear: both;
}
.basic{
    background-color: rgba(0,128,128,0.5);
	color: white;
	box-shadow: 5px 10px 16px 10px rgba(256,147,256,0.2);
	padding:10px;
	border-radius:50px;
	}


.card-container {
  cursor: pointer;
  height: 100%;
  perspective: 600;
  position: relative;
  width: 100%;
}
.card {
  height: 100%;
  position: absolute;
  transform-style: preserve-3d;
  transition:all 1s ease-in-out;
  width: 100%;
}
.card:hover {
  transform: rotateY(180deg);
}
.card .side {
  backface-visibility: hidden;
  border-radius: 6px;
  height: 100%;
  position: absolute;
  overflow: hidden;
  width: 100%;
}
.card .back {
  background: #093145;
  color: white;
  line-height: 35px;
  text-align: center;
  transform: rotateY(180deg);
}

</style>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-132203373-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-132203373-1');
</script>


</head>

  <body style=" background-image: linear-gradient(to bottom left, #333399 20%, #ff0066 81%);">
   <header>
     <div class="logo"><h5>Mozart's Conservatory</h5></div>
      
      <nav>
       <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="aboutus.html">About Us</a></li>
          <li class="sub-menu"><a href="#">Programes</a>
            <ul>
              <li><a href="piano.html">Piano</a></li>
              <li><a href="violin.html">Violin</a></li>
              <li><a href="guitar.html">Guitar</a></li>
              <li><a href="vocals.html">Vocal</a></li>
            </ul>
          </li>
        <li><a href="Band-it-festival.html">Band Festival</a></li>
        <li><a href="contactus.html">Contact Us</a></li>
        <li style="color:white:">
        <?php 
        session_start();
        if(isset($_SESSION['mz_username'])){
            echo '<a href="logout.php"><span>' . $_SESSION['mz_name']. ' (Logout)</span></a></li>';
            }
        else{
        echo '<a href="login.html"><span>Login</span></a></li>';}
        ?>
            </ul>
     </nav>
     <div class="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></div>
   </header>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
       $('.menu-toggle').click(function(){
         $('nav').toggleClass('active')
       })
        $('ul li').click(function(){
          $(this).siblings().removeClass('active');
          $(this).toggleClass('active');
        })
    })
  </script>
  <br>
  <br>
<form action="" method="POST" enctype="multipart/form-data">
    <h2 align="center">Image insertation..</h2>
    <table align="center">
        <tr>
            <td><label>Image</label></td>
            <td><label>:</label></td>
            <td><label><input type="file" name="imageUpload" id="imageUpload"></label></td>
        </tr>
        <tr>
            <td><label></label></td>
            <td><label></label></td>
            <td><label><input type="submit" name="save_btn" value="SAVE"/></label></td>
        </tr>
    </table>
</form>
<?php
session_start();
if(isset($_SESSION['mz_username'])){
    if(isset($_POST['save_btn'])) {

    //Process the image that is uploaded by the user

    $target_dir = "pics/";
    $target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["imageUpload"]["name"]). " has been uploaded.";
    } else {
        echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
	}

    $image=basename( $_FILES["imageUpload"]["name"],".jpg"); // used to store the filename in a variable
    $con = mysqli_connect("localhost","id7295435_mozartsconservatory","lijinjoy","id7295435_mozarts");
    $username = $_SESSION['mz_username'];
    $query= mysqli_query($con,"UPDATE user SET image = '$image' WHERE username = '$username' ");
    header("refresh:0; url=profilo.php");
}}
else{echo '<script>alert("you are not logged in please log in.")</script>';
    header("refresh:0; url=login.html");
}
    ?>
</body>
</html>