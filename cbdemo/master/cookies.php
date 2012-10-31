<?php
$cookies = $_COOKIE;
ksort($cookies);
foreach ($cookies as $key => $value) {
  echo "<p>" . $key . "=" . $value . "</p>";
}
?>
<!--
<script>
alert(document.cookie);
</script>
-->
