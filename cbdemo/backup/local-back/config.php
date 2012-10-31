<?php
$environment = isset($_SERVER['CWA_ENV']) ? $_SERVER['CWA_ENV'] : 'devel';
$cwa_url = isset($_SERVER['CWA_URL']) ? $_SERVER['CWA_URL'] : 'devel';
$path_url = isset($_SERVER['CWA_PATH']) ? $_SERVER['CWA_PATH'] : 'devel';
$app_id = 244931835547498;

?>
<div>
Environment: <?php echo $environment; ?><br />
CWA URL: <?php echo $cwa_url; ?><br />
Path URL: <?php echo $path_url; ?><br />
App Id: <?php echo $app_id; ?><br />
</div>
