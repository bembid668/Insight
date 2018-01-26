<?php
  header('Content-Type: application/json');

  $conn = mysqli_connect("db720929300.db.1and1.com","dbo720929300","password","db720929300");
  if (!$conn) {die("Connection failed: " . mysqli_connect_error());}

    $data = json_decode($_POST['resource']);
    $kid = $data[0]; $title = $data[1]; $desc = $data[2]; $imgUrl = $data[3];
    $sql = "INSERT INTO `filmsTable` (`kid`, `title`, `desc`, `imgUrl`) VALUES ('$kid', '$title', '$desc', '$imgUrl');";
    mysqli_query($conn,$sql);    

?>