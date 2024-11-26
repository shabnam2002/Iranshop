<?php
session_start();
?>

<html>
<head>

<meta charset="utf-8" />
<title> فروشگاه محصولات ایرانی </title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="divtable">
	<div class="divtablerow">
		<div class="divtablecell">
		
		<header class="divtable">
			<div class="divtablerow">
				<div class="divtablecell">
					لوگوی سایت
				</div>
			</div>
		</header>
		
		
		<nav class="divtable">
			<ul class="divtablerow">
				<li class="divtablecell"><a class="" href="index.php"> صفحه اصلی  </a></li>
				<li class="divtablecell"><a class="" href=""> عضویت در سایت  </a></li>
				
				<?php
				if(isset($_SESSION["state_login"]) && $_SESSION["state_login"]===true)
				{
					?>
					<li class="divtablecell"><a class="" href="logout.php">خروج از سایت 
				<?php
				echo ("({$_SESSION["realname"]})");
				?>
				 </a></li>
				 <?php
				}
					else					
					{				
				?>
				<li class="divtablecell"><a class="" href="login.php">ورود به سایت  </a></li>
				
				<?php
					}
					?>
				
				<li class="divtablecell"><a class="" href=""> درباره ما  </a></li>
				<li class="divtablecell"><a class="" href=""> ارتباط با ما  </a></li>
				
				<?php
				if(isset($_SESSION["state_login"]) && $_SESSION["state_login"] ===true && $_SESSION["user_type"]=="admin"  )
				{
					
				?>
				
				<li class="divtablecell"><a class="set_style_link" href="admin_product.php"> مدیریت محصولات </a></li>
				
				<?php
				}
				?>
				
				
			</ul>
		</nav>
		
		<section class="divtable">
			<section class="divtablerow">
				<aside class="divtablecell" style="width:25%"> بخش امکانات سایت </aside>
				<section class="divtablecell" style="width:70%">