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

if(!(isset($_GET['action'])&& $_GET['action']=='DELETE' ) )
{
if(isset($_POST['pro_code'])  && !empty($_POST['pro_code']) && 
   isset($_POST['pro_name'])  && !empty($_POST['pro_name']) &&  
   isset($_POST['pro_qty'])  && !empty($_POST['pro_qty']) &&   
   isset($_POST['pro_price'])  && !empty($_POST['pro_price']) &&   
   isset($_POST['pro_detail'])  && !empty($_POST['pro_detail'])    )
   {
	   
   $pro_code= $_POST['pro_code'];
   $pro_name= $_POST['pro_name'];
   $pro_qty= $_POST['pro_qty'];
   $pro_price= $_POST['pro_price'];
   $pro_image= basename($_FILES["pro_image"]["name"]);
   $pro_detail= $_POST['pro_detail'];
   
   }
   else
   exit("برخی از فیلدها خالی هستند.");
}  




 $link=mysqli_connect("localhost","root","","shop_db");

if(mysqli_connect_errno())
	exit("خطای اتصال به این شرح است:". mysqli_connect_error());


if(isset($_GET['action']))
{
	$id= $_GET['id'];
	switch($_GET['action'])
	{
		case 'EDIT':
			$query= "UPDATE shop_db.product SET pro_code='$pro_code', pro_name='$pro_name', pro_qty='$pro_qty', pro_price='$pro_price' , pro_detail='$pro_detail'  WHERE pro_code='$id'   ";
			if(mysqli_query($link,$query)===true)
			{
				echo("ویرایش با موفقیت انجام شد.");
			}
			else
				echo("ویرایش با خطا مواجه شد");
			
			break;
		
		case 'DELETE':
		
		$query="DELETE FROM shop_db.product WHERE pro_code='$id'";
		if(mysqli_query($link,$query)===true)
			{
				echo("حذف با موفقیت انجام شد.");
			}
			else
				echo("حذف با خطا مواجه شد.");
			
			break;
		
		
	}
	mysqli_close($link);
	include("include/footer.php");
	exit();
}

   
   $target_dir="image/product";
   $target_file= $target_dir.basename($_FILES["pro_image"]["name"]);
   $uploadok=1;
   $imagefiletype= pathinfo($target_file,PATHINFO_EXTENSION);
   
   
   
   $check=getimagesize($_FILES["pro_image"]["tmp_name"]);
   if($check!==false)
   {
   echo("این یک فایل تصویری است");
   $uploadok=1;
   }
   else
   {
   echo("این یک فایل تصویری نیست");
   $uploadok=0;
   }
   
   
   if($imagefiletype!="jpg" && $imagefiletype!="jpeg"  && $imagefiletype!="png" && $imagefiletype!="gif" )
   {
   echo("پسوند فایل مجاز نیست");
   $uploadok=0;

   }
   
   
   if(file_exists($target_file))
   {
   echo("پرونده ای با همین نام از قبل موجود است.");
   $uploadok=0;
   }
   
   if($_FILES["pro_image"]["size"]> (500*1024)   )
   {
   echo("اندازه پرونده بیشتر از 500 کیلوبایت است");
   $uploadok=0;
   
   }
   
   
   if($uploadok==0)
   {
   echo("پرونده به سرور ارسال نشد </br>");
   }
   else
   { if( move_uploaded_file ($_FILES["pro_image"]["tmp_name"],$target_file))
		{
		echo("پرونده موردنظر با موفقیت منتقل شد.");
		}
		
	else
		{
		echo("انتقال پرونده با خطا مواجه شد.");
		}
  
   }
   
   
  
	
	if($uploadok==1)
	{
	$query=" INSERT INTO product(pro_code,pro_name,pro_qty,pro_price,pro_image,pro_detail)
		VALUES ('$pro_code', '$pro_name', '$pro_qty', '$pro_price', '$pro_image', '$pro_detail') ";
		
		if(mysqli_query($link,$query)===true)
			echo("ثبت اطلاعات با موفقیت انجام شد");
		else
			echo("ثبت اطلاعات با خطا مواجه شد");
	
	}
	else
	echo("ثبت اطلاعات با خطا مواجه شد");
	
	mysqli_close($link);
	
	
	include("include/footer.php");

   
   
   
   
   
   


?>

