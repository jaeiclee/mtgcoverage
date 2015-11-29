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
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  </head>
  <body>
    <?php include 'menu.php'; ?>

	<?php
	$mainquery = 'SELECT * FROM Decks WHERE ID ="' . $id . '"';

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
    $rowdeck = $stmt->fetch();

	?>


<div class="container">
	<div class="jumbotron" style="padding-bottom: 20px">
	<div class="row">

		<div class="col-md-4">
			<div class="cliente" style="border: none;">
				<h2><?php echo $rowdeck['Name']; ?></h2>
				<br>



				<?
				echo '<b>Format: </b>';
				if ($rowdeck['Standard'] == 1) {
					echo 'Standard';
				}
				elseif ($rowdeck['Modern'] == 1) {
					echo 'Modern';
				}
				elseif ($rowdeck['Legacy'] == 1) {
					echo 'Legacy';
				}
				elseif ($rowdeck['Vintage'] == 1) {
					echo 'Vintage';
				}
				elseif ($rowdeck['Limited'] == 1) {
					echo 'Limited';
				}
				elseif ($rowdeck['Block'] == 1) {
					echo 'Block';
				}
				else {
					echo 'Unknown';
				}

				echo '<br>';

				if ($rowdeck['CBlock'] != null) {
					echo '<b>Block: </b>';
					echo $rowdeck['CBlock'];
				}
				?>

				<br>
				<b>Info:</b><br><br>
				<?php echo $rowdeck['Info']; ?>
				<br>
				<br>
			</div>
		</div>

		<div class="col-md-8">
			<div class="cliente" style="border: none;">
				<h2>Games:</h2>

	<?php




	$query = 'SELECT Matches.VOD, Matches.Format, Matches.PlayerIDA, Matches.PlayerIDB, Matches.DeckIDA, Matches.DeckIDB, Matches.TournamentID, Tournament.Name, Tournament.ID FROM Matches
			  INNER JOIN Tournament ON Matches.TournamentID=Tournament.ID
			  WHERE DeckIDA = "' . $id . '" OR DeckIDB = "' . $id . '"
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

		if (strpos($row['VOD'], 'youtu') !== false) { echo '<img src="images/youtube.png"> '; }
		elseif (strpos($row['VOD'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
		echo '<a href=" ' .htmlentities($row["VOD"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">VOD</a>';


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
			?>

			<a href="player.php?id=<?php echo $P_IDA; ?>"><?php echo $P_NameA; ?></a>

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

			// For each Row in Matches that matches TournamentID post those rows
			foreach($rows4A as $row4A):

			// Declare values from Tournament Table
			$D_IDA = $row4A['ID'];
			$D_NameA = $row4A['Name'];

			echo ' (<a href=deck.php?id=' . $D_IDA . '>' . $D_NameA . '</a>)';
			?>

			<?php endforeach; ?>



			<?php echo " VS "; ?>



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
			?>


			<a href="player.php?id=<?php echo $P_IDB; ?>"><?php echo $P_NameB; ?></a>
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

			// For each Row in Matches that matches TournamentID post those rows
			foreach($rows4B as $row4B):

			// Declare values from Tournament Table
			$D_IDB = $row4B['ID'];
			$D_NameB = $row4B['Name'];

			echo ' (<a href=deck.php?id=' . $D_IDB . '>' . $D_NameB . '</a>)';
			?>

			<?php endforeach; ?>
		<br>


	<?php endforeach; ?>








	<?php

	// GET Decktechs

	$decktechquery = 'SELECT * FROM Decktechs WHERE DeckID ="' . $id . '"';

    try
    {
        // These two statements run the query against your database table.
        $stmt = $db->prepare($decktechquery);
        $stmt->execute();
    }
    catch(PDOException $ex)
    {
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run query: " . $ex->getMessage());
    }

    // Finally, we can retrieve all of the found rows into an array using fetchAll
    $rowsdecktechs = $stmt->fetchAll();

	if (count($rowsdecktechs) >= 1) {
	echo'<h2>Decktechs:</h2>';
	}

	foreach($rowsdecktechs as $rowdecktech):

	// Declare values from Matches Table
		$DT_ID = $rowdecktech['ID'];
		$DT_VOD = $rowdecktech['VOD'];
		$DT_PlayerID = $rowdecktech['PlayerID'];
		$DT_DeckID = $rowdecktech['DeckID'];
		$DT_TournamentID = $rowdecktech['TournamentID'];

		if (strpos($DT_VOD, 'youtu') !== false) { echo '<img src="images/youtube.png"> '; }
		elseif (strpos($DT_VOD, 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
		echo '<a href=" ' .htmlentities($DT_VOD, ENT_QUOTES,"UTF-8"). '" target="_newtab" ">VOD</a> ';


		// GET Player Name if available
		if ($DT_PlayerID != '0') {

		$DTplayerquery = 'SELECT ID, Name FROM Players WHERE ID ="' . $DT_PlayerID . '"';

		try
		{
			// These two statements run the query against your database table.
			$stmt = $db->prepare($DTplayerquery);
			$stmt->execute();
		}
		catch(PDOException $ex)
		{
			// Note: On a production website, you should not output $ex->getMessage().
			// It may provide an attacker with helpful information about your code.
			die("Failed to run query: " . $ex->getMessage());
		}

		// Finally, we can retrieve all of the found rows into an array using fetchAll
		$DTplayer = $stmt->fetch();

		echo "by " . $DTplayer['Name'] . "";
		}


		// Get Tournament Name if available
		if ($DT_TournamentID != '0') {

		$DTtournamentquery = 'SELECT ID, Name FROM Tournament WHERE ID ="' . $DT_TournamentID . '"';

		try
		{
			// These two statements run the query against your database table.
			$stmt = $db->prepare($DTtournamentquery);
			$stmt->execute();
		}
		catch(PDOException $ex)
		{
			// Note: On a production website, you should not output $ex->getMessage().
			// It may provide an attacker with helpful information about your code.
			die("Failed to run query: " . $ex->getMessage());
		}

		// Finally, we can retrieve all of the found rows into an array using fetchAll
		$DTtournament = $stmt->fetch();

		echo " at " . $DTtournament['Name'] . "<br>";
		}


		endforeach;
	?>


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
