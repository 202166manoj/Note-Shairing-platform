<?php
    include '../../includes/dbconn.php';

    $sql = "SELECT id from notes WHERE Subject='MATH'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $mathcount=$query->rowCount();

    echo htmlentities($mathcount);
?>
