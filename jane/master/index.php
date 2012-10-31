<?php require_once('cwa-config.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <title>JANE - Just Another Named Example - ConversionBuddy Test Page</title>
  
  <style type='text/css'>
    body{padding:20px;}
  </style>

<script type="text/javascript" src="<?php echo $cwa_url; ?>/js/spincycleinit.js?cid=BD6726" async="true" defer="true" id="spinback-spincycle">
pid: 1234
plp: document.location.href
pn: JANE - Just Another Named Example - ConversionBuddy Test Page
pd: Conversion Buddy test product
pi: http://www.buddymedia.com/images/products/conversionbuddy.png
fc: www.buddymedia.com
campaign: true
</script>

  
</head>
<body>
  <hr />
    <h3>JANE - Just Another Named Example</h3><img src="Jane_Jetson.jpeg" />
    <h4>ENVIRONMENT: <b><?php echo $environment; ?></b></h4>
  <hr />

<!-- All Share Buttons Positioning --> 
<div>
<!-- FB Share Button --><a class="sb_facebook">Share</a>
<!-- Twitter Button --><a class="sb_twitter">Tweet</a>
<!-- Email Button --><a class="sb_email">Email</a>
<!-- Copy Link Button --><a class="sb_link">Link</a>
<!-- Copy Link Button --><a class="sb_pinterest">Pin</a>
<!-- FB Like Button --><fb:like class="sb_like"></fb:like>
</div>
<br />
<div>
    <button class="sb_campaign" sb_params="{'cp':'Campaign','cn':'Conversion','val':'100.00'}">Conversion</button>
</div>


  
</body>


</html>


