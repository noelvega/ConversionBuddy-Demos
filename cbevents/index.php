<?php
session_start();

if (isset($_REQUEST['prod'])) {
  $_SESSION['prod_enabled'] = ($_REQUEST['prod'] == 'true') ? TRUE : FALSE;
  header('Location: /');
  return;
}

if (isset($_REQUEST['environment'])) {
  $_SESSION['environment'] = $_REQUEST['environment'];
}

$environment = isset($_SESSION['environment']) ? $_SESSION['environment'] : 'devel';

?><html> 
<head>
<title>Event Generator</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="jquery-1.7.min.js"></script>
</head>
<body> 
 
<script>

  var lastImpressionEventId;
  var lastNetwork;
  var lastButtonClickEventId;

  function my_callback(data) {
    $("#response").html("Response: " + JSON.stringify(data));
    if (console != undefined) {
      console.log(data);
    }
  }

  function set_environment() {
    var url = "<?php echo "http://" . $_SERVER['HTTP_HOST'] . "/" . $_SERVER['REQUEST_URI'] . '?environment=' ?>" + get_environment();
    loadResource('script', 'foo', url);
  }

  function generate_event(url) {
    loadResource('script', 'foo', url);
    $("#event").html(url);
  }

  function loadResource(type, id, url, callback) {
       var sbr,q=(url.indexOf('?')>-1)?'&':'?',
       elType = (type==='script')?'text/javascript':'text/css';
       type = (type==='css')?'link':type;
       sbr = document.createElement(type);
       if(type==='css'){sbr.rel = 'stylesheet';}
       if(type==='script'){sbr.async = true;}
       sbr.id = id;
       sbr.type = elType;
       sbr.src = (callback)?url+q+'callback='+callback:url;
       document.getElementsByTagName('head')[0].appendChild(sbr);
   }

  function get_url() {
    var environment = get_environment();
    if (environment == 'prod') {
      return "conversion.buddymedia.com";
    } else if (environment == 'integration') {
      return "int-cwa.buddymedia.com";
    } else if (environment == 'staging') {
      return "conversionpp.buddymedia.com";
    } else if (environment == 'qa') {
      return "cwa-qa-jenkins.test.buddymedia.com";
    } else if (environment == 'local') {
      return "local.conversion.buddymedia.com";
    } else {
      return "cwa-dev-jenkins.test.buddymedia.com";
    }
  }

  function get_environment() {
    var environment = $("select[name=environment] option:selected").text();
    return environment;
  }

  function send_impression1() {
//    alert("sending impression.");

    lastImpressionEventId = new Date().valueOf();

    uri = 'http://'+get_url()+'/event/impression';
    uri += "?cid="+$("#cid").val();
    uri += "&pd=" + escape($("#pd").val());
    uri += "&pc=" + escape($("#pc").val());
    uri += "&pid=" + escape($("#pid").val());
    uri += "&pn=" + escape($("#pn").val());
    uri += "&plp=" + escape($("#plp").val());
    uri += "&pi=" + escape($("#pi").val());
    uri += "&pd=" + escape($("#pd").val());
    uri += "&guid=" + lastImpressionEventId;
    uri += "&callback=" + escape("my_callback");
    generate_event(uri);
  }

  function send_impression2() {

    lastImpressionEventId = new Date().valueOf();

    uri = 'http://'+get_url()+'/event/impression';
    uri += "?cid="+$("#cid").val();
    uri += "&guid=" + lastImpressionEventId;
    uri += "&callback=" + escape("my_callback");
    generate_event(uri);
  }

  function send_fbshare() {

    if (lastButtonClickEventId == null || lastButtonClickEventId == '') {
      alert('Please send a button click event first.');
      return;
    } 
    var fbpost_id = $("#fbpost_id").val();
    if (fbpost_id == '') {
      alert('Please provide a post id.');
      return;
    }
    uri = 'http://'+get_url()+'/event/share';
    uri += "?cid="+$("#cid").val();
    uri += "&pid=" + escape($("#pid").val());
    uri += "&pn=" + escape($("#pn").val());
    uri += "&plp=" + escape($("#plp").val());
    uri += "&pi=" + escape($("#pi").val());
    uri += "&pc=" + escape($("#pc").val());
    uri += "&pd=" + escape($("#pd").val());
    uri += "&guid=" + new Date().valueOf();
    uri += "&puid=" + lastButtonClickEventId;
    uri += "&network=facebook";
    uri += "&fbpost_id=" + fbpost_id; //"100001669503190_261360920559714";
    uri += "&callback=" + escape("my_callback");
    generate_event(uri);
  }

  function send_twitter_share() {
    if (lastButtonClickEventId == null || lastButtonClickEventId == '') {
      alert('Please send a button click event first.');
      return;
    } 
    uri = 'http://'+get_url()+'/event/share';
    uri += "?cid="+$("#cid").val();
    uri += "&pid=" + escape($("#pid").val());
    uri += "&pn=" + escape($("#pn").val());
    uri += "&plp=" + escape($("#plp").val());
    uri += "&pi=" + escape($("#pi").val());
    uri += "&pd=" + escape($("#pd").val());
    uri += "&pc=" + escape($("#pc").val());
    uri += "&guid=" + new Date().valueOf();
    uri += "&puid=" + lastButtonClickEventId;
    uri += "&network=twitter";
    uri += "&callback=" + escape("my_callback");
    generate_event(uri);
  }

  function send_buttonclick() {
    if (lastImpressionEventId == null || lastImpressionEventId == '') {
      alert('Please send an impression event first.');
      return;
    } 

    network = $("input[name=network]:checked").val();

    // store button click for cancel event.
    lastButtonClickEventId = new Date().valueOf();

    uri = 'http://'+get_url()+'/event/button_click';
    uri += "?cid="+$("#cid").val();
    uri += "&pid=" + escape($("#pid").val());
    uri += "&pn=" + escape($("#pn").val());
    uri += "&plp=" + escape($("#plp").val());
    uri += "&pi=" + escape($("#pi").val());
    uri += "&pc=" + escape($("#pc").val());
    uri += "&pd=" + escape($("#pd").val());
    uri += "&guid=" + lastButtonClickEventId;
    uri += "&puid=" + lastImpressionEventId;
    uri += "&network=" + network;
    uri += "&callback=" + escape("my_callback");
    generate_event(uri);
  }


  function send_clickback() {
    var guid = new Date().valueOf();

    var network = $("input[name=network]:checked").val();

    uri = 'http://'+get_url()+'/event/clickback';
    uri += "?cid="+$("#cid").val();
    uri += "&pid=" + escape($("#pid").val());
    uri += "&pn=" + escape($("#pn").val());
    uri += "&plp=" + escape($("#plp").val());
    uri += "&pi=" + escape($("#pi").val());
    uri += "&pc=" + escape($("#pc").val());
    uri += "&pd=" + escape($("#pd").val());
    uri += "&guid=" + guid;
    uri += "&network=" + network;
    uri += "&callback=" + escape("my_callback");
    generate_event(uri);
  }

  function send_sharecancel() {
    if (lastButtonClickEventId == null || lastButtonClickEventId == '') {
      alert('Please send a button click event first.');
      return;
    } 
    uri = 'http://'+get_url()+'/event/share_cancel';
    uri += "?cid="+$("#cid").val();
    uri += "&pid=" + escape($("#pid").val());
    uri += "&pn=" + escape($("#pn").val());
    uri += "&plp=" + escape($("#plp").val());
    uri += "&pi=" + escape($("#pi").val());
    uri += "&pd=" + escape($("#pd").val());
    uri += "&guid=" + new Date().valueOf();
    uri += "&puid=" + lastButtonClickEventId;
    uri += "&callback=" + escape("my_callback");
    generate_event(uri);
  }

  function send_purchase() {
    var order_id = $("#order_id").val();
    var order_total = $("#order_total").val();
    if (order_id == '' || order_total == '') {
      alert('Please provide an order id and order total.');
      return;
    }

    uri = 'http://'+get_url()+'/event/purchase';
    uri += "?cid="+$("#cid").val();
    uri += "&guid=" + new Date().valueOf();
    uri += "&order_id=" + order_id;
    uri += "&order_total=" + order_total;
    uri += "&callback=" + escape("my_callback");
    generate_event(uri);

//  try{
//    trackingPixel = new Image();
//    trackingPixel.src = uri; //'${spinbackHost}/event/1x1.gif?cid='+sb_cid+'&order_id='+sb_oid+'&order_total='+sb_total+'&sb_d='+sb_d;
//  }catch(e){}

  }

  function send_like() {
    uri = 'http://'+get_url()+'/event/share';
    uri += "?cid="+$("#cid").val();
    uri += "&pid=" + escape($("#pid").val());
    uri += "&pn=" + escape($("#pn").val());
    uri += "&plp=" + escape($("#plp").val());
    uri += "&pi=" + escape($("#pi").val());
    uri += "&pd=" + escape($("#pd").val());
    uri += "&guid=" + new Date().valueOf();
    uri += "&opts=like";
    uri += "&short_url=" + escape("http://spins.it/KS3TSY");
    uri += "&callback=" + escape("my_callback");
    generate_event(uri);
  }

  function send_unlike() {
    uri = 'http://'+get_url()+'/event/share';
    uri += "?cid="+$("#cid").val();
    uri += "&pid=" + escape($("#pid").val());
    uri += "&pn=" + escape($("#pn").val());
    uri += "&plp=" + escape($("#plp").val());
    uri += "&pi=" + escape($("#pi").val());
    uri += "&pd=" + escape($("#pd").val());
    uri += "&guid=" + new Date().valueOf();
    uri += "&opts=unlike";
    uri += "&short_url=" + escape("http://spins.it/KS3TSY");
    uri += "&callback=" + escape("my_callback");
    generate_event(uri);
  }

  function send_email() {
    var fromEmail = $("#fromEmail").val();
    var fromName = $("#fromName").val();
    var toEmail = $("#toEmail").val();
    var message = $("#message").val();

    if (fromEmail == null || fromEmail == '') {
      alert('You must specify a from email address.');
      return;
    }
    if (fromName == null || fromName == '') {
      alert('You must specify a from name.');
      return;
    }
    if (toEmail == null || toEmail == '') {
      alert('You must specify at least one recipient email address.');
      return;
    }
    if (message == null || message == '') {
      alert('You must specify a message.');
      return;
    }
   
    uri = 'http://'+get_url()+'/event/email';
    uri += "?cid="+$("#cid").val();
    uri += "&pid=" + escape($("#pid").val());
    uri += "&pn=" + escape($("#pn").val());
    uri += "&plp=" + escape($("#plp").val());
    uri += "&pi=" + escape($("#pi").val());
    uri += "&pd=" + escape($("#pd").val());
    uri += "&guid=" + new Date().valueOf();
    uri += "&fn=" + escape(fromName);
    uri += "&fe=" + escape(fromEmail);
    uri += "&te=" + escape(toEmail);
    uri += "&message=" + escape(message);
    uri += "&callback=" + escape("my_callback");
    generate_event(uri);
  }

  function send_follow() {
    uri = 'http://'+get_url()+'/event/follow';
    uri += "?cid="+$("#cid").val();
    uri += "&guid=" + new Date().valueOf();
    uri += "&following=" + escape("@johnspinback");
    uri += "&callback=" + escape("my_callback");
    generate_event(uri);
  }

  function send_conversion() {
    uri = 'http://'+get_url()+'/event/campaign';
    uri += "?cid="+$("#cid").val();
    uri += "&cp=" + escape($("#cp").val());
    uri += "&cn=" + escape($("#cn").val());
    uri += "&val=" + escape($("#val").val());
    uri += "&guid=" + new Date().valueOf();
    if (lastImpressionEventId != undefined) {
      uri += "&puid=" + lastImpressionEventId;
    }
    uri += "&callback=" + escape("my_callback");
    generate_event(uri);
  }

  function reset_form() {
    $("#cid").val("10EFDD");
    $("#pid").val("badger1");
    $("#pn").val("Honey Badger T-shirt");
    $("#pc").val("shirts");
    $("#pd").val("This shirt will make you pee your pants.");
    $("#plp").val("http://sb-sap1.buddymedia.com/"+get_environment()+"/demo.php");
    $("#pi").val("http://images-p.qvc.com/is/image/a/85/a214785_m86.102");
    $("#cp").val("Winter Clearance");
    $("#cn").val("Add to Cart");
    $("#val").val("12");
  }

  $(document).ready(function() {

    reset_form();


    $("#impression1").click(function() { send_impression1() });
    $("#impression2").click(function() { send_impression2() });
    $("#fbshare").click(function() { send_fbshare() });
    $("#twitter_share").click(function() { send_twitter_share() });
    $("#buttonclick").click(function() { send_buttonclick() });
    $("#clickback").click(function() { send_clickback() });
//    $("#buttonclick_twitter").click(function() { send_buttonclick('twitter') });
    $("#sharecancel").click(function() { send_sharecancel() });
    $("#purchase").click(function() { send_purchase() });
    $("#like").click(function() { send_like() });
    $("#unlike").click(function() { send_unlike() });
    $("#email").click(function() { send_email() });
    $("#follow").click(function() { send_follow() });
    $("#conversion").click(function() { send_conversion() });

    $("#reset").click(function() { reset_form() });

    $("#environment").change(function() { set_environment() });
  });

