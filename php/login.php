<?php
session_start();
include_once("utils.php");
if(isset($_POST['nick'])&&isset($_POST['pass']))
{
  $Pass = $_POST['pass'];
  $CryptPass = hash('md5',$Pass);
  $Nick = $_POST['nick'];
  //Controllo nel db
  $conn = mysqli_connect('localhost','avoc','','my_avoc');
  $stmt = $conn->prepare("SELECT * from Login where Nickname=? and Password=?");
  $stmt->bind_param('ss',$Nick,$CryptPass);
  $stmt->execute();
  $result=$stmt->get_result();
  $Return = "http://www.avoc.altervista.org/home.php";
  while($row = $result->fetch_assoc())
  {
    $_SESSION['UserType'] = -1;
    if($row['idCliente']>=0)
    {
      $Return = "http://www.avoc.altervista.org/user.php";
      $_SESSION['UserId'] = $row['idCliente'];
      $_SESSION['UserType'] = 0;
    }
    if($row['idBanca']>=0)
    {
      $Return = "http://www.avoc.altervista.org/banca.php";
      $_SESSION['UserId'] = $row['idBanca'];
      $_SESSION['UserType'] = 1;
    }
  }
    mysqli_close($conn);
    echo $Return;
}
 ?>
