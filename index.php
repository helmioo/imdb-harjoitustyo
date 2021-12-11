<?php
    require_once('./headers.php');
    require_once('./functions.php');


    
    try {
        $dbcon = createDbConnection();
        selectAsJson($dbcon, 'SELECT primary_title, runtime_minutes, genre
        FROM titles, title_genres
        WHERE titles.title_id = title_genres.title_id
        AND title_type = "movie"
        AND genre LIKE "%Fantasy%"
        ORDER BY runtime_minutes DESC
        LIMIT 10;
        ');
        }
        catch (PDOException $pdoex) {
            returnError($pdoex);
        };

    