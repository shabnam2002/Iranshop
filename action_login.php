
<?php

include("include/header.php");

if( 
isset($_POST["username"]) && !empty($_POST["username"]) &&
isset($_POST["password"]) && !empty($_POST["password"])  )

{

$username=$_POST["username"];
$password=$_POST["password"];

}
else
{
	exit("برخی از فیلدها مقداردهی نشده اند.");
}


$link= mysqli_connect("localhost","root","","shop_db");

if(mysqli_connect_errno())
	exit("شرح خطای اتصال به این صورت است:". mysqli_connect_error());

$query="SELECT * FROM users WHERE username='$username' AND password='$password'" ;

$result=mysqli_query($link,$query);

$row=mysqli_fetch_array($result);

if($row)
{
	$_SESSION["state_login"] =true;
	$_SESSION["realname"]=$row['realname'];
	$_SESSION["username"]= $row['username'];
	
	
	if($row["type"]==0)
		$_SESSION["user_type"] = "public";
	elseif ($row["type"]==1)
	{
		$_SESSION["user_type"] = "admin";
		
		?>
		
		<script type="text/javascript">
		location.replace("admin_product.php");
		</script>
		
		<?php
		
	}
	
	
echo ( $row['realname']);
echo("خوش آمدید");
}

else
{
	echo("چنین کاربری وجود ندارد ");
}






echo("</div>");

include("include/footer.php");
?>