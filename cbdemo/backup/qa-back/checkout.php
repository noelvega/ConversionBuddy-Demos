<?php 

$pageName = "checkout";

include("header.php");

?>

		<div id="wrapper" class="<?php echo $pageName; ?>">

			<div id="content">

				<h1>Shopping Cart</h1>

				<div id="jcart"><?php $jcart->display_cart();?></div>

				<a id="jcart-checkout" href="checkout2.php"><div><span>Purchase</span></div></a>

				<?php
					//echo '<pre>';
					//var_dump($_SESSION['jcart']);
					//echo '</pre>';
				?>
			</div>

			<div class="clear"></div>
			
<?php include("footer.php"); ?>