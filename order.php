
<?php

include("include/header.php");


if(!(isset($_SESSION['state_login']) &&  $_SESSION['state_login']===true   ))
{
	?>
	</br>
	
	برای خرید محصول باید وارد سایت شوید
	</br>
	در صورتی که عضو فروشگاه هستید برای ورود
	<a href="login.php"> اینجا</a>
	کلیک کنید.
	</br>
	و در صورتی که عضو سایت نیستید برای ثبتنام 
	<a href="register.php">اینجا </a>
	کلیک کنید.
	</br>
	
	<?php
	exit();
}

$link= mysqli_connect("localhost","root","","shop_db");

if(mysqli_connect_errno())
	exit("شرح خطای اتصال به این صورت است:". mysqli_connect_error());

$pro_code=0;
if(isset($_GET['id']))
	$pro_code=$_GET['id'];

$query="SELECT * FROM product WHERE pro_code='$pro_code'";
$result=mysqli_query($link,$query);
$row= mysqli_fetch_array($result);

if($row)
{
?>
</br>
<form name="order" action="action_order.php" method="POST">

<table>
<tr>
	<td style="width:22%;"> <span Style="color:red;" >*</span>کد کالا </td>
	<td style="width:78%;"> <input type="text" id="pro_code" name="pro_code" value="<?php echo ($pro_code); ?>"> </td>
</tr>

<tr>
	<td style="width:22%;"> <span Style="color:red;" >*</span>نام کالا </td>
	<td style="width:78%;"> <input type="text" id="pro_name" name="pro_name" value="<?php echo ($row['pro_name']); ?>"> </td>
</tr>

<tr>
	<td style="width:22%;"> <span Style="color:red;" >*</span>تعداد درخواستی </td>
	<td style="width:78%;"> <input type="text" id="pro_qty" name="pro_qty" onchange="calc_price();"> </td>
</tr>

<tr>
	<td style="width:22%;"> <span Style="color:red;" >*</span>قیمت واحد </td>
	<td style="width:78%;"> <input type="text" id="pro_price" name="pro_price" value="<?php echo ($row['pro_price']); ?>"> </td>
</tr>

<tr>
	<td style="width:22%;"> <span Style="color:red;" >*</span>مبلغ قابل پرداخت </td>
	<td style="width:78%;"> <input type="text" id="total_price" name="total_price" value="0"> </td>
</tr>

<script type="text/javascript">
function calc_price()
{
	
	var pro_qty= <?php echo($row['pro_qty']); ?>;
	var price= <?php echo($row['pro_price']); ?>;
	var count= document.getElementById('pro_qty').value;
	var total_price;
	if(count>pro_qty)
	{
		alert('تعداد موجودی در انبار از درخواست شما کمتر است.');
		count=0;
	}
	
	if(count==0||count=='')
		total_price=0;
	
	else
		total_price=count*price;
	document.getElementById('total_price').value= total_price;
}

</script>


<?php

$query="SELECT * FROM users WHERE username='{$_SESSION['username']}'  ";
$result= mysqli_query($link, $query);
$user_row= mysqli_fetch_array($result);

?>

<tr>
	<td></br> </br></td>
	<td></td>
</tr>

<tr>
	<td style="width:22%;"> <span Style="color:red;" >*</span>نام خریدار </td>
	<td style="width:78%;"> <input type="text" id="realname" name="realname" value="<?php echo ($user_row['realname']); ?>"> </td>
</tr>

<tr>
	<td style="width:22%;"> <span Style="color:red;" >*</span>پست الکترونیکی</td>
	<td style="width:78%;"> <input type="text" id="email" name="email" value="<?php echo ($user_row['email']); ?>"> </td>
</tr>

<tr>
	<td style="width:22%;"> <span Style="color:red;" >*</span>شماره تلفن همراه </td>
	<td style="width:78%;"> <input type="text" id="mobile" name="mobile" value="09"> </td>
</tr>

<tr>
	<td style="width:22%;"> <span Style="color:red;" >*</span>آدرس پستی </td>
	<td style="width:78%;"> <textarea type="text" id="address" name="address" value="" cols="40" rows="4"> </textarea> </td>
</tr>

<tr>
	<td></br> </br></td>
	<td></td>
</tr>

<tr>
	<td></br> </br></td>
	<td> <input type="button" value="خرید محصول" onclick="check_input();" /> </td>
</tr>


<script type="text/javascript">
function check_input()
{
	var a=confirm('آیا از صحت اطلاعات وارد شده مطمئن هستید؟');
	if(a==true)
	{
	
	var validation=true;	
	var count= document.getElementById('pro_qty').value;
	var mobile=document.getElementById('mobile').value;
	var address= document.getElementById('address').value;
	
		
	if(count==0||count=='')
	validation=false;
	
	if(mobile.length<11)
		validation=false;
	
	if(address.length<15)
		validation=false;
	
	if(validation)
		document.order.submit();
	else
		alert('برخی از ورودی ها به درستی تنظیم نشده اند'); 
	}
}
</script>


</table>

</form>
<?php	
	
}






include("include/footer.php");
?>