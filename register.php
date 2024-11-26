<?php
include("include/header.php");

if(isset($_SESSION["state_login"]) && $_SESSION["state_login"]===true)
{
	?>
	<script type="text/javascript">
	location.replace("index.php");
	</script>
	<?php
}
?>

<script type="text/javascript">

function check()
{
	var realname =document.getElementById("realname").value;
	var username =document.getElementById("username").value;
	var password =document.getElementById("password").value;
	var repassword =document.getElementById("repassword").value;
	var email =document.getElementById("email").value;
	
	
if(realname==""|| username=="" || password=="" || repassword=="" || email=="")
	{
			alert("وارد کردن تمامی فیلدها الزامی است.");
	}
	
	else
	{
		if(confirm("آیا از صحت اطلاعات خود مطمئن هستید؟")==true)
		{
			document.register.submit();
		}
	
	}



}
</script>


<form name="register" action="action_register.php" method="GET">
	<table style="width:50%; margin-left:auto; margin-right:auto;" border="0">
		<tr>
			<td>نام واقعی:<span style="color:red">*</span></td>
			<td><input type="text" name="realname" id="realname" /></td>
		</tr>
		
		<tr>
			<td>نام کاربری:<span style="color:red">*</span></td>
			<td><input type="text" name="username" id="username" /></td>
		</tr>
		
		<tr>
			<td>کلمه عبور:<span style="color:red">*</span></td>
			<td><input type="text" name="password" id="password" /></td>
		</tr>
		
		<tr>
			<td>تکرار کلمه عبور:<span style="color:red">*</span></td>
			<td><input type="text" name="repassword" id="repassword" /></td>
		</tr>
		
		<tr>
			<td>پست الکترونیک:<span style="color:red">*</span></td>
			<td><input type="text" name="email" id="email" /></td>
		</tr>
		
		<tr>
			<td></br></br></td>
			<td><input type="button" value="ثبت نام" onclick="check()"/> &nbsp; &nbsp;&nbsp;
				<input type="reset" name="reset" value="جدید" />
			</td>
		</tr>





</br>


	</table>
</form>

 <?php
 include("include/footer.php");
 ?>