</script>

<form method='post'>
<table>
  <tr>
    <td>Environment</td>
    <td><select id="environment" name="environment">
<option value="local" <?php echo ($environment=='local') ? "SELECTED" : "" ?>>local</option> 
<option value="devel" <?php echo ($environment=='devel') ? "SELECTED" : "" ?>>devel</option> 
<option value="qa" <?php echo ($environment=='qa') ? "SELECTED" : "" ?>>qa</option> 
<option value="staging" <?php echo ($environment=='staging') ? "SELECTED" : "" ?>>staging</option> 
<option value="integration" <?php echo ($environment=='integration') ? "SELECTED" : "" ?>>integration</option> 
<?php if (isset($_SESSION['prod_enabled']) && $_SESSION['prod_enabled'] === TRUE) { ?><option value="prod" <?php echo ($environment=='prod') ? "SELECTED" : "" ?>>prod</option> <?php } ?>
</td>
<!--    <td><input type="radio" name="environment" value="local">LOCAL</input> <input type="radio" name="environment" value="devel" CHECKED>DEVEL</input> <input type="radio" name="environment" value="qa">QA</input> <input type="radio" name="environment" value="staging">STAGING</input><?php if (isset($_SESSION['prod_enabled']) && $_SESSION['prod_enabled'] === TRUE) { ?><input type="radio" name="environment" value="prod">PROD</input><?php } ?></td>-->
  </tr>
  <tr>
    <td>Retailer Key (CID)</td>
    <td><input type="text" size="50" id="cid" name="cid" value="" /></td>
  </tr>
  <tr>
    <td>Product Id</td>
    <td><input type="text" size="50" id="pid" name="pid" value="" /></td>
  </tr>
  <tr>
    <td>Product Name</td>
    <td><input type="text" size="100" id="pn" name="pn" value="" /></td>
  </tr>
  <tr>
    <td>Product Description</td>
    <td><input type="text" size="100" id="pd" name="pd" value="" /></td>
  </tr>
  <tr>
    <td>Product Landing Page</td>
    <td><input type="text" size="100" id="plp" name="plp" value="" /></td>
  </tr>
  <tr>
    <td>Product Image</td>
    <td><input type="text" size="100" id="pi" name="pi" value="" /></td>
  </tr>
  <tr>
    <td>Product Category</td>
    <td><input type="text" size="50" id="pc" name="pc" value="" /></td>
  </tr>
  <tr>
    <td>Campaign Name</td>
    <td><input type="text" size="50" id="cp" name="cp" value="" /></td>
  </tr>
  <tr>
    <td>Conversion Name</td>
    <td><input type="text" size="50" id="cn" name="cn" value="" /></td>
  </tr>
  <tr>
    <td>Conversion Value</td>
    <td><input type="text" size="50" id="val" name="val" value="" /></td>
  </tr>
  <tr>
    <td>Network</td>
    <td><input type="radio" name="network" value="facebook" CHECKED>Facebook</input> <input type="radio" name="network" value="twitter">Twitter</input> <input type="radio" name="network" value="email">Email</input> <input type="radio" name="network" value="link">Copy Link</input></td>
  </tr>
