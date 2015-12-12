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


		<?php
		$overviewformattypestandard == 0;
		$overviewformattypemodern == 0;
		$overviewformattypelegacy == 0;
		$overviewformattypevintage == 0;
		$overviewformattypeblock == 0;
		$overviewformattypelimited == 0;
		$overviewformattypeunknown == 0;
		?>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
 </head>
 <body>
      <?php include 'menu.php'; ?>
<div class="container">

	      <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">

		<div class="row">
			<div class="col-md-6">

        <h3>Search Players:</h3>


        <?php

$query = "SELECT Name FROM Players GROUP BY Name ORDER BY Name ASC";


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
        // die("Failed to run query: " . $ex->getMessage());
        die("That's a weird name.");
    }

    // Finally, we can retrieve all of the found rows into an array using fetchAll
    $rows = $stmt->fetchAll();

?>
<div class="row">
	<form role="form" class="form" action="" method="GET">
		<div class="col-xs-8 col-md-8">
			<div class="form-group">
				<select name="player" class="form-control" style=width:100%>
				<option value=""></option>
				<?php foreach($rows as $row): ?>

				<option value="<?php echo htmlentities($row['Name'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlentities($row['Name'], ENT_QUOTES, 'UTF-8'); ?></option>
				<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-xs-4 col-md-4">
			<button type="submit" class="btn btn-default">Search</button>
		</div>
	</div>
</form>

<br>


        <div class="row">
			<form class="form" role="form" action="" method="GET">
				<div class="col-xs-8 col-md-8">
					<div class="form-group">
						<input class="form-control" name="player" type="text" style=width:100%>
					</div>
				</div>
					<div class="col-xs-4 col-md-4">
						<button type="submit" class="btn btn-default">Search</button>
					</div>
				</form>
		</div>




	        <h3>Search Decks:</h3>

        <?php

$query = "SELECT Name FROM Decks GROUP BY Name ORDER BY CASE ID WHEN '0' THEN 1 ELSE 0 END, Name ASC";


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
        // die("Failed to run query: " . $ex->getMessage());
        die("That's a weird name.");
    }

    // Finally, we can retrieve all of the found rows into an array using fetchAll
    $rows = $stmt->fetchAll();

?>




<div class="row">
	<form role="form" class="form" action="" method="GET">
		<div class="col-xs-8 col-md-8">
			<div class="form-group">
				<select name="deck" class="form-control" style=width:100%>
				<option value=""></option>
				<?php foreach($rows as $row): ?>

				<option value="<?php echo htmlentities($row['Name'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlentities($row['Name'], ENT_QUOTES, 'UTF-8'); ?></option>
				<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-xs-4 col-md-4">
			<button type="submit" class="btn btn-default">Search</button>
		</div>
		</form>
	</div>


<br>


        <div class="row">
			<form class="form" role="form" action="" method="GET">
				<div class="col-xs-8 col-md-8">
					<div class="form-group">
						<input class="form-control" name="deck" type="text" style=width:100%>
					</div>
				</div>
					<div class="col-xs-4 col-md-4">
						<button type="submit" class="btn btn-default">Search</button>
					</div>
				</form>
		</div>




	        <h3>Search Tournaments:</h3>

        <?php

$query = "SELECT Name, EndDate FROM Tournament WHERE Visible = '1' GROUP BY Name ORDER BY Name ASC";


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
        // die("Failed to run query: " . $ex->getMessage());
        die("That's a weird name.");
    }

    // Finally, we can retrieve all of the found rows into an array using fetchAll
    $rows = $stmt->fetchAll();

?>




<div class="row">
	<form role="form" class="form" action="" method="GET">
		<div class="col-xs-8 col-md-8">
			<div class="form-group">
				<select name="tournament" class="form-control" style=width:100%>
				<option value=""></option>
				<?php foreach($rows as $row): ?>
				<option value="<?php echo htmlentities($row['Name'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo $row['Name']; ?></option>
				<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-xs-4 col-md-4">
			<button type="submit" class="btn btn-default">Search</button>
		</div>
		</form>
	</div>


<br>


        <div class="row">
			<form class="form" role="form" action="" method="GET">
				<div class="col-xs-8 col-md-8">
					<div class="form-group">
						<input class="form-control" name="tournament" type="text" style=width:100%>
					</div>
				</div>
					<div class="col-xs-4 col-md-4">
						<button type="submit" class="btn btn-default">Search</button>
					</div>
				</form>
		</div>




	</div>
       <div class="col-md-6">


	<?php

