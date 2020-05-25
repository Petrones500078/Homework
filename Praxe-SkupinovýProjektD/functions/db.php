<?php

/**
 * Vytvoří připojení do databáze a nastaví znakovou sadu
 *
 * @param string $dbHost
 * @param string $dbUser
 * @param string $dbPassword
 * @param string $dbDatabase
 * @param string $charset
 * @return mysqli|false
 */
function db_init($dbHost, $dbUser, $dbPassword, $dbDatabase, $charset = 'UTF8')
{
    $db = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbDatabase);
    if ($db == false) {
        die('Chyba připojení: ');
    }
    db_query($db, "SET CHARACTER SET $charset");
    return $db;
}

/**
 * Poskytne query s výpisem úspěchu či chyby
 *
 * @param mysqli|false $db
 * @param string $query
 * @param string $successMessage
 * @return mysqli_result|bool
 */
function db_query($db, $query, $successMessage = "")
{
    $result = mysqli_query($db, $query);
    if ($result === false) {
        echo '<p class="alert">' . mysqli_error($db) . '</p>';
    } else if (!empty($successMessage)) {
        echo '<p class="success">' . $successMessage . '</p>';
    }
    return $result;
}

function db_load_user($db, $id = null)
{
    if (empty($id)) {
        if (filter_input(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        } else if (filter_input(INPUT_GET, 'id')) {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        }
    }
    if (intval($id) > 0 && $result = db_query($db, "SELECT * FROM place WHERE id = $id")) {
        return mysqli_fetch_array($result);
    } else {
        return false;
    }
}

/**
 * Vloží uživatele do databáze
 *
 * @param mysqli|false $db
 * @return boolean
 */
function db_insert_user($db)
{
    if (filter_input(INPUT_POST, 'action') != 'new') {
        return false;
    }
    $success = true;
    if ($success) {
        $query = "INSERT INTO place (name, gps) VALUES (";
        if (filter_input(INPUT_POST, 'name')) {
            $query .= "'" . strval(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)) . "'";
        } else {
            $query .= "NULL";
        }
        $query .= ",'" . strval(filter_input(INPUT_POST, 'gps', FILTER_SANITIZE_STRING)) . "'";
        $query .= ")";
        $success = (bool) db_query($db, $query, 'Bod byl přidán.');
    }
    return $success;
}

/**
 * Upraví uživatele v databázi
 *
 * @param mysqli|false $db
 * @return boolean
 */
function db_update_user($db)
{
    if (filter_input(INPUT_POST, 'action') != 'edit') {
        return false;
    }
    $success = true;
    if (filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)) {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    } else {
        echo '<p class="alert">Bod nenalezen.</p>';
        $success = false;
    }
    if (!filter_input(INPUT_POST, 'gps')) {
        echo '<p class="alert">Musíte zadat GPS souřadnice.</p>';
        $success = false;
    }
    if ($success) {
        $query = "UPDATE place SET";
        if (filter_input(INPUT_POST, 'name')) {
            $query .= " name = '" . strval(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)) . "'";
        }
        $query .= ", gps = '" . strval(filter_input(INPUT_POST, 'gps', FILTER_SANITIZE_STRING)) . "'";
        $query .= " WHERE id = $id";
        $success = (bool) db_query($db, $query, 'Bod byl upraven.');
    }
    return $success;
}

/**
 * Odstraní uživatele z databáze
 *
 * @param mysqli|false $db
 * @return boolean
 */
function db_delete_user($db)
{
    if (!filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)) {
        echo '<p class="alert">Identifikace bodu nenalezena.</p>';
        return false;
    }
    $user = db_load_user($db, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
    if (!is_array($user) || empty($user)) {
        echo '<p class="alert">Bod nenalezen.</p>';
        return false;
    }
    return (bool) db_query($db, "DELETE FROM place WHERE id = " . $user['id'], 'Bod byl smazán.');
}
