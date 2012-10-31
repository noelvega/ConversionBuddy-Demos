<?php 

$pageName = "checkout2";

include("header.php");

?>

		<div id="wrapper" class="<?php echo $pageName; ?>">

			<div id="content">

				<h1>Checkout</h1>

				
				<h2>Cart Details</h2>
				<div id="jcart"><?php $jcart->display_cart();?></div>

				<form>
					
					<div class="left">
									
						<h2>Your Information: <br />Billing</h2>
				
						<label>First Name:</label>
						<input type="text">
						
						<label>Last Name:</label>
						<input type="text">
					
						<label>Address:</label>
						<input type="text">
						
						<label>City:</label>
						<input type="text">
						
						<label>State:</label>
						<input type="text">
						
						<label>Zip Code:</label>
						<input type="text">
	
						<label>Credit Card Number:</label>
						<input type="text">
						
						<label>Credit Card Expiration:</label>
						<input type="text">
						
						<label>Credit Card Security Code:</label>
						<input type="text">
				
					</div>
					
					<div class="right">
				
						<h2>Your Information: <br />Shipping</h2>
						
						<label>Shipping - Address:</label>
						<input type="text">
						
						<label>Shipping - City:</label>
						<input type="text">
						
						<label>Shipping - State:</label>
						<input type="text">
					
					</div>
				
				</form>

				<a id="jcart-checkout" href="thank-you.php" class="thankyou"><div><span>Complete Your Purchase</span></div></a>
				
				<?php
					//echo '<pre>';
					//var_dump($_SESSION['jcart']);
					//echo '</pre>';
				?>
				
				<!-- CHANGE THE COPY OF THE PURCHASE BUTTON -->
				<script type="text/javascript">
					$(function(){
						$(".checkout2 #jcart-checkout div span").first().html("Back to Shopping Cart");
					});
				</script>
			</div>

			<div class="clear"></div>
			
<?php include("footer.php"); ?>