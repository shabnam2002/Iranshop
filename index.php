<?php
include("include/header.php");


$link=mysqli_connect("localhost","root","","shop_db");

if(mysqli_connect_errno())
	exit("شرح خطا بدین گونه است:" .mysqli_connect_error());

$query="SELECT * FROM product";
$result= mysqli_query($link,$query);

?>
<table style=" width:100%;" border="1px">
<tr>
<?php


$counter=0;
while($row=mysqli_fetch_array($result))
{ $counter++;
?>
<td style="border-style:dotted dashed; vertical-align:top; width:33%;">


  <h3 style="color:green;"> <?php echo $row['pro_name'];?> </h3>
  <a href="product_detail.php?id=<?php echo $row['pro_code']?>"><img src="image/<?php echo $row['pro_image'];?>" width="250px" height="150px"></a>
	</br>
	قیمت: <?php echo $row['pro_price'] ?> &nbsp; ریال
</br>
تعداد موجودی: <span style="color:red;"> <?php echo $row['pro_qty'] ?> </span>
</br>
توضیحات: <?php echo substr($row['pro_detail'],0,120) ?>...
</b></br></br>

<b><a href="product_detail.php?id=<?php echo $row['pro_code']?>">    خرید </a></b>



</td>

<?php	
	if($counter%3==0)
		echo("</tr><tr>");
}

if($counter%3 !=0)
	echo("</tr>")





?>

</table>

<?php
 include("include/footer.php");
 ?>