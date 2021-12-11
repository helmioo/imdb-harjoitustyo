<?php
    require_once('../headers.php');
    require_once('../functions.php');

    /* Haetaan screenwriterit, jotka ovat myös näytelleet Harry Potter-elokuvissa */

        try {
            /* Avataan tietokantayhteys */
            $dbcon = createDbConnection();

            /* Alla kutsutun proceduurin luontilause:
            DELIMITER //
            CREATE PROCEDURE WritersWithRole()
            BEGIN
            SELECT name_ , role_ , primary_title
            FROM name_worked_as INNER JOIN names_ ON name_worked_as.name_id = names_.name_id
            INNER JOIN had_role ON names_.name_id = had_role.name_id
            INNER JOIN titles ON had_role.title_id = titles.title_id
            WHERE profession LIKE '%writer%'
            AND primary_title LIKE '%Harry Potter%'
            AND title_type LIKE '%movie%';
            END
            DELIMITER //
            */

            /* Haetaan data ja muutetaan jsoniksi */
            selectAsJson($dbcon, 'CALL WritersWithRole()
            ');
            }
            
            /* Mahdollinen virheilmoitus */
            catch (PDOException $pdoex) {
                returnError($pdoex);
            };