// Player Search


	$min_length = 3;

    $query = $_GET['player'];
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



			/* if (count($rows) == 1) { // If one result go to player page

			foreach($rows as $row) {
					$p_ID = $row['ID'];
					echo '<script type="text/javascript"> window.location = "player.php?id='. $p_ID . '"</script>';
					echo 'One Result';
					echo $row['Name'];
			}
					} */


			if (count($rows) >= 1) { // If one or more results, show on right side

			echo '<br>';
			echo $count;
			echo ' Results:';
			echo '<br><br>';
			foreach($rows as $row) {
					$p_ID = $row['ID'];
					$p_Name = $row['Name'];

					echo '<a href="player.php?id='. $p_ID . '">'. $p_Name . '</a>';
					echo '<br>';


			}
					}

   /* No rows matched -- do something else */
				else {
					echo '<br>';
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


	$min_length = 3;

    $query = $_GET['deck'];
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



			/* if (count($rows) == 1) { // If one result, directly go to that deck page

			foreach($rows as $row) {
					$p_ID = $row['ID'];
					echo '<script type="text/javascript"> window.location = "deck.php?id='. $p_ID . '"</script>';
					echo 'One Result';
					echo $row['Name'];
			}
					} */



			if (count($rows) >= 1) { // If one or more results, show on right side of the page


			echo '<br>';
			echo $count;
			echo ' Results:';
			foreach($rows as $row) {
					$p_ID = $row['ID'];
					$p_Name = $row['Name'];
					$p_CBlock = $row['CBlock'];


						if ($row['Standard'] == '1' && $overviewformattypestandard == 0) {
							echo "<br><h3>Standard:</h3><br>";
							$overviewformattypestandard = 1; }

						if ($row['Modern'] == '1' && $overviewformattypemodern == 0) {
							echo "<br><h3>Modern:</h3><br>";
							$overviewformattypemodern = 1; }

						if ($row['Legacy'] == '1' && $overviewformattypelegacy == 0) {
							echo "<br><h3>Legacy:</h3><br>";
							$overviewformattypelegacy = 1; }

						if ($row['Vintage'] == '1' && $overviewformattypevintage == 0) {
							echo "<br><h3>Vintage:</h3><br>";
							$overviewformattypevintage = 1; }

						if ($row['Block'] == '1' && $overviewformattypeblock == 0) {
							echo "<br><h3>Block:</h3><br>";
							$overviewformattypeblock = 1; }

						if ($row['Limited'] == '1' && $overviewformattypelimited == 0) {
							echo "<br><h3>Limited:</h3><br>";
							$overviewformattypelimited = 1; }

						if ($row['Standard'] == '0' && $row['Modern'] == '0' && $row['Legacy'] == '0' && $row['Vintage'] == '0' && $row['Block'] == '0' && $row['Limited'] == '0'&& $overviewformattypeunknown == 0) {
							echo "<br><h3>Unknown:</h3><br>";
							$overviewformattypeunknown = 1; }

					echo '<a href="deck.php?id='. $p_ID . '">'. $p_Name . '</a>';
					if ($p_CBlock != null) {
						echo ' ( ' . $p_CBlock . ' )';
					}
					echo '<br>';


			}
					}

   /* No rows matched -- do something else */
				else {
					echo '<br>';
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


	$min_length = 3;

    $query = $_GET['tournament'];
    // gets value sent over search form


    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then

        $query = htmlspecialchars($query);

		 $sql = "SELECT ID, Name, Format, EndDate FROM Tournament WHERE Name LIKE '%".$query."%' ORDER BY EndDate ASC";
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



			/* if (count($rows) == 1) { // If one result go to player page

			foreach($rows as $row) {
					$t_ID = $row['ID'];
					echo '<script type="text/javascript"> window.location = "index.php?id='. $t_ID . '"</script>';
					echo 'One Result';
					echo $row['Name'];
			}
					} */


			if (count($rows) >= 1) { // If one or more results, show on right side

			echo '<br>';
			echo $count;
			echo ' Results:';
			echo '<br><br>';
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
					echo '<br>No results.';
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
