<?php


// Luo ja palauttaa tietokantayhteyden.
 
function createDbConnection(){

    try{
        $dbcon = new PDO('mysql:host=localhost;dbname=imdb', 'root', '');
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        echo $e->getMessage();
    }
    return $dbcon;
}

// Muuttaa valitun tiedon jsoniksi

function selectAsJson(object $dbcon,string $sql): void {
    $query = $dbcon->query($sql);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    header('HTTP/1.1 200 OK');
    echo json_encode($results);
}

// Palauttaa virheilmoituksen

function returnError(PDOException $pdoex): void {
    header('HTTP/1.1 500 Internal Server Error');
    $error = array('error' => $pdoex->getMessage());
    echo json_encode($error);
    exit;
}