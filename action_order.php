<?php
include("include/header.php");

if( !(isset($_SESSION["state_login"]) &&  $_SESSION["state_login"]===true && $_SESSION["user_type"]=="admin"  )     )
{
?>

<script type="text/javascript">

location.replace("index.php");

</script>

<?php
}


$pro_code= $_POST['pro_code'];
$pro_name=$_POST['pro_name'];
$pro_qty=$_POST['pro_qty'];
$pro_price=$_POST['pro_price'];
$total_price=$_POST['total_price'];

$realname=$_POST['realname'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$address=$_POST['address'];

$username=$_SESSION['username'];

$link= mysqli_connect("localhost","root","","shop_db");

if(mysqli_connect_errno())
	exit("شرح خطای اتصال به این صورت است:". mysqli_connect_error());

$query="INSERT INTO shop_db.order(id,username,orderdate,pro_code,pro_qty,pro_price,mobile,address,trackcode, state)
VALUES('0','$username','".date('y-m-d')."','$pro_code','$pro_qty', '$pro_price', '$mobile', '$address','000000000000000000000000', '0' )";

$result= mysqli_query($link,$query);

if($result)
{
	echo("سفارش شما با موفقیت ثبت شد و به زودی ارسال خواهد شد.");
	
	$query="UPDATE product SET pro_qty=pro_qty-$pro_qty WHERE pro_code=$pro_code";
	$result= mysqli_query($link,$query);
	
}
else
	echo("ثبت سفارش با خطا مواجه شد.");





mysqli_close($link);
	
	include("include/footer.php");

   
   
   
   
   
   


?>

