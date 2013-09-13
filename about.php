<!DOCTYPE html>
<html>
<head>
<!--[if IE 8]> <meta http-equiv="x-ua-compatible" content="IE=8"> <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Brassmark Wines - About</title>
<link href="styles/global.css" type="text/css" rel="stylesheet" />
<link href="styles/chimp.css" type="text/css" rel="stylesheet" />
<script src="scripts/jquery.js" type="text/javascript"></script>
<script src="scripts/bmjs.js" type="text/javascript"></script>
</head>
<?php 

$ben = "<h1>Ben Bradley</h1>
      <p>During a trip to Germany, Ben had his first taste of wine at the ripe age of 16. At the time, he didn’t know what to think of the nectar provided in that iconic red wine glass and definitely had no clue what varietals or
tannins were.</p>
			<p>In 2009, having gained a greater knowledge and appreciation of wine, Ben partnered with his brother and Phillip Coates to found 21 Cellars, a highly-regarded, boutique winery located in the North End neighborhood of Tacoma, Washington.<p>
      <p>Through this experience, Ben became well-acquainted with a variety of winemakers and grape growers, realizing a passion and enjoyment in sharing their stories and wines with family and friends. Seeing how the wine drinking experience was improved by learning the details behind the wine, Ben was inspired to shift course. Thus, together with Lisa DeYoung, Ben created Brassmark Wines as a way to provide those who enjoy wine or want to gain more knowledge about it, with an easy and 
accessible way to do so.<p>";

$lisa = "<h1>Lisa Deyoung</h1>
      <p>With a background in the restaurant industry, Lisa’s 
interest in wine ripened upon moving to Washington State from the Midwest in 2006 when she began working at a wine bar in Tacoma’s North End. Through this 
opportunity, Lisa developed strong connections within the wine industry, meeting and tasting with distributors, importers and winemakers from all over the world. After six years of pouring and tasting thousands of wines, Lisa has developed knowledge, not only of the immense world of wine, but also how to communicate and 
decipher the specific likes and dislikes of a wide variety of wine consumers. </p>
			<p>Like Ben, Lisa discovered a passion for uncovering the 
details behind a wine and how that connection 
strengthens the overall experience.</p>";

$about_us = "<h1>About Us</h1>
      <p>The good, the great, and the mediocre. When it comes to buying wine, it is often hard to tell which of these three descriptions might fit what you just chose from the store shelf. With many stores now offering thousands of wine options, deciding what to buy can lead to uncertainty and disappointment with purchases.</p>
			<p>Buying wine should not be confusing or overwhelming, and we are dedicated to enabling you to engage, understand and appreciate wine more deeply. We do so by presenting our top discoveries from our tastings with winemakers and distributors, sharing the details behind the wine in the bottle, and giving you the opportunity to purchase those that appeal to you.
<br>Our priorities:</p>
		<p>&emsp;•&emsp;&emsp;Regularly meet with winemakers, winery owners and distributors to taste current vintages, and offer only the wines we feel over-deliver on quality.</p>
    <p>&emsp;•&emsp;&emsp;Provide access to and knowledge of limited production releases and boutique winery offerings not found in grocery stores or other retail locations.</p>
    <p>&emsp;•&emsp;&emsp;Be receptive to feedback.</p>
  <h2><a href='about.php?about=how'>Learn more about how ordering works</a></h2>";

$how = "<h1>How It Works</h1>
      <p>1. Sign up to receive our weekly email offerings <br>
			<span class='boldncenter'><a href='offerings.php'>(Check out past offers)</a></p>
			<p>2.  In the offers, we provide varying details behind the wine in the bottle. For example:</p>
			<p style='display: list-item; margin-left: 50px;'>Who is the winemaker? What is their background?</p>
			<p style='display: list-item; margin-left: 50px;'>What variables influenced the grapes that year?</p>
			<p style='display: list-item; margin-left: 50px;'>What makes this wine region unique and how does it influence the wine’s style?</p>
			<p style='display: list-item; margin-left: 50px;'>How does the wine taste? Why did we choose to offer it?</p>
			<p>3.  Each email includes links to place your request. Only order the wines that interest you. No minimums, no clubs.</p>
		  <p>4.  Enjoy your wines. Your orders are viewable by logging in to our website.</p>
			<p style='display: list-item; margin-left: 50px;'>If you prefer to pick up at our <b><a href='http://goo.gl/maps/nqGmb' target='_blank'>warehouse</a></b>, we are open Thursdays from 11am - 7pm and by appointment.</p>
			<p style='display: list-item; margin-left: 50px;'>If you prefer to have your wine shipped immediately, we’ll ship to your home or office as weather permits.</p>
  		<h2>We’ll hold your wine for up to 3 months, after which <br>we’ll ship it to the preferred address on record.</h2>";
	
