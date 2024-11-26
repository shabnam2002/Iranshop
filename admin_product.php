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
$link= mysqli_connect("localhost","root","","shop_db");

if(mysqli_connect_errno())
	exit("شرح خطای اتصال به این صورت است:". mysqli_connect_error());


$pro_code= $pro_name = $pro_qty = $pro_price = $pro_image = $pro_detail = $url= "";
$btn="افزودن کالا";

if(isset($_GET['action']) && $_GET['action']== 'EDIT'  )
	
	{
		$id= $_GET['id'];
		$query= "SELECT * FROM product WHERE pro_code='$id'";
		$result= mysqli_query($link,$query);
		if($row=mysqli_fetch_array($result))
		{
			$pro_code= $row['pro_code'];
			$pro_name= $row['pro_name'];
			$pro_qty= $row['pro_qty'];
			$pro_price= $row['pro_price'];
			$pro_image= $row['pro_image'];
			$pro_detail= $row['pro_detail'];
			
			$url="?id=$pro_code&action=EDIT";
			$btn="ویرایش کالا";
			
			
		}
	}

?>



</br>
<form name="add_product" action="action_admin_product.php<?php if(!empty($url)) echo $url; ?>" method="POST" enctype="multipart/form-data">
	<table style="width:100%; margin-left:auto; margin-right:auto;" border="0">
		
		
		<tr>
			<td style="width:22%;">کد کالا: <span style="color:red;">*</span></td>
			<td  style="width:78%;"><input type="text" id="pro_code" name="pro_code" value="<?php echo($pro_code) ?>"  /></td>
		</tr>
		
		<tr>
			<td>نام کالا:<span style="color:red">*</span></td>
			<td><input type="text" style="text-align:right;" id="pro_name" name="pro_name" value="<?php echo($pro_name) ?>" /></td>
		</tr>
		
		<tr>
			<td>موجودی کالا:<span style="color:red">*</span></td>
			<td><input type="text" style="text-align:right;" id="pro_qty" name="pro_qty" value="<?php echo($pro_qty) ?>" /></td>
		</tr>
		
		<tr>
			<td>قیمت کالا:<span style="color:red">*</span></td>
			<td><input type="text" style="text-align:left;" id="pro_price" name="pro_price" value="<?php echo($pro_price) ?>" /></td>
		</tr>
		
		<tr>
			<td>آپلود تصویر کالا:<span style="color:red">*</span></td>
			<td><input type="file" style="text-align:left;" id="pro_image" name="pro_image"  />
			<?php if(!empty($pro_image)) echo("<img src='image/$pro_image' width='80' height='40' />")?>
			</td>
		</tr>
		
		<tr>
			<td>توضیحات تکمیلی:<span style="color:red">*</span></td>
			<td><textarea id="pro_detail" name="pro_detail" col="45" rows="10" wrap="virtual"   /> <?php echo $pro_detail; ?>  </textarea></td>
		</tr>
		
		
		
		<tr>
			<td></br></br></td>
			<td><input type="submit" value="<?php echo $btn;  ?>"/> &nbsp; &nbsp;&nbsp;
				<input type="reset"  value="جدید" />
			</td>
		</tr>





</br>


	</table>
</form>


 <?php
 
 $query="SELECT * FROM shop_db.product";
 $result= mysqli_query($link,$query);
 
 
 ?>
 
 <table border="1px" style="100%;">
 
 <tr>
	<td> کد کالا </td>
	<td> نام کالا </td>
	<td> موجودی کالا </td>
	<td> قیمت کالا </td>
	<td> تصویر کالا </td>
	<td> ابزار مدیریتی </td>
 </tr>
 
 <?php
 
 while($row=mysqli_fetch_array($result))
 {
	 ?>
	 <tr>
		<td> <?php echo($row['pro_code']); ?> </td>
		<td> <?php echo($row['pro_name']); ?> </td>
		<td> <?php echo($row['pro_qty']); ?> </td>
		<td> <?php echo($row['pro_price']); ?> </td>
		<td> <img src="image/<?php echo($row['pro_image']); ?>" width="150px" height="50px" /></td>
		<td> <a href="action_admin_product.php?id=<?php echo $row['pro_code']; ?>&action=DELETE"> حذف</a> || <a href="admin_product.php?id=<?php echo $row['pro_code']; ?>&action=EDIT">ویرایش </a></td>
	 </tr>
	 
	 <?php
 }
 
 ?>
 
 
 </table>
 
 
 <?php
 
 
 
 
 include("include/footer.php");
 ?>