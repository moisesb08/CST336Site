<?php

    require 'db_connection.php';

    $sql = "SELECT gameID, title, description, rating, price, imageUrl,DATE_FORMAT(releaseDate, '%m/%d/%Y') AS releaseDate FROM GAME " .
        " WHERE gameID = " . $_GET['game_id'];
    $stmt = $dbConn->query($sql);
    $results = $stmt->fetchAll();

    echo "{";
    foreach ($results as $record){
        echo "\"gameID\":" . "\"" . $record['gameID'] . "\",";
        echo "\"title\":" . "\"" . $record['title'] . "\"," ;
        echo "\"description\":" . "\"" . $record['description'] . "\"," ;
        echo "\"rating\":" . "\"" . $record['rating'] . "\"," ;
        echo "\"price\":" . "\"" . $record['price'] . "\"," ;
        echo "\"releaseDate\":" . "\"" . $record['releaseDate'] . "\"," ;
        echo "\"imageUrl\":" . "\"" . $record['imageUrl'] . "\"" ;
        ;
    }
    echo "}";

?>