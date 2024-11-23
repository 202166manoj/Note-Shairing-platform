<?php
    include '../../includes/dbconn.php';

    $sql = "SELECT id from notes WHERE Subject='CMIS'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cmiscount=$query->rowCount();

    echo htmlentities($cmiscount);
?>
