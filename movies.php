<?php
  session_start();
  if(empty($_SESSION["username"])){header('Location: login.php');}

  $filmId = "kg:/m/".$_GET['filmId'];
  $username = $_SESSION["username"];

  $conn = mysqli_connect("db720929300.db.1and1.com","dbo720929300","password","db720929300");
  if (!$conn) {die("Connection failed: " . mysqli_connect_error());}  

  if(!empty($_POST['review'])){
    $review = $_POST['review'];
    $sql = "INSERT INTO `reviews` (`rowId`, `filmKid`, `UserId`, `Review`) VALUES (NULL, '$filmId', '$username', '$review');";
    $output = mysqli_query($conn,$sql);
  }

$sql = "SELECT * FROM `filmsTable` WHERE `kid` = '$filmId' LIMIT 1000";
    $output = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($output)) {
      $title = $row["title"];
      $desc = $row["desc"];
      $imgurl = $row["imgUrl"];
      $link = $row["link"];
    }
?>

<!DOCTYPE html>
 <html>
   <head>
     <!--Import Google Icon Font-->
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <!--Import materialize.css-->
     <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
     <link type="text/css" rel="stylesheet" href="css/styles.css" media="screen, projection"/>

     <!--Let browser know website is optimized for mobile-->
     <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   </head>
<body style="background-color:#E3F2FD">
   <nav>
  <div class="nav-wrapper teal">
    <form>
      <div class="input-field">
        <input id="search" type="search" required>
        <label class="label-icon" for="search"><i class="material-icons">search</i></label>
        <i class="material-icons">close</i>
      </div>
    </form>
  </div>
</nav>

<div style="padding:30px;">

<div class="col s12 m7">
  <h2 class="header"><?php echo $title;?></h2>
  <div class="card horizontal">
    <div class="card-image" style="padding:20px;">
      <img src="<?php echo $imgurl;?>">
    </div>
    <div class="card-stacked">
      <div class="card-content">
        <p><?php echo $desc;?></p>
      </div>
      <div class="card-action">
        <a href="<?php echo $link;?>">SkyNow</a>
      </div>
    </div>
  </div>
</div>



<div class="row" style="background:white;">
    <form class="col s12" method="post" action="<?php echo $_SERVER[REQUEST_URI];?>">
      <div class="row">
        <div class="input-field col s12">
          <textarea id="textarea1" class="materialize-textarea" name="review" id="review" placeholder="Write comments here"></textarea>
          <input type="submit" value="Submit">
        </div>
      </div>
    </form>
  </div>
   <div class="row">
    <form class="col s12">
      <div class="row">
   <?PHP 
   $sql = "SELECT * FROM `reviews` WHERE `filmKid` = '$filmId'";
    $output = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($output)) {
      $user = $row["UserId"];
      $review = $row["Review"];
      echo "<div style='max-width:500px;border:1px solid #4CAF50;margin:0;margin-bottom:20px;padding:10px 15px;background:white;'>
        <h4><a href = 'profile.html'>$user</a></h4>
        <p>$review</p>
        </div>
      ";
    }
   ?>
      </div></form></div> </div>

      <footer class="page-footer teal">
               <div class="container">
                 <div class="row">
                   <div class="col l6 s12">
                     <h5 class="white-text">Sky Community+</h5>
                     <p class="grey-text text-lighten-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dapibus quis quam nec volutpat. In hac habitasse platea dictumst. Aliquam tincidunt sit amet libero sed venenatis. Proin vehicula placerat est eget vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam sed arcu ac leo suscipit interdum. </p>
                   </div>
                   <div class="col l4 offset-l2 s12">
                     <h5 class="white-text">Links</h5>
                     <ul>
                       <li><a class="grey-text text-lighten-3" href="https://www.dominicswaine.com/secure/">Home</a></li>
                       <li><a class="grey-text text-lighten-3" href="https://www.dominicswaine.com/secure/movies?filmId=01kzd_v">Ghost in the Shell</a></li>
                       <li><a class="grey-text text-lighten-3" href="https://www.dominicswaine.com/secure/movies?filmId=05h95s">Avatar - The Last Airbender</a></li>
                     </ul>
                   </div>
                 </div>
               </div>
               <div class="footer-copyright">
                 <div class="container">
                 © 2018-present Dominic Swaine, Ali Ahmed, Akshat Sood, Sanchit Bembi.
                 <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
                 </div>
               </div>
             </footer>

             <div class="fixed-action-btn horizontal">
               <a class="btn-floating btn-large teal">
                 <i class="large material-icons">mode_edit</i>
               </a>
               <ul>
                 <li><a class="btn-floating red" href="https://www.dominicswaine.com/secure/movies?filmId=01kzd_v"><i class="material-icons">Ghost in the Shell</i></a></li>
                 <li><a class="btn-floating yellow darken-1" href="https://www.dominicswaine.com/secure/movies?filmId=05h95s"><i class="material-icons">Avatar - The Last Airbender</i></a></li>
                 <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
                 <li><a class="btn-floating blue" href="html/movies.html"><i class="material-icons">attach_file</i></a></li>
               </ul>
             </div>


      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript" src="../js/init.js"></script>

   </body>
</html>
