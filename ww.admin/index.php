	<? ob_start(); ?>
<!DOCTYPE html>
<html>
    <head>
      <title>Brassmark Wines Admin Area</title>
      <link href='admin.css' rel='stylesheet' type='text/css' />
    </head>

<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/database.php");
	if(isset($_REQUEST['dowhat'])) $action = $_REQUEST['dowhat'];
	else if(isset($_REQUEST['addentry'])) {
		foreach($_REQUEST as $k => $v) {
			$$k = html_entity_decode(mysql_real_escape_string($v));
		}
		if($title != '' && $headline != '' && $date != '' && $body != '') {
			if($image) $sql = "INSERT INTO offerings (title, headline, date, image, body) VALUES 
												('$title', '$headline', str_to_date('$date', '%m/%d/%Y'), '$image', '$body')";
			else $sql = "INSERT INTO offerings (title, headline, date, body) VALUES 
									('$title', '$headline', str_to_date('$date', '%m/%d/%Y'), '$body')"; 
			$database->query($sql);
			echo "<script type='text/javascript'>alert('Your submission has been added');</script>";
			$action = NULL;
		} else {
				echo "<script type='text/javascript'>alert('Please fill out all fields');</script>";
				$action = 'nothing';
				newEntry(array('title'=>$title, 'headline'=>$headline, 'date'=>$date, 'image'=>$image, 'body'=>$body));
		}
	}
	else if(isset($_REQUEST['search'])) {
		foreach($_REQUEST as $k => $v) {
			$$k = mysql_real_escape_string(htmlspecialchars($v));
		}
		$sql = "SELECT id, title, DATE_FORMAT(date, '%m/%d/%Y') 
						as date FROM offerings WHERE title = '$title' OR headline = '$headline' 
						OR DATE_FORMAT(date, '%m/%d/%Y') = '$date' ORDER BY date, title";
		$results = $database->query($sql);
		if($database->num_rows($results) != 0) {
			$titles = array();
			$dates = array();
			$ids = array();
			while($r = $database->fetch_assoc($results)) {
				array_push($ids, $r['id']);
				array_push($titles, $r['title']);
				array_push($dates, $r['date']);
			}
			$listings = array($ids, $titles, $dates);
			$action = 'edit';
		} else {
			echo "No results found. Please check your search criteria.";
			$action = 'search';
		}
	}
	else if(isset($_REQUEST['editid'])) {
		$id = $_REQUEST['editid'];
		$action = 'nothing';
		$sql = "SELECT id, title, headline, DATE_FORMAT(date, '%m/%d/%Y') as date,
						image, body FROM offerings WHERE id = '$id'";
		$results = $database->query($sql);
		$fields = $database->fetch_assoc($results);
		newEntry($fields, 'Edit Entry', 'editentry', 'Update');
	}
	else if(isset($_REQUEST['editentry'])) {
		foreach($_REQUEST as $k => $v) {
			$$k = html_entity_decode(mysql_real_escape_string($v));
		}
		$tmp = $database->query("SELECT STR_TO_DATE('$date', '%m/%d/%Y') AS date");
		$tmp = $database->fetch_assoc($tmp);
		$date = $tmp['date'];
		if($title != '' && $headline != '' && $date != '' && $body != '') {
			if($image) $sql = "UPDATE offerings SET title = '$title', headline = '$headline',
												date = '$date', image = '$image', body = '$body' WHERE id = '$id'";
			else $sql = "UPDATE offerings SET title = '$title', headline = '$headline',
									date = '$date', body = '$body' WHERE id = '$id'"	;
			$database->query($sql);
			echo "<script type='text/javascript'>alert('The entry has been updated');</script>";
			$action = NULL;
		} else {
				echo "<script type='text/javascript'>alert('Please fill out all fields');</script>";
				$action = 'nothing';
				newEntry(array('title'=>$title, 'headline'=>$headline, 'date'=>$date, 'image'=>$image, 'body'=>$body));
		}
	}
	else $action = NULL;
	
	function choose() {
			echo "<body>
							<div id='choice-holder'>
								<p>What would you like to do today?</p>
								<form id='choices' method='post'>
									<input type='radio' name='dowhat' value='new'>Create a new entry <br>
									<input type='radio' name='dowhat' value='search'>Edit an existing entry <br>
									<input type='radio' name='dowhat' value='leave'>Get me out of here! <br>
									<input type='submit' name='action' value='Do it!' />
								</form>
							</div>
							</body>";

	}
	
	function newEntry($fields = array('id'=>'', 'title'=>'', 'headline'=>'', 'date'=>'', 'image'=>'', 'body'=>''), $title = 'Create a New Entry', 
																			$name = 'addentry'	, $button = 'Add Entry') {
		echo '<body>
						<div id="new-entry">
							<form id="entry-form" method="post">
								<table border="0">
									<tr>
										<td id="header" colspan="4">'. $title .'</td>
									</tr>
									<tr>
										<td><label for="title">Title:</label></td>
										<td><input type="text" name="title" value="'. $fields['title'] .'" tabindex="1"></td>
										<td class="instructions" colspan="2">Title of article</td>
									</tr>
									<tr>
										<td><label for="headline">Headline:</label></td>
										<td><input type="text" name="headline" value="' . $fields['headline'] .'" tabindex="2"></td>
										<td class="instructions" colspan="2">Short description of article</td>
									</tr>
									<tr>
										<td><label for="date">Date:</label></td>
										<td><input type="text" name="date" value="'. $fields['date'] .'" tabindex="3"></td>
										<td class="instructions" colspan="2">mm/dd/yyyy</td>
									</tr>
									<tr>
										<td><label for="image">Image:</label></td>
										<td><input type="text" name="image" value="'. $fields['image'] .'" tabindex="4"></td>
										<td class="instructions" colspan="2">Name (with extension) of associated image. Make sure the proper file is located
											in the /assets/offerings/ folder and is approximately 165 by 165 pixels (give or take).</td>
									</tr>
									<tr>
										<td><label for="body">Article Text:</label></td>
										<td colspan="3"><textarea name="body" id="body" tabindex="5">'. $fields['body'] .'</textarea></td>
									</tr>
									<tr>
										<td></td>
										<td colspan="2"><input type="submit" value="Back" tabindex="6"></td>
										<td><input style="visibility: hidden;" type="text" name="id" value="'. 
												$fields['id'] 
												.'"><input type="submit" name="'. $name .'" value="'. $button .'" tabindex="7">
										</td>
									</tr>
							</form>
						</div>
					</body>';
	}
	
	function showSearch() {
		echo '<body>
						<div id="search-holder">
							<form id="search-form" method="post">
								<table border="0">
									<tr>
										<td></td>
										<td><p>Search by:</p></td>
										<td></td>
									</tr>
									<tr>
										<td><label for="title">Title</label></td>
										<td><input type="text" name="title" tabindex="1"></td>
										<td></td>
									</tr>
									<tr>
										<td><label for="headline">Headline</label></td>
										<td><input type="text" name="headline" tabindex="2"></td>
										<td></td>
									</tr>
									<tr>
										<td><label for="date">Date</label></td>
										<td><input type="text" name="date" tabindex="3"></td>
										<td><p>(mm/dd/yyyy)</p></td>
									</tr>
									<tr>
										<td></td>
										<td><p>Fill in one or more fields</p></td>
										<td></td>
									</tr>
									<tr>
										<td></td>
										<td>
											<input type="submit" value="Back" tabindex="4">
											<input type="submit" name="search" value="Search"	tabindex="5">
										</td>
										<td></td>
									<tr>
								</table>
							</form>
						</div>
					</body>';
	}
	
	function showList() {
		global $listings;
		echo "<body>
						<div id='list-holder'>
							<p>Which entry would you like to edit?</p>
							<center><form id='list' method='post'>
							";
								for ($i = 0; $i < count($listings[0]); $i++) {
									echo "<input type='radio' name='editid' value='{$listings[0][$i]}'>   {$listings[1][$i]} - {$listings[2][$i]}<br>";
								}
						echo "<input type='submit' name='dowhat' value='Back' /><input type='submit' name='chosen' value='Edit' />
								</form></center>
							</div>
						</body>";
	}
	
	if(!$action) echo choose();
	else {
		switch($action) {
			case 'new':
				newEntry();
				break;
			case 'search':
			case 'Back':
				showSearch();
				break;
			case 'edit':
				showList();
				break;
			case 'leave':
				header('Location: /');
				break;
			default:
				break;
		}
		
		
	}
?>

</html>
<? ob_flush(); ?>