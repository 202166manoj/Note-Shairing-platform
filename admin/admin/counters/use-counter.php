<?php
    include '../../includes/dbconn.php';

    $sql = "SELECT id from users";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $usecount=$query->rowCount();

    echo htmlentities($usecount);
?>