		<?php 
	
		// Get Values from Extra loop
	
		$queryex = 'SELECT * FROM Extra WHERE TournamentID = "' . $T_ID . '" ORDER BY ID';
		try
		{
			// These two statements run the query against your database table.
			$stmtex = $db->prepare($queryex);
			$stmtex->execute();
		}
		catch(PDOException $ex)
		{
			// Note: On a production website, you should not output $ex->getMessage().
			// It may provide an attacker with helpful information about your code.
			die("Failed to run query: " . $ex->getMessage());
		}

		// Finally, we can retrieve all of the found rows into an array using fetchAll
		$rowsex = $stmtex->fetchAll();	
		$countex = $stmtex->rowCount();

	if ($countex > 0) {
	echo '<table class="table">';
	echo '<thead>';
	echo '	<tr>';
	echo '		<th>Extra:</th>';
	echo '		<th></th>';
	echo '	</tr>';
	echo '</thead>';
	echo '<tbody>';
	
	
		// For each Row in Extra that matches TournamentID post those rows
		foreach($rowsex as $rowex):
		// Declare values from Extra Table	
		$EX_ID = $rowex['ID'];
		$EX_Name = $rowex['Name'];
		$EX_VOD = $rowex['VOD'];
		$EX_PlayerID = $rowex['PlayerID'];
		$EX_DeckID = $rowex['DeckID'];
		$EX_TournamentID = $rowex['TournamentID'];

		
	echo '<tr>';	
		echo '<td class="col-md-2 col-sm-2 col-xs-2">';

		if (strpos($rowex['VOD'], 'youtube') !== false) { echo '<img src="images/youtube.png"> '; }
		elseif (strpos($rowex['VOD'], 'twitch') !== false) { echo '<img src="images/twitch.png"> '; }
		
		echo '<a href=" ' .htmlentities($rowex["VOD"], ENT_QUOTES,"UTF-8"). '" target="_newtab" ">VOD</a><br>';
		
		echo '</td>';
	
		echo '<td class="col-md-10 col-sm-10 col-xs-10">';
		echo $EX_Name;

			
			// GET Player from Extra
			
			
			$queryplayersex = 'SELECT ID, Name FROM Players WHERE ID = "' . $EX_PlayerID . '"';
			try
			{
				// These two statements run the query against your database table.
				$stmtpex = $db->prepare($queryplayersex);
				$stmtpex->execute();
			}
			catch(PDOException $ex)
			{
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code.
				die("Failed to run query: " . $ex->getMessage());
			}

			// Finally, we can retrieve all of the found rows into an array using fetchAll
			$rowspex = $stmtpex->fetchAll();
	
			// For each Row in Matches that matches TournamentID post those rows
			foreach($rowspex as $rowpex):
			
			// Declare values from Tournament Table	
			$PEX_ID = $rowpex['ID'];
			$PEX_Name = $rowpex['Name'];

			
			echo ' (<a href=player.php?id=' . $PEX_ID . '>' . $PEX_Name . '</a>) '; 
			
			endforeach;
			

			// GET Deck FROM Extra
			
			
			$querydecksdex = 'SELECT ID, Name FROM Decks WHERE ID = "' . $EX_DeckID . '"';
			try
			{
				// These two statements run the query against your database table.
				$stmtdex = $db->prepare($querydecksdex);
				$stmtdex->execute();
			}
			catch(PDOException $ex)
			{
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code.
				die("Failed to run query: " . $ex->getMessage());
			}

			// Finally, we can retrieve all of the found rows into an array using fetchAll
			$rowsdex = $stmtdex->fetchAll();
	
			// For each Row in Matches that matches TournamentID post those rows
			foreach($rowsdex as $rowdex):
			
			// Declare values from Tournament Table	
			$DEX_ID = $rowdex['ID'];
			$DEX_Name = $rowdex['Name'];
			
			
			echo ' (' . $DEX_Name . ') ';
			
			endforeach; 
			
			echo '</td></tr>';

			endforeach;
			
			echo '</tbody>';
			echo '</table>';
			echo '<br>';
}
?>