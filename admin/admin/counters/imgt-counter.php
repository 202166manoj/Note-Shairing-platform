<?php
    include '../../includes/dbconn.php';

    $sql = "SELECT id from notes WHERE Subject='IMGT'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $imgtcount=$query->rowCount();

    echo htmlentities($imgtcount);
?>
