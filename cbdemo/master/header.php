<?php

include_once('cwa-config.php');

// jCart v1.3
// http://conceptlogic.com/jcart/
// This file demonstrates a basic store setup
// If your page calls session_start() be sure to include jcart.php first
include_once('jcart/jcart.php');

session_start();

// Shopping Cart Items
include_once('cartItems.php');

$id = $_GET['id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://ogp.me/ns#">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	
		<?php if ($pageName == "Homepage") { ?>
		<meta property="fb:app_id" content="<?php echo $app_id; ?>" />
		<?php } ?>

		<?php if ($pageName == "product") { ?>
		<!-- OG:META INFORMATION -->
		<meta property="og:locale" content="en_US" />
		<meta property="og:site_name" content="Movieshop"/>
		<meta property="fb:app_id" content="<?php echo $app_id; ?>"/>
		<meta property="fb:admins" content="24402817">
		<meta name="medium" content="video" />
		
		<meta property="og:title" content="<?php echo $mitem[$id]->name; ?>"/>
    		<meta property="og:type" content="movie"/>
    		<meta property="og:url" content="<?php echo $path_url . $mitem[$id]->url; ?>"/>
    		<meta property="og:description" content="<?php echo $mitem[$id]->description; ?>"/>
    		<meta property="og:image" content="<?php echo $path_url . $mitem[$id]->imageUrl; ?>"/>
    		
		<?php } ?>
		
		<?php if (isset($mitem[$id]->video)) { ?>
		<meta property="og:video" content="<?php echo $mitem[$id]->video ?>" />
		<meta property="og:video:width" content="600" />
        	<meta property="og:video:height" content="338" />
        	<meta property="og:video:type" content="application/x-shockwave-flash" />
        	
        	<meta name="video_type" content="application/x-shockwave-flash" />
        	<meta name="video_width" content="600" />
		<meta name="video_height" content="338" />
		<link rel="image_src" href="<?php echo $path_url . $mitem[$id]->url; ?>" />
		<link rel="video_src" href="<?php echo $mitem[$id]->video ?>" />
		        	
		<?php } ?>
	
		<!-- TITLE -->
		<title>Movieshop<?php if ($pageName=="Homepage") echo ""; else echo " - " . $mitem[$id]->name; ?></title>

		<!-- CSS -->
		<link rel="stylesheet" type="text/css" media="screen, projection" href="jcart/css/jcart.css" />
		<link rel="stylesheet" type="text/css" media="screen, projection" href="style.css" />
		
		<!-- SCRIPTS -->
		<script type="text/javascript" src="jcart/js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="jcart/js/jcart.min.js"></script>
		<script src="js/jquery.carousel.min.js"></script>
		<script id="fbjssdk" type="text/javascript" src="https://connect.facebook.net/en_US/all.js#appId=188520777862516&amp;xfbml=1"></script>
		<script type="text/javascript" src="<?php echo $cwa_url; ?>/js/spincycleinit.js?cid=10EFDD" sb_options="{'pid':'gallery','pn':'Post Purchase Share','pd':'Great titles that are sure to stir some nostalgia.','fblike':'true', 'pi':'<?php echo $path_url; ?>img/logo.png', 'plp':'<?php echo $path_url; ?>'<?php if($pageName == 'checkout2') { echo ",'pp':'true'"; } ?><?php if($pageName == 'purchase') { echo ",'purchase':'true','order_id':'" . $order_id . "','order_total':'" . $order_total . "'"; } ?>}" id="spinback-spincycle"></script>
	</head>
	<body>
		<div id="fb-root"></div>
		<div id="page">
			<div id="top">
				<div id="topWrapper">
					<a href="index.php"><img src="img/logo.png" title="Movieshop: Movies You Want - Prices You Wish For" alt="Movieshop: Movies You Want - Prices You Wish For" /></a>
				</div>
			</div>