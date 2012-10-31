<?php 

$pageName = "Homepage";

include("header.php");

?>
		
		<div id="carousel">
			<div id="carouselWrapper">
	   			<ul>
	        			<li><a href="movie.php?id=2"><img src="img/banner4.jpg" title="Casino Royale" alt="Casino Royale" /></a></li>
	        			<li><a href="movie.php?id=5"><img src="img/banner2.jpg" title="High Fidelity" alt="High Fidelity" /></a></li>
	        			<li><a href="movie.php?id=1"><img src="img/banner5.jpg" title="Jurassic Park" alt="Jurassic Park" /></a></li>
	        			<li><a href="movie.php?id=8"><img src="img/banner3.jpg" title="True Grit" alt="True Grit" /></a></li>
	        			<li><a href="movie.php?id=6"><img src="img/banner1.jpg" title="Last of the Mohicans" alt="Last of the Mohicans" /></a></li>
	    			</ul>
			</div>
		</div>
		
		<script type="text/javascript">
    			$(function(){
        			$("#carouselWrapper").carousel( {
        				prevBtn:		false,
        				nextBtn:		false,
        				autoSlide: 	true,
        				loop:		true,
        				pagination:	false,
        				animSpeed: 	"slow",
        				autoSlideInterval: 5000
        			});
    			});
		</script>
		
		<div id="wrapper" class="<?php echo $pageName; ?>">			
			<div id="sidebar">
				<div id="jcart"><?php $jcart->display_cart();?></div>
			</div>
			
			<div id="content">
			
				<h2>Browse Movies</h2>
			
				<?php foreach(array_slice($mitem,1) as $value) { ?>
				
				<form method="post" action="" class="jcart item<?php echo $value->id; ?>">
					<fieldset>

						<input type="hidden" name="jcartToken" value="<?php echo $_SESSION['jcartToken'];?>" />
						<input type="hidden" name="my-item-id" value="<?php echo $value->id; ?>" />
						<input type="hidden" name="my-item-name" value="<?php echo $value->name; ?>" />
						<input type="hidden" name="my-item-price" value="<?php echo $value->price; ?>" />
						<input type="hidden" name="my-item-url" value="<?php echo $value->url; ?>" />
						
						<ul>
							<li><a href="<?php echo $value->url; ?>"><img src="<?php echo $value->imageUrl; ?>" title="" /></a></li>
							<li><strong><?php echo $value->name; ?></strong></li>
							<li>Price: $<?php echo $value->price; ?></li>
							<li>
								<ul class="buttons">
									<li>
										<fb:like href="http://<?php echo $_SERVER['SERVER_NAME'] . "/" . $value->url; ?>" class="sb_like" send="false" layout="button_count" width="51px" style="width:51px;" show-faces="false" sb_params="{'pid':'<?php echo $value->id; ?>','plp':'<?php echo $value->url; ?>','pi':'<?php echo $value->imageUrl; ?>','pd':'<?php echo addSlashes($value->description);  ?>','pc':'<?php echo $value->category; ?>'}"></fb:like>
									</li>
								</ul>
							</li>
							<li>
								<label>Qty: <input type="text" name="my-item-qty" value="1" size="3" /></label>
								<button type="submit" name="my-add-button" value="add to cart" class="button"><div><span>Add to Cart</span></div></button>
							</li>
						</ul>
					</fieldset>
				</form>
				
				<?php } ?>
				
			<div class="clear"></div>
<?php include("footer.php"); ?>		
