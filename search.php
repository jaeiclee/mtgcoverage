<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search</title>

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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
 </head>
 <body>
      <?php include 'menu.php'; ?>
<div class="container">

	      <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">

		<div class="row">
      <div class="col-md-3">
  			<div class="cliente" style="border: none;">
  				<h2>Search Results</h2>
  				<br>
  			</div>
  		</div>
       <div class="col-md-6">


	<?php

// Player Search

echo "<h3>Players</h3>";

	$min_length = 3;

    $query = $_GET['searchquery'];
    // gets value sent over search form


    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then

        $query = htmlspecialchars($query);

		 $sql = "SELECT ID, Name FROM Players WHERE Name LIKE '%".$query."%' ORDER BY Name ASC";
			try
			{
				// These two statements run the query against your database table.
				$stmt = $db->prepare($sql);
				$stmt->execute();
				$count = $stmt -> rowCount();
			}
			catch(PDOException $ex)
			{
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code.
				// die("Failed to run query: " . $ex->getMessage());
        die("That's a weird name.");
			}

			// Finally, we can retrieve all of the found rows into an array using fetchAll
			$rows = $stmt->fetchAll();

			// For each Row in Matches that matches TournamentID post those rows

			if (count($rows) >= 1) { // If one or more results, show on right side

			foreach($rows as $row) {
					$p_ID = $row['ID'];
					$p_Name = $row['Name'];

					echo '<a href="player.php?id='. $p_ID . '">'. $p_Name . '</a>';
					echo '<br>';


			}
					}

   /* No rows matched -- do something else */
				else {
					print "No Results.";
					}




    }

	if(strlen($query) == 0){ // if query length is 0
	}
	elseif(strlen($query) < $min_length){ // if query length is less than minimum

		echo "<br>Your query is too short.";
	}
    else{
    }
?>


<?php

// Deck Search

echo "<h3>Decks</h3>";

	$min_length = 3;

    $query = $_GET['searchquery'];
    // gets value sent over search form


    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then

     $query = htmlspecialchars($query);

		 $sql = "SELECT * FROM Decks WHERE Name LIKE '%".$query."%' ORDER BY Standard DESC, Modern DESC, Legacy DESC, Vintage DESC, Block DESC, Limited DESC, Name ASC";
			try
			{
				// These two statements run the query against your database table.
				$stmt = $db->prepare($sql);
				$stmt->execute();
				$count = $stmt -> rowCount();
			}
			catch(PDOException $ex)
			{
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code.
				// die("Failed to run query: " . $ex->getMessage());
        die("That's a weird name.");
			}

			// Finally, we can retrieve all of the found rows into an array using fetchAll
			$rows = $stmt->fetchAll();

			// For each Row in Matches that matches TournamentID post those rows

			if (count($rows) >= 1) { // If one or more results, show on right side of the page

			foreach($rows as $row) {
					$p_ID = $row['ID'];
					$p_Name = $row['Name'];
					$p_CBlock = $row['CBlock'];

					echo '<a href="deck.php?id='. $p_ID . '">'. $p_Name . '</a>';
					if ($p_CBlock != null) {
						echo ' ( ' . $p_CBlock . ' )';
					}
					echo '<br>';


			}
					}

   /* No rows matched -- do something else */
				else {
					print "No Results.";
					}




    }

	if(strlen($query) == 0){ // if query length is 0
	}

	elseif(strlen($query) < $min_length){ // if query length is less than minimum

		echo "<br>Your query is too short.";
	}
    else{
    }
?>

<?php

// Tournament Search
echo "<h3>Tournaments</h3>";

	$min_length = 3;

    $query = $_GET['searchquery'];
    // gets value sent over search form


    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then

        $query = htmlspecialchars($query);

		 $sql = "SELECT ID, Name, Format, EndDate FROM Tournament WHERE Visible = '1' AND Name LIKE '%".$query."%' ORDER BY EndDate DESC";
			try
			{
				// These two statements run the query against your database table.
				$stmt = $db->prepare($sql);
				$stmt->execute();
				$count = $stmt -> rowCount();
			}
			catch(PDOException $ex)
			{
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code.
				// die("Failed to run query: " . $ex->getMessage());
        die("That's a weird name.");
			}

			// Finally, we can retrieve all of the found rows into an array using fetchAll
			$rows = $stmt->fetchAll();

			// For each Row in Matches that matches TournamentID post those rows

			if (count($rows) >= 1) { // If one or more results, show on right side

			foreach($rows as $row) {
					$t_ID = $row['ID'];
					$t_Name = $row['Name'];
					$t_Format = $row['Format'];
					$t_EndDate = $row['EndDate'];

					echo $t_EndDate . ' <a href="index.php?id='. $t_ID . '">'. $t_Name . '</a> (' . $t_Format . ')';
					echo '<br>';


			}
					}

   /* No rows matched -- do something else */
				else {
					echo 'No Results.';
					}
    }

	if(strlen($query) == 0){ // if query length is 0
	}
	elseif(strlen($query) < $min_length){ // if query length is less than minimum

		echo "<br>Your query is too short.";
	}
    else{
    }
?>

<br><br>

	</div>
	</div>

		</div>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <?php include 'footer.php'; ?>
  </body>
</html>
