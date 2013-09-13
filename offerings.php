<? ob_start(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--[if IE 8]> <meta http-equiv="x-ua-compatible" content="IE=8"> <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Brassmark Wines - Offerings</title>
<script src="scripts/jquery.js" type="text/javascript"></script>
<script type="text/javascript">$(window).bind("load", function() {
	$('body').attr('style', 'visibility:visible');
});</script>
</head>
<?php
require_once("scripts/database.php");

$sql = "SELECT id, title, date_format(date, '%M %D, %Y') as 'date' FROM offerings ORDER BY id";
$offerNav = $database->query($sql);
$numResults = mysql_num_rows($offerNav);
if($numResults == 0) header('Location: noofferings.php');
$numList = 10;
$numPages = ceil($numResults / $numList);

if (isset($_GET['o_id'])) {
	$id = $_GET['o_id'];
} else { 
	if(mysql_data_seek($offerNav, $numResults - 1)) {
		if ($row = $database->fetch_assoc($offerNav)) { 
			$id = $row["id"];
		}
	}
}
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else { 
	$page = floor(($numResults - $id) / $numList) + 1; 
}

$sql = "SELECT id, headline, title, image, 
		body, date_format(date, '%M %D, %Y') as 'date' FROM offerings WHERE id = $id";
$results = $database->query($sql);
$offering = $database->fetch_assoc($results);
$image = "<img style='float:left' src='assets/offerings/" . $offering['image'] . "' />";

function offerings() {
	global $page, $database, $offerNav, $numResults, $numList, $id;
	$startNum = $numResults - $numList * ($page - 1);
	
	for ($i = $startNum - 1; $i >= $startNum - $numList; $i--) {
		if ($i < 0) break;
		if (!mysql_data_seek($offerNav, $i)) break;
		if (!($row = $database->fetch_assoc($offerNav))) break;
		if ($row['id'] == $id) {
			echo "<div class='offering'>" . 
        		"<p class='link active'>" . $row["title"] . 
            	"</p><p>Posted on " . $row["date"] . "</p></div>";
		} else {
			echo "<div class='offering'>" . 
        		"<p class='link'><a href='offerings.php?o_id=" . $row["id"] . "'>" . $row["title"] . 
            	"</a></p><p>Posted on " . $row["date"] . "</p></div>";
		}
	}
}

function offerNav() {
	global $numPages, $page, $id;
	if ($page < $numPages) $next = $page + 1; else $next = $page;
	if ($page > 1) $prev = $page - 1; else $prev = $page;
	
	$output = "<a href='offerings.php?o_id=" . $id . "&page=1'>first</a> ";
	$output .= "<a href='offerings.php?o_id=" . $id . "&page=" . $prev . "'>prev</a>  <b>$page of $numPages</b>  ";
	$output .= "<a href='offerings.php?o_id=" . $id . "&page=" . $next . "'>next</a> <a href='offerings.php?o_id=" . $id . "&page=" . $numPages . "'>last</a>";
	echo $output;
}

?>

<body style="visibility: hidden">

<div id="offerings_list">
	<div class="logo">
    	<img src="assets/bm_logo.png" />
    </div>
    <div id="offerings_container">
    	<?php offerings() ?>
    </div>
    <p id="offNav"><?php offerNav(); ?></p>

</div>

<div id="nav">
	<a href="index.php">HOME</a>
    <a href="about.php">ABOUT</a>
    <p>OFFERINGS</p>
    <a href="http://store.brassmarkwines.com" target="_blank">STORE</a>
    <a href="contact.php">CONTACT</a>
</div>

<div id="content">
	
	<div id="offering_wrapper">
    	<?php echo $image ?>
        <p class="headline"><?php echo $offering['headline'] ?></p>
        <p class="title"><?php echo $offering['title'] ?></p>
        <p class="date">Posted on <?php echo $offering['date'] ?></p>
        
        <p class="body"><?php echo $offering['body'] ?></p>
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
<link href="styles/global.css" type="text/css" rel="stylesheet" />
</html>
<? ob_flush(); ?>