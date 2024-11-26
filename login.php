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


<form name="login" action="action_login.php" method="POST">
	<table style="width:50%; margin-left:auto; margin-right:auto;" border="0">
		
		
		<tr>
			<td>نام کاربری:<span style="color:red">*</span></td>
			<td><input type="text" name="username" id="username" /></td>
		</tr>
		
		<tr>
			<td>کلمه عبور:<span style="color:red">*</span></td>
			<td><input type="text" name="password" id="password" /></td>
		</tr>
		
		
		
		<tr>
			<td></br></br></td>
			<td><input type="submit" value="ورود" /> &nbsp; &nbsp;&nbsp;
				<input type="reset" name="reset" value="جدید" />
			</td>
		</tr>





</br>


	</table>
</form>

 <?php
 include("include/footer.php");
 ?>