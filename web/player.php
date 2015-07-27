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
		$overviewformattypestandard == 0;
		$overviewformattypemodern == 0;
		$overviewformattypelegacy == 0;
		$overviewformattypevintage == 0;
		$overviewformattypeblock == 0;
		$overviewformattypelimited == 0;
		$overviewformattypeunknown == 0;
		$overviewformattypeunifiedstandard == 0;
		?>
	
	<?php 
	$mainquery = 'SELECT * FROM Players WHERE ID ="' . $id . '"';

    try
    {
        // These two statements run the query against your database table.
        $stmt = $db->prepare($mainquery);
        $stmt->execute();
    }
    catch(PDOException $ex)
    {
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run query: " . $ex->getMessage());
    }

    // Finally, we can retrieve all of the found rows into an array using fetchAll
    $rowplayer = $stmt->fetch();
	
	?>
	
	
<div class="container">
	<div class="jumbotron" style="padding-bottom: 20px">
	<div class="row">
	
		<div class="col-md-3">
			<div class="cliente" style="border: none;">
			<center>
				<h2><?php echo $rowplayer['Name']; ?></h2>
				
				<?php 	
					$playerimagepng = "images/players/" . $rowplayer['ID'] . ".png";
					$playerimagejpg = "images/players/" . $rowplayer['ID'] . ".jpg";
				
						if (file_exists($playerimagepng)) {							
							echo '<img src="';
							echo $playerimagepng;
							echo '" width="200px" class="img-rounded"><br>';
							echo '&copy; Wizards of the Coast';	
						}
						elseif (file_exists($playerimagejpg)) {
							echo '<img src="';
							echo $playerimagejpg;
							echo '" width="200px" class="img-rounded"><br>';
							echo '&copy; Wizards of the Coast'; 
						}
						else {
							echo '<img src="images/players/unknown.png" width="200px" class="img-rounded"><br>';
						}
				?>
				
				<br><br><br>
				
				
				<?php 
				if ($rowplayer['Twitter'] != '') {
				echo "<img src='images/twitter.png'> <a href='http://www.twitter.com/" . $rowplayer['Twitter'] . "' target='_newtab'>@" . $rowplayer['Twitter'] . "</a><br><br>";
				}  ?>
				</center>
				<br><br>
				<b>Bio:</b><br><br>
				<?php echo $rowplayer['Bio']; ?>
				<br>
				<br>
			</div>
		</div>

		<div class="col-md-9">
			<div class="cliente" style="border: none;">
				<h2>Games:</h2>

	<?php 
	
	echo '<div class="row">';

	
	$query = 'SELECT Matches.VOD, Matches.Format, Matches.PlayerIDA, Matches.PlayerIDB, Matches.DeckIDA, Matches.DeckIDB, Matches.TournamentID, Tournament.Name, Tournament.ID FROM Matches 
			  INNER JOIN Tournament ON Matches.TournamentID=Tournament.ID 
			  WHERE PlayerIDA = "' . $id . '" OR PlayerIDB = "' . $id . '" 
			  ORDER BY Matches.Format DESC';

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

	
	// For each Row in Matches post that Row
	
	foreach($rows as $row): 

	// Declare values from Matches Table
		$M_ID = $row['ID'];
		$M_VOD = $row['VOD'];
		$M_RoundName = $row['RoundName'];
		$M_PlayerIDA = $row['PlayerIDA'];
		$M_PlayerIDB = $row['PlayerIDB'];
		$M_DeckIDA = $row['DeckIDA'];
		$M_DeckIDB = $row['DeckIDB'];
		$M_Format = $row['Format'];
		$M_TournamentID = $row['TournamentID'];
	
		
		
						if ($row['Format'] == 'Standard' && $overviewformattypestandard == 0) {
							echo "<br><h3 class='indentformatheader'>Standard:</h3><br>";
							$overviewformattypestandard = 1; }
				
						if ($row['Format'] == 'Modern' && $overviewformattypemodern == 0) {
							echo "<br><h3 class='indentformatheader'>Modern:</h3><br>";
							$overviewformattypemodern = 1; }
							
						if ($row['Format'] == 'Legacy' && $overviewformattypelegacy == 0) {
							echo "<br><h3 class='indentformatheader'>Legacy:</h3><br>";
							$overviewformattypelegacy = 1; }
							
						if ($row['Format'] == 'Vintage' && $overviewformattypevintage == 0) {
							echo "<br><h3 class='indentformatheader'>Vintage:</h3><br>";
							$overviewformattypevintage = 1; }
							
						if ($row['Format'] == 'Block' && $overviewformattypeblock == 0) {
							echo "<br><h3 class='indentformatheader'>Block:</h3><br>";
							$overviewformattypeblock = 1; }
							
						if ($row['Format'] == 'Limited' && $overviewformattypelimited == 0) {
							echo "<br><h3 class='indentformatheader'>Limited:</h3><br>";
							$overviewformattypelimited = 1; }
							
						if ($row['Format'] == 'Team Unified Standard' && $overviewformattypeunifiedstandard == 0) {
							echo "<br><h3 class='indentformatheader'>Team Unified Standard:</h3><br>";
							$overviewformattypeunifiedstandard = 1; }
							
						if ($row['Format'] == 'Mixed' && $overviewformattypeunknown == 0) {
							echo "<br><h3 class='indentformatheader'>Unknown:</h3><br>";
							$overviewformattypeunknown = 1; }
		
		
		echo '<div class="col-md-2 col-sm-2 col-xs-3 text-center">';
	
		if (strpos($row['VOD'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
		elseif (strpos($row['VOD'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
		echo '<a href=" ' .htmlentities($row["VOD"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">VOD</a>';
		
		echo '</div>';
		
		
			// GET Player A
			
			
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
	
			// For each Row in Matches that matches TournamentID post those rows
			foreach($rows3A as $row3A):
			
			// Declare values from Tournament Table	
			$P_IDA = $row3A['ID'];
			$P_NameA = $row3A['Name'];
			
			
			
			
			
			// If active player is player A hide name.

			//	echo '<a href=player.php?id=' . $P_IDA . '>' . $P_NameA . '</a>';
			
			endforeach; ?>  
			
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
	
			// For each Row in Matches that matches TournamentID post those rows
			foreach($rows4A as $row4A):
			
			// Declare values from Tournament Table	
			$D_IDA = $row4A['ID'];
			$D_DeckA = $row4A['Name'];
		

			// If active player is Player A, show deck, else don't show it.
			if ($P_IDA == $id) {	
				echo '<div class="col-md-10 col-sm-10 col-xs-9">';
				echo '<a href=deck.php?id=' . $D_IDA . '>' . $D_DeckA . '</a>';
			}
			else {

			}
			
			endforeach; ?>  
			
			
			
			
			
			
			
			<?php 
			

			
			
			// GET Player B
			
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
	
			// For each Row in Matches that matches TournamentID post those rows
			foreach($rows3B as $row3B):
			
			// Declare values from Tournament Table	
			$P_IDB = $row3B['ID'];
			$P_NameB = $row3B['Name'];

			// Hide Player B
			// echo '<a href=player.php?id=' . $P_IDB . '>' . $P_NameB . '</a>';

			endforeach; ?>  
			
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
	
			// For each Row in Matches that matches TournamentID post those rows
			foreach($rows4B as $row4B):
			
			// Declare values from Tournament Table	
			$D_IDB = $row4B['ID'];
			$D_DeckB = $row4B['Name'];
			
			if ($P_IDB == $id) {			
				echo '<div class="col-md-10 col-sm-10 col-xs-9">';
				echo '<a href=deck.php?id=' . $D_IDB . '>' . $D_DeckB . '</a>';
				echo ' VS ';
			}
			else {
				echo ' VS ';
				echo '<a href=deck.php?id=' . $D_IDB . '>' . $D_DeckB . '</a>';
			}
			
		
			endforeach; ?>  
			
			<?php 
			
			// If player A is active just show Player B - else show Deck A and  Player A
			if ($P_IDA == $id) {	
			
				foreach($rows3B as $row3B):
			
				// Declare values from Tournament Table	
				$P_IDB = $row3B['ID'];
				$P_NameB = $row3B['Name'];

				// Show Player B
				echo ' (<a href=player.php?id=' . $P_IDB . '>' . $P_NameB . '</a>)';
				echo '</div>';

				endforeach; 			
			}
			
			
			
			
			if ($P_IDB == $id) {
						
				foreach($rows4A as $row4A):
			
				// Declare values from Tournament Table	
				$D_IDA = $row4A['ID'];
				$D_DeckA = $row4A['Name'];
							
				echo '<a href=deck.php?id=' . $D_IDA . '>' . $D_DeckA . '</a>';
						
				endforeach;
				
			
				foreach($rows3A as $row3A):
			
				// Declare values from Tournament Table	
				$P_IDA = $row3A['ID'];
				$P_NameA = $row3A['Name'];
			
				echo ' (<a href=player.php?id=' . $P_IDA . '>' . $P_NameA . '</a>)';
				echo '</div>';
				endforeach;
			
			}
			?>  
			
			
			
			
		<br>
		
	
	<?php endforeach; ?> 
				</div>
			</div>
		</div>
	</div>	
    </div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <?php include 'footer.php'; ?>
  </body>
</html>