<?php 

$pageName = "checkout2";

include("header.php");

?>

		<div id="wrapper" class="<?php echo $pageName; ?>">

			<div id="content">

				<h1>Thank You For Your Purchase!</h1>

				<div class="socialContainer">
					<ul class="links">
						<li>
							<a class="sb_facebook"
								sb_params="{
											'pid':	'<?php echo $mitem[0]->id; ?>',
											'plp':	'http://<?php echo $_SERVER['SERVER_NAME'] . "/" . $mitem[0]->url; ?>',
											'pi':	'<?php echo $mitem[0]->imageUrl; ?>',
											'pd':	'<?php echo addSlashes($mitem[0]->description); ?>',
											'pc':	'<?php echo $mitem[0]->category; ?>',
											'opts':	'pp'
										}">Share</a>
						</li>
						<li>
							<a class="sb_twitter" sb_params="{'pid':'<?php echo $mitem[0]->id; ?>','plp':'http://<?php echo $_SERVER['SERVER_NAME'] . "/" . $mitem[0]->url; ?>','pi':'<?php echo $mitem[0]->imageUrl; ?>','pd':'<?php echo addSlashes($mitem[0]->description); ?>','pc':'<?php echo $mitem[0]->category; ?>','opts':'pp'}">Tweet</a>
						</li>
						<li>
							<a class="sb_email" sb_params="{'pid':'<?php echo $mitem[0]->id; ?>','plp':'http://<?php echo $_SERVER['SERVER_NAME'] . "/" . $mitem[0]->url; ?>','pi':'<?php echo $mitem[0]->imageUrl; ?>','pd':'<?php echo addSlashes($mitem[0]->description); ?>','pc':'<?php echo $mitem[0]->category; ?>','opts':'pp'}">Email</a>
						</li>
						<li>
							<a class="sb_link" sb_params="{'pid':'<?php echo $mitem[0]->id; ?>','plp':'http://<?php echo $_SERVER['SERVER_NAME'] . "/" . $mitem[0]->url; ?>','pi':'<?php echo $mitem[0]->imageUrl; ?>','pd':'<?php echo addSlashes($mitem[0]->description); ?>','pc':'<?php echo $mitem[0]->category; ?>','opts':'pp'}">Link</a>
						</li>
						<li>
							<a class="sb_pinterest" sb_params="{'pid':'<?php echo $mitem[0]->id; ?>','plp':'http://<?php echo $_SERVER['SERVER_NAME'] . "/" . $mitem[0]->url; ?>','pi':'<?php echo $mitem[0]->imageUrl; ?>','pd':'<?php echo addSlashes($mitem[0]->description); ?>','pc':'<?php echo $mitem[0]->category; ?>','opts':'pp'}">Pinterest</a>
						</li>
					</ul>
					
					<ul class="share">
						<li>
							<fb:like href="http://<?php echo $_SERVER['SERVER_NAME'] . "/" . $mitem[0]->url; ?>" class="sb_like" send="false" layout="standard" width="890px" style="width:890px;" show-faces="false" sb_params="{'pid':'<?php echo $mitem[0]->id; ?>','plp':'http://<?php echo $_SERVER['SERVER_NAME'] . "/" . $mitem[0]->url; ?>','pi':'<?php echo $mitem[0]->imageUrl; ?>','pd':'<?php echo addSlashes($mitem[0]->description);  ?>','pc':'<?php echo $mitem[0]->category; ?>','opts':'pp'}"></fb:like>
						</li>
					</ul>
				</div>

				<br />
				<br />
				<br />
				<br />

			</div>

			<div class="clear"></div>
			
			
			<?php 
				// CREATES ORDER NUMBER
			
				if (file_exists('order-number.txt')) {
					$file = fopen('order-number.txt', r); 
					$dat = fread($file, filesize('order-number.txt'));
					fclose($file);
					$file = fopen('order-number.txt', w);
					fwrite($file, $dat+1); 
				} else {
					$file = fopen('order-number.txt', w);
					fwrite($file, 1); echo '1';
					fclose($file);
			} ?>
			
			<div class="hide"><?php $jcart->display_cart();?></div>
			
			<script type="text/JavaScript">
					$(document).ready(function(){
						var sbCon=document.createElement('script');
						sbCon.setAttribute("sb_options","{'cid':'91A914','order_id':'<?php echo $dat; ?>','order_total':'"+$('#get-the-subtotal').text().replace('$','')+"'}");
						sbCon.id='sb_conversion';
						sbCon.type='text/javascript';
						sbCon.src='https://conversion.buddymedia.com/js/conversion.js';
						document.getElementsByTagName('head')[0].appendChild(sbCon);
						});
				     </script>
			
<?php include("footer.php"); ?>
