  <!----NAVIGATION BAR------>
<div class="navigation_bar">
  <ul>
    <li> <a href="index.html"> HOME </a></li>
    <li> <a href="#about.html"> ABOUT </a></li>
    <li> <a href="#portfolio.html"> PORTFOLIO </a></li>
    <li> <a href="#contact.html"> CONTACT </a></li>
  </ul>
</div>

<?php
  include("configuration.php");
   session_start();

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$memo = $_POST['memo'];

if (!empty($name) || !empty($phone) || !empty($email) || !empty($memo)) {
  $host = "localhost";
  $dbUsername = "username";
  $dbPassword = "password";
  $dbname = "portfolio";



  //connection
  $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname, );
  if (mysqli_connect_error()) {
    die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
  } else{
    $SELECT = "SELECT email, memo From Client_info Where email= ? AND memo=? Limit 1";
    $INSERT = "INSERT Into Client_info (name, phone, email, memo) values(?,?,?,?)";

    //prepare statement
$stmt = $conn->prepare($SELECT);
$stmt->bind_param("ss", $email, $memo);
$stmt->execute();
$stmt->bind_result($email,$memo);
$stmt->store_result();
$rnum = $stmt->num_rows;

if ($rnum==0) {
  $stmt->close();

  $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("siss", $name, $phone, $email, $memo);
    $stmt->execute();
    echo "Enquiry sent successfully! Thank you for communicating with us <3";
} else{
  echo "Dear user, this enquiry has been sent an  already and is being processed!";
  }
  $stmt->close();
  $conn->close();
}
}
 else
echo "Please fill in missing fields!";
die()

?>