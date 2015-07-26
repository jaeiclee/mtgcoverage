<?php require '../config.php'; ?>

<?php 
	 

        // These two statements run the query against your database table.
        $stmt = $db->prepare("SELECT * FROM Tournament WHERE StartDate between ? and ?");
			
		$stmt->bindParam(1, $_GET['start'], PDO::PARAM_STR);
		$stmt->bindParam(2, $_GET['end']  , PDO::PARAM_STR);	
			
        $stmt->execute();


    // Finally, we can retrieve all of the found rows into an array using fetchAll
    $rows = $stmt->fetchAll();
	
	echo json_encode($rows);
?>