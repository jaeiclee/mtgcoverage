<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MTGCoverage</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<?php require 'config.php'; ?>
	
	<link href="css/navbar.css" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

  </head>
  <body>
    <?php include 'menu.php'; ?>
	
	
	<?php 
	
	if ($formattype != '') {
		if ($formattype == 'standard') {
			$query = "SELECT * FROM Tournament WHERE Format = 'Standard' AND Visible = '1' ORDER BY EndDate DESC";
			}
		elseif ($formattype == 'modern') {
			$query = "SELECT * FROM Tournament WHERE Format = 'Modern' AND Visible = '1' ORDER BY EndDate DESC";
			}
		elseif ($formattype == 'legacy') {
			$query = "SELECT * FROM Tournament WHERE Format = 'Legacy' AND Visible = '1' ORDER BY EndDate DESC";
			}
		elseif ($formattype == 'vintage') {
			$query = "SELECT * FROM Tournament WHERE Format = 'Vintage' AND Visible = '1' ORDER BY EndDate DESC";
			}
		elseif ($formattype == 'limited') {
			$query = "SELECT * FROM Tournament WHERE Format = 'Limited' AND Visible = '1' ORDER BY EndDate DESC";
			}
		elseif ($formattype == 'block') {
			$query = "SELECT * FROM Tournament WHERE Format = 'Block' AND Visible = '1' ORDER BY EndDate DESC";
			}
		elseif ($formattype == 'mixed') {
			$query = "SELECT * FROM Tournament WHERE Format = 'Mixed' AND Visible = '1' ORDER BY EndDate DESC";
			}		
	}
	else {
	
		if 	($id != '') {
			// $ids = join(',',$id); 
			$query = "SELECT * FROM Tournament WHERE ID = " . $id . " AND Visible = '1' ORDER BY EndDate DESC";
			}
	
		else 	{ $query = "SELECT * FROM Tournament WHERE Visible = '1' ORDER BY EndDate DESC LIMIT 10";
			}
	}
    try
    {
        // These two statements run the query against your database table.
        $stmt = $db->prepare($query);
        $stmt->execute();
    }
    catch(PDOException $ex)
    {
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run query: " . $ex->getMessage());
    }

    // Finally, we can retrieve all of the found rows into an array using fetchAll
    $rows = $stmt->fetchAll();

	// For each Row in Tournament post that Row
	foreach($rows as $row): 

	// Declare values from Tournament Table
	$T_ID = $row['ID']; 
	$T_Name = $row['Name'];
	$T_Visible = $row['Visible']; 
	$T_Finished = $row['Finished'];
	$T_Format = $row['Format'];
	$T_Organiser = $row['Organiser']; 
	$T_Location = $row['Location']; 
	$T_StartDate = $row['StartDate']; 
	$T_EndDate = $row['EndDate']; 
	$T_InfoLink = $row['InfoLink']; 
	$T_ResultLink = $row['ResultLink']; 
	$T_ExtraText = $row['ExtraText']; 
	
	
	// Reformat dates to look pretty
	

	$check_format_startdate = date("F", strtotime($row['StartDate']));
	$check_format_enddate = date("F", strtotime($row['EndDate']));

	if ($check_format_startdate != $check_format_enddate) {
	$nice_format_startdate = date("jS F", strtotime($row['StartDate']));
	$nice_format_enddate = date("jS F Y", strtotime($row['EndDate']));

	}
	elseif ($row['StartDate'] == $row['EndDate']) {

	$nice_format_enddate = date("jS F Y", strtotime($row['EndDate']));
	// echo htmlentities($nice_format_enddate, ENT_QUOTES, 'UTF-8'); 
	}
	else {
	$nice_format_startdate = date("jS", strtotime($row['StartDate']));
	$nice_format_enddate = date("jS F Y", strtotime($row['EndDate']));
		}
	
	
	// Opening Jumbotron
	echo '<div class="container" id="jumbo">';
    echo '<div class="jumbotron">';
	
		echo '<div class="row">';
			echo '<div class="col-md-3 vcenter">';
			echo "<img src='";
				if (strpos ($row['Organiser'], 'GP') !== false) { echo 'images/gp.png'; }
				elseif (strpos ($row['Organiser'], 'SCG') !== false) { echo 'images/scglive.png'; }
				elseif (strpos ($row['Organiser'], 'PT') !== false) { echo 'images/pt.png'; }
				elseif (strpos ($row['Organiser'], 'BOM') !== false) { echo 'images/bom.png'; }
				elseif (strpos ($row['Organiser'], 'CFB') !== false) { echo 'images/cfb.png'; }
				elseif (strpos ($row['Organiser'], 'TCG') !== false) { echo 'images/tcg.png'; }
				elseif (strpos ($row['Organiser'], 'CT') !== false) { echo 'images/cardtitan.png'; }
				elseif (strpos ($row['Organiser'], 'SCV') !== false) { echo 'images/scv.png'; }
				elseif (strpos ($row['Organiser'], 'CA') !== false) { echo 'images/ca.png'; }
				elseif (strpos ($row['Organiser'], 'WORLDS') !== false) { echo 'images/worlds.png'; }
				elseif (strpos ($row['Organiser'], 'HRRY') !== false) { echo 'images/hareruya.png'; }
				else { echo 'images/empty.png'; }
			echo "' width='150px' class='img-responsive'>";
			echo '</div>';
			
			echo '<div class="col-md-9 vcenter">';
			echo '<h3><b>' . $T_Name . '</b></h3>';
			echo '<p>' . $nice_format_startdate .' - '. $nice_format_enddate . '<br>';
			echo 'Format: ' . $T_Format . '</p>';
			echo '</div>';
		

		echo '</div>';
	echo '<div>';
	?>

	<!-- POPDOWN FOR EACH EVENT -->
	
    <script type="text/javascript">
	$(document).ready(function(){
	$("#expanderHead<?php echo htmlentities($row['ID'], ENT_QUOTES, 'UTF-8'); ?>").click(function(){
		$("#expanderContent<?php echo htmlentities($row['ID'], ENT_QUOTES, 'UTF-8'); ?>").slideToggle();
		if ($("#expanderSign<?php echo htmlentities($row['ID'], ENT_QUOTES, 'UTF-8'); ?>").text() == "+"){
			$("#expanderSign<?php echo htmlentities($row['ID'], ENT_QUOTES, 'UTF-8'); ?>").html("−")
		}
		else {
			$("#expanderSign<?php echo htmlentities($row['ID'], ENT_QUOTES, 'UTF-8'); ?>").text("+")
		}
	});
	});
	</script>
	
	<div>
	<center><b><span id="expanderHead<?php echo htmlentities($row['ID'], ENT_QUOTES, 'UTF-8'); ?>" style="cursor:pointer;">
	Click to Expand <span id="expanderSign<?php echo htmlentities($row['ID'], ENT_QUOTES, 'UTF-8'); ?>">+</span></span></b></center>
	</div>
	
	
	<div id="expanderContent<?php echo htmlentities($row['ID'], ENT_QUOTES, 'UTF-8'); ?>" style="display:none;">

		

	<!-- Open table  -->

	
	<table class="table">
	<thead>
		<tr>
			<th>Link</th>
			<th></th>
			<th class="text-right">Player</th>
			<th class="text-left">Player</th>
			<th class="text-right">Deck</th>
			<th class="text-left">Deck</th>
			
			
		</tr>
	</thead>
	<tbody>
	
		<?php 
	
		// Get Values from Matches loop
		// 
	
		$querymatches = 'SELECT * FROM Matches WHERE TournamentID = "' . $T_ID . '" ORDER BY 
						(CASE WHEN RoundName = "Finals" THEN 2 ELSE 1 END),
						(CASE WHEN RoundName = "Semi Finals 2" THEN 2 ELSE 1 END), 
						(CASE WHEN RoundName = "Semi Finals" THEN 2 ELSE 1 END),
						(CASE WHEN RoundName = "Quarter Finals 4" THEN 2 ELSE 1 END),
						(CASE WHEN RoundName = "Quarter Finals 3" THEN 2 ELSE 1 END),
						(CASE WHEN RoundName = "Quarter Finals 2" THEN 2 ELSE 1 END),
						(CASE WHEN RoundName = "Quarter Finals" THEN 2 ELSE 1 END), 
						SUBSTRING_INDEX(RoundName, " ", 1) ASC, CAST(SUBSTRING_INDEX(RoundName, " ", -1) AS SIGNED)';
		try
		{
			// These two statements run the query against your database table.
			$stmt2 = $db->prepare($querymatches);
			$stmt2->execute();
		}
		catch(PDOException $ex)
		{
			// Note: On a production website, you should not output $ex->getMessage().
			// It may provide an attacker with helpful information about your code.
			die("Failed to run query: " . $ex->getMessage());
		}

		// Finally, we can retrieve all of the found rows into an array using fetchAll
		$rows2 = $stmt2->fetchAll();
	
		// For each Row in Matches that matches TournamentID post those rows
		foreach($rows2 as $row2):
		// Declare values from Tournament Table	
		$M_ID = $row2['ID'];
		$M_VOD = $row2['VOD'];
		$M_RoundName = $row2['RoundName'];
		$M_PlayerIDA = $row2['PlayerIDA'];
		$M_PlayerIDB = $row2['PlayerIDB'];
		$M_DeckIDA = $row2['DeckIDA'];
		$M_DeckIDB = $row2['DeckIDB'];
		$M_Format = $row2['Format'];
		$M_TournamentID = $row2['TournamentID'];
		?>
		
	<tr>		
	<td>
		<?php 
		if (strpos($row2['VOD'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
		elseif (strpos($row2['VOD'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
		echo '<a href=" ' .htmlentities($row2["VOD"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">' .htmlentities($row2["RoundName"], ENT_QUOTES,"UTF-8"). '</a><br>';
		?>
	</td>
	<td>
		<?php if ($T_Format == "Mixed") { echo $M_Format; } ?></td>
	
	
	<?php 
	
	// Check if spoilerprotection are enabled
	
	if ($SD == '1') {
	}
	else {
	
	?>
	
			<?php 
			
			// GET Player A Things loop
			
			
			$queryplayersA = 'SELECT ID, Name FROM Players WHERE ID = "' . $M_PlayerIDA . '"' ;
			try
			{
				// These two statements run the query against your database table.
				$stmt3A = $db->prepare($queryplayersA);
				$stmt3A->execute();
			}
			catch(PDOException $ex)
			{
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code.
				die("Failed to run query: " . $ex->getMessage());
			}

			// Finally, we can retrieve all of the found rows into an array using fetchAll
			$rows3A = $stmt3A->fetchAll();
			?>
			<?php 
	
			// For each Row in Matches that matches TournamentID post those rows
			foreach($rows3A as $row3A):
			
			// Declare values from Tournament Table	
			$P_IDA = $row3A['ID'];
			$P_NameA = $row3A['Name'];
			?>
			
			<td class="text-right"><a href=player.php?id=<?php echo $P_IDA; ?>><?php echo $P_NameA; ?></a></td>
			
			<?php endforeach; ?>  
			
			
			
			<?php 
			
			// GET Player B Things Loop
			
			$queryplayersB = 'SELECT ID, Name FROM Players WHERE ID = "' . $M_PlayerIDB . '"';
			try
			{
				// These two statements run the query against your database table.
				$stmt3B = $db->prepare($queryplayersB);
				$stmt3B->execute();
			}
			catch(PDOException $ex)
			{
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code.
				die("Failed to run query: " . $ex->getMessage());
			}

			// Finally, we can retrieve all of the found rows into an array using fetchAll
			$rows3B = $stmt3B->fetchAll();
			?>
			<?php 
	
			// For each Row in Matches that matches TournamentID post those rows
			foreach($rows3B as $row3B):
			
			// Declare values from Tournament Table	
			$P_IDB = $row3B['ID'];
			$P_NameB = $row3B['Name'];
			?>
			
		
			<td><a href=player.php?id=<?php echo $P_IDB; ?>><?php echo $P_NameB; ?></a></td>
			
	
			<?php endforeach; ?>   
			
			
			
			
			
			<?php
			// GET Deck A
			
			
			$querydecksA = 'SELECT ID, Name FROM Decks WHERE ID = "' . $M_DeckIDA . '"' ;
			try
			{
				// These two statements run the query against your database table.
				$stmt4A = $db->prepare($querydecksA);
				$stmt4A->execute();
			}
			catch(PDOException $ex)
			{
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code.
				die("Failed to run query: " . $ex->getMessage());
			}

			// Finally, we can retrieve all of the found rows into an array using fetchAll
			$rows4A = $stmt4A->fetchAll();
			?>
			<?php 
	
			// For each Row in Matches that matches TournamentID post those rows
			foreach($rows4A as $row4A):
			
			// Declare values from Tournament Table	
			$D_IDA = $row4A['ID'];
			$D_DeckA = $row4A['Name'];
			?>
			
			<td class="text-right"><a href=deck.php?id=<?php echo $D_IDA; ?>><?php echo $D_DeckA; ?></a></td>
			
			<?php endforeach; ?>  
			
			
			<?php
			// GET Deck B
			
			
			$querydecksB = 'SELECT ID, Name FROM Decks WHERE ID = "' . $M_DeckIDB . '"' ;
			try
			{
				// These two statements run the query against your database table.
				$stmt4B = $db->prepare($querydecksB);
				$stmt4B->execute();
			}
			catch(PDOException $ex)
			{
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code.
				die("Failed to run query: " . $ex->getMessage());
			}

			// Finally, we can retrieve all of the found rows into an array using fetchAll
			$rows4B = $stmt4B->fetchAll();
			?>
			<?php 
	
			// For each Row in Matches that matches TournamentID post those rows
			foreach($rows4B as $row4B):
			
			// Declare values from Tournament Table	
			$D_IDB = $row4B['ID'];
			$D_DeckB = $row4B['Name'];
			?>
			
			<td><a href=deck.php?id=<?php echo $D_IDB; ?>><?php echo $D_DeckB; ?></a></td></tr>
			
			<?php endforeach; ?>  
			
			
			


		<?php // End Spoiler tag
		}
		?>
		
		<?php endforeach; ?> 
		
	</tbody>
	</table>
	
	<br><br>
	
	
			<center>
			<?php 
			if ($T_ResultLink == '') {echo 'Results<br><br>';} else { echo '<a href=" ' .htmlentities($T_ResultLink, ENT_QUOTES,"UTF-8"). '" target="_newtab">Results</a><br><br>' ;}
			?>
			</center>
			
			<?php 
			if ($T_ExtraText == '') {echo '';} else { echo $T_ExtraText;} 
			?>

			<?php include 'i-decktechs.php'; ?>
			<?php include 'i-extra.php'; ?>
				

	
	<!--  Closing Expand Button DIV -->
	</div>
	<!--  Closing Jumbotron -->
	</div>
	</div>
	</div>

	<?php endforeach; ?>   
	

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>