<?php

include("include/header.php");


$link=mysqli_connect("localhost","root","","shop_db");

if(mysqli_connect_errno())
	exit("شرح خطا بدین گونه است:" .mysqli_connect_error());

if(isset($_GET['id']))
	$pro_code=$_GET['id'];
	
$query="SELECT * FROM product WHERE pro_code='$pro_code'";
$result=mysqli_query($link,$query);
?>
<table style="width:100%;" border="1px" >
<tr>

<?php

if($row= mysqli_fetch_array($result))
{
?>
<td style="border-style:dotted dashed; vertical-align:top; width:33%;">


<h4 style="color:green;"> <?php echo $row['pro_name'];?> </h4>
<img src="image/<?php echo $row['pro_image']  ?>"  />
</br>
قیمت: <?php echo $row['pro_price'] ?> &nbsp; ریال
</br>
تعداد موجودی: <?php echo $row['pro_qty'] ?>
</br>
توضیحات: <span style="color:red;"><?php echo $row['pro_detail'] ?></span>
</br></br></br>

<b><a href="order.php?id=<?php echo $row['pro_code'] ?>"> سفارش و خرید پستی </a></b>




</td>

<?php
}

?> 

</tr>
</table>
<?php

mysqli_close($link);

include("include/footer.php");

?>
