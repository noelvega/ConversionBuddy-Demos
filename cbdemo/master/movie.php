<?php 

$pageName = "product";

include("header.php");

?>
		
		<div id="wrapper" class="<?php echo $pageName; ?>">			
			<div id="sidebar">
				<div id="jcart"><?php $jcart->display_cart();?></div>
			</div>
			
			<div id="content">
			
				<form method="post" action="" class="jcart item<?php echo $mitem[$id]->id; ?>">
					<fieldset>
						<input type="hidden" name="jcartToken" value="<?php echo $_SESSION['jcartToken'];?>" />
						<input type="hidden" name="my-item-id" value="<?php echo $mitem[$id]->id; ?>" />
						<input type="hidden" name="my-item-name" value="<?php echo $mitem[$id]->name; ?>" />
						<input type="hidden" name="my-item-price" value="<?php echo $mitem[$id]->price; ?>" />
						<input type="hidden" name="my-item-url" value="<?php echo $mitem[$id]->url; ?>" />
						
						
						<div class="itemWrapper">
							<div class="itemImage">
								<img src="<?php echo $mitem[$id]->imageUrl; ?>" />
							</div>
							
							<div class="itemDescription">
								<h1><?php echo $mitem[$id]->name; ?></h1>
								
								
								<p><?php echo $mitem[$id]->description; ?></p>
								
								<h3>Share</h3>
								
								<div id="socialContainer" class="socialContainer">
									<ul class="links">
										<li>
											<a class="sb_facebook" sb_params="{'pid':'<?php echo $mitem[$id]->id; ?>','plp':'<?php echo $_SERVER['SERVER_NAME'] . htmlspecialchars($_SERVER['REQUEST_URI']);?>','pi':'<?php echo $mitem[$id]->imageUrl; ?>','pd':'<?php echo addSlashes($mitem[$id]->description);  ?>','pc':'<?php echo $mitem[$id]->category; ?>','pn':'<?php echo addSlashes($mitem[$id]->name); ?>'}">Share</a>
										</li>
										<li>
											<a class="sb_twitter" sb_params="{'pid':'<?php echo $mitem[$id]->id; ?>','plp':'http://<?php echo $_SERVER['SERVER_NAME'] . htmlspecialchars($_SERVER['REQUEST_URI']);?>','pi':'<?php echo $mitem[$id]->imageUrl; ?>','pd':'<?php echo addSlashes($mitem[$id]->description);  ?>','pc':'<?php echo $mitem[$id]->category; ?>','pn':'<?php echo addSlashes($mitem[$id]->name); ?>'}">Tweet</a>
										</li>
										<li>
											<a class="sb_email" sb_params="{'pid':'<?php echo $mitem[$id]->id; ?>','plp':'http://<?php echo $_SERVER['SERVER_NAME'] . htmlspecialchars($_SERVER['REQUEST_URI']);?>','pi':'<?php echo $mitem[$id]->imageUrl; ?>','pd':'<?php echo addSlashes($mitem[$id]->description);  ?>','pc':'<?php echo $mitem[$id]->category; ?>','pn':'<?php echo addSlashes($mitem[$id]->name); ?>'}">Email</a>
										</li>
										<li>
											<a class="sb_link" sb_params="{'pid':'<?php echo $mitem[$id]->id; ?>','plp':'http://<?php echo $_SERVER['SERVER_NAME'] . htmlspecialchars($_SERVER['REQUEST_URI']);?>','pi':'<?php echo $mitem[$id]->imageUrl; ?>','pd':'<?php echo addSlashes($mitem[$id]->description);  ?>','pc':'<?php echo $mitem[$id]->category; ?>','pn':'<?php echo addSlashes($mitem[$id]->name); ?>'}">Link</a>
										</li>
										<li>
											<a class="sb_pinterest" sb_params="{'pid':'<?php echo $mitem[$id]->id; ?>','plp':'http://<?php echo $_SERVER['SERVER_NAME'] . htmlspecialchars($_SERVER['REQUEST_URI']); ?>','pi':'<?php echo $mitem[$id]->imageUrl; ?>','pd':'<?php echo addSlashes($mitem[$id]->description);  ?>','pc':'<?php echo $mitem[$id]->category; ?>','pn':'<?php echo addSlashes($mitem[$id]->name); ?>'}">Pinterest</a>
										</li>
									</ul>
									
									<ul class="share">
										<li>
											<fb:like href="http://<?php echo $_SERVER['SERVER_NAME'] . htmlspecialchars($_SERVER['REQUEST_URI']); ?>" class="sb_like" sb_params="{'pid':'<?php echo $mitem[$id]->id; ?>','plp':'http://<?php echo $_SERVER['SERVER_NAME'] . htmlspecialchars($_SERVER['REQUEST_URI']); ?>','pi':'<?php echo $mitem[$id]->imageUrl; ?>','pd':'<?php echo addSlashes($mitem[$id]->description);  ?>','pc':'<?php echo $mitem[$id]->category; ?>','pn':'<?php echo addSlashes($mitem[$id]->name); ?>'}"></fb:like>
										</li>
									</ul>
								</div>
								
								<h3>Purchase</h3>
								<ul>
									<li>Price: $<?php echo $mitem[$id]->price; ?></li>
									<li>
										<label>Qty: <input type="text" name="my-item-qty" value="1" size="3" /></label>
									</li>
								</ul>
								
								<button type="submit" name="my-add-button" value="add to cart" class="button"><div><span>Add to Cart</span></div></button>
							</div>
						</div>
					</fieldset>
				</form>

				<div class="clear"></div>
<?php include("footer.php"); ?>