</table>

<div>
<input type="button" id="reset" name="action" value="reset to defaults" />
</div>
</form>

<div style="background-color: #dfdfdf; margin-top: 10px; border-top: 1px solid black;">
Last Sent Event<br />
<span id="event">NONE</span><br />
<br />
<span id="response"></span>
</div>

<form>
<div style="margin-top: 10px; border-top: 1px solid black;">
<input type="button" id="impression1" value="Send Full Product Impression"></input> <input type="button" id="impression2" value="Send Simplified Impression"></input>
</div>

<div style="margin-top: 10px; border-top: 1px solid black;">
<input type="button" id="buttonclick" value="Send Button Click"></input> 
</div>

<div style="margin-top: 10px; border-top: 1px solid black;">
<input type="button" id="fbshare" value="Send Facebook Share"></input> 
Facebook Post Id: <input id="fbpost_id" type="text" width="75" />
</div>

<div style="margin-top: 10px; border-top: 1px solid black;">
<input type="button" id="twitter_share" value="Send Twitter Share"></input> 
</div>

<div style="margin-top: 10px; border-top: 1px solid black;">
<input type="button" id="sharecancel" value="Send Share Cancel"></input>
</div>

<div style="margin-top: 10px; border-top: 1px solid black;">
<input type="button" id="clickback" value="Send Clickback"></input> 
</div>


<div style="margin-top: 10px; border-top: 1px solid black;">
<input type="button" id="purchase" value="Send Purchase Event"></input>
Order Id: <input id="order_id" type="text" name="oid" value="1234"/>
Order Total: <input id="order_total" type="text" name="total" value="25.00"/>
</div>

<div style="margin-top: 10px; border-top: 1px solid black;">
<input type="button" id="like" value="Send Like Event"></input>
<input type="button" id="unlike" value="Send Unlike Event"></input>
</div>

<div style="margin-top: 10px; border-top: 1px solid black;">
<input type="button" id="email" value="Send Email Event"></input> From Email:<input type="text" id="fromEmail" name="fromEmail"/> From Name:<input type="text" id="fromName" name="fromName" /> Recipient Email(s):<input type="text" id="toEmail" name="toEmail"/> Message: <input type="text" id="message" name="message" />
</div>

<div style="margin-top: 10px; border-top: 1px solid black;">
<input type="button" id="follow" value="Send Follow Event"></input>
</div>
</form>

<div style="margin-top: 10px; border-top: 1px solid black;">
<input type="button" id="conversion" value="Send Campaign Conversion Event"></input>
</div>
</form>

</body> 
</html> 
 
