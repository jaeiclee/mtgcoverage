		<?php

		// Get Values from Decktech loop

		$querydt = 'SELECT * FROM Decktechs WHERE TournamentID = "' . $T_ID . '" ORDER BY ID';
		try
		{
			// These two statements run the query against your database table.
			$stmtdt = $db->prepare($querydt);
			$stmtdt->execute();
		}
		catch(PDOException $ex)
		{
			// Note: On a production website, you should not output $ex->getMessage().
			// It may provide an attacker with helpful information about your code.
			die("Failed to run query: " . $ex->getMessage());
		}

		// Finally, we can retrieve all of the found rows into an array using fetchAll
		$rowsdt = $stmtdt->fetchAll();
		$count = $stmtdt->rowCount();

	if ($count > 0) {
	echo '<table class="table">';
	echo '<thead>';
	echo '	<tr>';
	echo '		<th>Decktechs:</th>';
	echo '		<th></th>';
	echo '	</tr>';
	echo '</thead>';
	echo '<tbody>';


		// For each Row in Decktech that matches TournamentID post those rows
		foreach($rowsdt as $rowdt):
		// Declare values from Decktech Table
		$DT_ID = $rowdt['ID'];
		$DT_VOD = $rowdt['VOD'];
		$DT_PlayerID = $rowdt['PlayerID'];
		$DT_DeckID = $rowdt['DeckID'];
		$DT_TournamentID = $rowdt['TournamentID'];


	echo '<tr>';
	echo '<td class="col-md-2">';

		if (strpos($rowdt['VOD'], 'youtu') !== false) { echo '<img src="images/youtube.png"> '; }
		elseif (strpos($rowdt['VOD'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }

		echo '<a href=" ' .htmlentities($rowdt["VOD"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">VOD</a><br>';

	echo '</td>';


			// GET Player from Decktechs


			$queryplayersdt = 'SELECT ID, Name FROM Players WHERE ID = "' . $DT_PlayerID . '"';
			try
			{
				// These two statements run the query against your database table.
				$stmtpdt = $db->prepare($queryplayersdt);
				$stmtpdt->execute();
			}
			catch(PDOException $ex)
			{
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code.
				die("Failed to run query: " . $ex->getMessage());
			}

			// Finally, we can retrieve all of the found rows into an array using fetchAll
			$rowspdt = $stmtpdt->fetchAll();

			// For each Row in Matches that matches TournamentID post those rows
			foreach($rowspdt as $rowpdt):

			// Declare values from Tournament Table
			$DT_ID = $rowpdt['ID'];
			$DT_Name = $rowpdt['Name'];


			echo '<td class="col-md-10"><a href=player.php?id=' . $DT_ID . '>' . $DT_Name . '</a> with ';

			endforeach;


			// GET Deck FROM Decktech


			$querydecksddt = 'SELECT ID, Name FROM Decks WHERE ID = "' . $DT_DeckID . '"';
			try
			{
				// These two statements run the query against your database table.
				$stmtddt = $db->prepare($querydecksddt);
				$stmtddt->execute();
			}
			catch(PDOException $ex)
			{
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code.
				die("Failed to run query: " . $ex->getMessage());
			}

			// Finally, we can retrieve all of the found rows into an array using fetchAll
			$rowsddt = $stmtddt->fetchAll();

			// For each Row in Matches that matches TournamentID post those rows
			foreach($rowsddt as $rowddt):

			// Declare values from Tournament Table
			$DT_ID = $rowddt['ID'];
			$DT_Name = $rowddt['Name'];
			$DT_ExtraText = $rowddt['ExtraText'];
			echo '<a href=deck.php?id=' . $DT_ID . '>' . $DT_Name . '</a>';
			if ($DT_ExtraText) { echo ' (' . $DT_ExtraText . ')'; }
			echo '</td></tr>';
			endforeach;


			endforeach;
			echo '</tbody>';
			echo '</table>';
			echo '<br>';
}
?>
