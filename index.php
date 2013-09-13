<!DOCTYPE html> 
<html>
<head>
<!--[if IE 8]> <meta http-equiv="x-ua-compatible" content="IE=8"> <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Brassmark Wines - Home</title>
<link href="styles/index.css" type="text/css" rel="stylesheet" />
<link href="styles/anythingslider.css" type="text/css" rel="stylesheet" />
<link href="styles/chimp.css" type="text/css" rel="stylesheet" />
<script src="scripts/jquery.js" type="text/javascript"></script>
<script src="scripts/jquery.anythingslider.fx.min.js" type="text/javascript"></script>
<script src="scripts/jquery.anythingslider.min.js" type="text/javascript"></script>
<script src="scripts/jquery.easing.1.2.js" type="text/javascript"></script>
<script src="scripts/bmjs.js" type="text/javascript"></script>
<script src="scripts/main.js" type="text/javascript"></script>
</head>
<!--<?php 
require_once('scripts/database.php');


$sql = "SELECT * FROM offerings ORDER BY id DESC LIMIT 7";
$results = $database->query($sql);

function showRecent() {
	global $results, $database;
	$charlimit = 95;
	$substr = "";
	$substrlen = 0;
	while ($row = $database->fetch_assoc($results)) {
		$substrlen = $charlimit - strlen($row['title']);
		$substr = substr($row['body'], 0, $substrlen);
$output = <<<EOD
<p class='excerpt'><span class='title'>{$row['title']}:</span> $substr...</p>
<a class='readmore' href="offerings.php?o_id={$row['id']}">Read More</a>
EOD;
		echo $output;
	}
}

?>-->
<body>

<div id="header">
		<ul id="rotating">
			<li><img src="assets/rotation/1.png"></li>
			<li><img src="assets/rotation/2.png"></li>
			<li><img src="assets/rotation/3.png"></li>
			<li><img src="assets/rotation/4.png"></li>
		</ul>
</div>

<div id="newsletter">
	<div class="logo">
    	<img src="assets/bm_logo.png" />
    </div>
    <div class="form">
    	<div id="mc_embed_signup">
            <form action="http://brassmarkwines.us4.list-manage2.com/subscribe/post?u=5450c884b4c21559cfc2cab67&amp;id=4bc87b11d8" method="post" id+"mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
            <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Sign up for our mailing list" required>
            <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
            </form>
    	</div>
    </div>
</div>

<div id="nav">
	<p>HOME</p>
    <a href="about.php">ABOUT</a>
    <a href="offerings.php">OFFERINGS</a>
    <a href="http://store.brassmarkwines.com" target="_blank">STORE</a>
    <a href="contact.php">CONTACT</a>
</div>

<div id="winelist">
    <?php showRecent(); ?>
</div>

<div class="spacer">
</div>

<div id="footer">
	<p>&copy; 2012 Brassmark Wines. All Rights Reserved.</p>
    <a href="http://www.twitter.com/brassmarkwines"><img id="twit" src="assets/twitter.png" /></a>
    <a href="http://www.facebook.com/brassmarkwines"><img id="fb" src="assets/facebook.png" /></a>
</div>

</body>
</html>
