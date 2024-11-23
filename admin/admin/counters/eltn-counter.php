<?php
    include '../../includes/dbconn.php';

    $sql = "SELECT id from notes WHERE Subject='ELTN'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $eltncount=$query->rowCount();

    echo htmlentities($eltncount);
?>