if(isset($_REQUEST['about'])) {
	if($_REQUEST['about'] == 'ben' || $_REQUEST['about'] == 'lisa' || $_REQUEST['about'] == 'how' || $_REQUEST['about'] == 'about_us')
		$about_id =& ${$_REQUEST['about']};
		else $about_id =& $about_us;
} else $about_id =& $about_us;

function toShow($who) {
	$str;
	switch($who) {
		case 'ben':
			$str = '<a href="about.php?about=about_us"><h3>About Us</h3></a>
      <p>Learn About Brassmark</p>
      <h3 class="active">Ben Bradley</h3>
      <p>Learn About Ben Bradley</p>
      <a href="about.php?about=lisa"><h3>Lisa Deyoung</h3></a>
      <p>Learn About Lisa Deyoung</p>
      <a href="about.php?about=how"><h3>How It Works</h3></a>
      <p>Learn How It Works	</p>';
			break;
		case 'lisa':
			$str = '<a href="about.php?about=about_us"><h3>About Us</h3></a>
      <p>Learn About Brassmark</p>
      <a href="about.php?about=ben"><h3>Ben Bradley</h3></a>
      <p>Learn About Ben Bradley</p>
      <h3 class="active">Lisa Deyoung</h3>
      <p>Learn About Lisa Deyoung</p>
      <a href="about.php?about=how"><h3>How It Works</h3></a>
      <p>Learn How It Works	</p>';
			break;
		case 'how':
			$str = '<a href="about.php?about=about_us"><h3>About Us</h3></a>
      <p>Learn About Brassmark</p>
      <a href="about.php?about=ben"><h3>Ben Bradley</h3></a>
      <p>Learn About Ben Bradley</p>
      <a href="about.php?about=lisa"><h3>Lisa Deyoung</h3></a>
      <p>Learn About Lisa Deyoung</p>
      <h3 class="active">How It Works</h3>
      <p>Learn How It Works	</p>';
			break;
		case 'about_us':
		default:
			$str = '<h3 class="active">About Us</h3>
      <p>Learn About Brassmark</p>
      <a href="about.php?about=ben"><h3>Ben Bradley</h3></a>
      <p>Learn About Ben Bradley</p>
      <a href="about.php?about=lisa"><h3>Lisa Deyoung</h3></a>
      <p>Learn About Lisa Deyoung</p>
      <a href="about.php?about=how"><h3>How It Works</h3></a>
      <p>Learn How It Works	</p>';
			break;
	}
	return $str;
}

?>

<body>

<div id="about-newsletter">
	  <div class="logo">
    	<img src="assets/bm_logo.png" />
    </div>
    <div id="about-links">
    	<?php if(isset($_REQUEST['about'])) echo toShow($_REQUEST['about']);
						else echo toShow('about_us'); ?>
    </div>
    <div class="form">
    	<div id="mc_embed_signup">
            <form action="http://brassmarkwines.us4.list-manage2.com/subscribe/post?u=5450c884b4c21559cfc2cab67&amp;id=4bc87b11d8" method="post" id+"mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
            <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Sign up for our mailing list" required />
            <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button" /></div>
            </form>
    	</div>
    </div>
</div>

<div id="nav">
	<a href="index.php">HOME</a>
    <p>ABOUT</p>
    <a href="offerings.php">OFFERINGS</a>
    <a href="http://store.brassmarkwines.com" target="_blank">STORE</a>
    <a href="contact.php">CONTACT</a>
</div>

<div id="content">
	<div id="about">
		<?php echo $about_id; ?>
	</div>  
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
