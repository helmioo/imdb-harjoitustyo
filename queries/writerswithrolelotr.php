<?php
    require_once('../headers.php');
    require_once('../functions.php');

    /* Haetaan screenwriterit, jotka ovat myös näytelleet Lord of the rings-elokuvissa */

        try {
            /* Avataan tietokantayhteys */
            $dbcon = createDbConnection();
         
            /* Haetaan data ja muutetaan jsoniksi */
            selectAsJson($dbcon, 'SELECT name_ , role_ , primary_title
            FROM name_worked_as INNER JOIN names_ ON name_worked_as.name_id = names_.name_id
            INNER JOIN had_role ON names_.name_id = had_role.name_id
            INNER JOIN titles ON had_role.title_id = titles.title_id
            WHERE profession LIKE "%writer%"
            AND primary_title LIKE "%Lord of the Ring%"
            AND title_type LIKE "%movie%";
            ');
            }
            
            /* Mahdollinen virheilmoitus */
            catch (PDOException $pdoex) {
                returnError($pdoex);
            };