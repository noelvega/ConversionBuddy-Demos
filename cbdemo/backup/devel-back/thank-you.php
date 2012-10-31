<?php 

$pageName = "purchase";

include_once('config.php');
include_once('jcart/jcart.php');

$contents = $jcart->get_contents();

if (empty($contents)) {
  header('Location: '.$path_url);
  return;
}

$order_total = 0;
foreach ($contents as $content) {
  $order_total += $content['subtotal'];
}

  // CREATES ORDER NUMBER

  if (file_exists('order-number.txt')) {
    $file = fopen('order-number.txt', r); 
    $order_id = fread($file, filesize('order-number.txt'));
    fclose($file);
    $file = fopen('order-number.txt', w);
    fwrite($file, $order_id+1); 
  } else {
    $file = fopen('order-number.txt', w);
    fwrite($file, 1); echo '1';
    fclose($file);
  } 
	
// need order_id and order_total before calling header.php
include("header.php");

?>

		<div id="wrapper" class="<?php echo $pageName; ?>">

			<div id="content">

				<h1>Thank You For Your Purchase!</h1>

                                <div style="margin:10px 0">
                                Order Id: <? echo $order_id ?><br />
                                Order Total: <? echo $order_total ?>
                                </div>
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
			
			
		
			<div class="hide"><?php $jcart->display_cart();?></div>
			
<?php include("footer.php"); ?>

<?php
 $jcart->empty_cart(); 
?>
