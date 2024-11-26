


<?php

include("include/header.php");

if( isset($_GET["realname"]) && !empty($_GET["realname"])&&
isset($_GET["username"]) && !empty($_GET["username"]) &&
isset($_GET["password"]) && !empty($_GET["password"]) &&
isset($_GET["repassword"]) && !empty($_GET["repassword"]) &&
isset($_GET["email"]) && !empty($_GET["email"]) )

{
$realname=$_GET["realname"];
$username=$_GET["username"];
$password=$_GET["password"];
$repassword=$_GET["repassword"];
$email=$_GET["email"];
}
else
{
	exit("برخی از فیلدها مقداردهی نشده اند.");
}




if($password!==$repassword)
{
	exit("کلمه عبور و تکرار آن یکی نیستند.");
}



if(filter_var($email,FILTER_VALIDATE_EMAIL)===false)
{
	exit("پست الکترونیک از فرمت صحیحی برخوردار نیست");
}


$link=mysqli_connect("localhost","root","","shop_db");

if(mysqli_connect_errno())
	exit("خطای اتصال به این شرح است:". mysqli_connect_error());

$query="INSERT INTO users (realname, username, password, email, type) 
   VALUES ('$realname','$username','$password','$email','0')";
   
  if( mysqli_query($link,$query)===true)
	  echo ("عضویت شما با موفقیت انجام شد و اطلاعات شما ثبت گردید.");

mysqli_close($link);

echo("<div dir='rtl' style='color:green; text-align:right;' >");
echo("کاربر عزیز ثبتنام شما با موفقیت انجام شد. </br></br>");

echo("نام واقعی شما:".$realname. "</br>");
echo("نام کاربری شما:".$username. "</br>");
echo("رمز عبور شما:".$password. "</br>");
echo("تکرار رمز عبور شما:".$repassword." </br>");
echo("پست الکترونیک شما:".$email." </br>");




echo("</div>");

include("include/footer.php");
?>