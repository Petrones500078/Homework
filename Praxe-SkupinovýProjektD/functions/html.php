<?php

/**
 * Ukáže Ano/Ne formulář
 *
 * @param string $message
 * @param array $yesHidden
 * @param array $noHidden
 * @return void
 */
function html_yes_no_form($message, array $yesHidden = [], array $noHidden = [])
{
    echo "<h3>$message</h3>";
    echo '<form action="index.php" method="POST">';
    echo '<div>';
    echo '<input type="submit" name="submit" value="Ne">';
    foreach ($noHidden as $key => $val) {
        echo '<input type="hidden" name="' . $key . '" value="' . $val . '">';
    }
    echo '</div>';
    echo '</form>';
    echo '<form action="index.php" method="POST">';
    echo '<div>';
    echo '<input type="submit" name="submit" value="Ano">';
    foreach ($yesHidden as $key => $val) {
        echo '<input type="hidden" name="' . $key . '" value="' . $val . '">';
    }
    echo '</div>';
    echo '</form>';
}

/**
 * Ukáže HTML formulář pro uživatele
 *
 * @param array $userValues
 * @param string $action
 * @param array $required
 * @return void
 */
function html_user_form(array $userValues, $action = 'new', array $required = [], array $ignoreValue = [])
{
    $userAttributes = [
        'name' => ['label' => 'Název', 'type' => 'text', 'maxlength' => "40"],
        'gps' => ['label' => 'GPS souřadnice', 'type' => 'text',  'maxlength' => "40"],
    ];
    echo '<form action="index.php' . ($action ? '?action=' . $action : '') . '" method="POST">';
    foreach ($userAttributes as $key => $val) {
        echo '<div>';
        echo '<label for="' . $key . '">' . $val['label'] . '</label>';
        echo '<input type="' . $val['type'] . '" name="' . $key . '" id="' . $key . '"';
        if (!empty($val['maxlength'])) {
            echo ' maxlength="' . $val['maxlength'] . '"';
        }
        if (!empty($userValues[$key]) && !in_array($key, $ignoreValue)) {
            echo ' value="' . $userValues[$key] . '"';
        }
        if (in_array($key, $required)) {
            echo ' required';
        }
        echo '>';
        echo '</div>';
    }
    echo '<div>';
    if (!empty($userValues['id']) && $action == 'edit') {
        echo '<input type="submit" name="submit" value="Uložit">';
        echo '<input type="hidden" name="action" value="edit">';
        echo '<input type="hidden" name="id" value="' . $userValues['id'] . '">';
    } else if ($action == 'new') {
        echo '<input type="submit" name="submit" value="Vytvořit">';
        echo '<input type="hidden" name="action" value="new">';
    }
    echo '</div>';
    echo '</form>';
}

/**
 * Ukáže uživatele z databáze do HTML tabulky
 *
 * @param mysqli|false $db
 * @return void
 */
function html_users_table($db)
{
    $result = db_query($db, "SELECT * FROM place ORDER BY gps, name");
    if (!empty($result)) {
        echo '<div class="table"><table><tr><th>Název</th><th>GPS souřadnice</th><th></th></tr>';
        while ($user = mysqli_fetch_array($result)) {
            echo '<tr class="item">';
            echo '<td>' . $user['name'] . '</td>';
            echo '<td>' . $user['gps'] . '</td>';
            echo '<td>';
            echo '<a href="index.php?action=edit&id=' . $user['id'] . '" title="Upravit: ' . $user['name'] . '">&#9998;</a>';
            echo ' ';
            echo '<a href="index.php?action=del&id=' . $user['id'] . '" title="Odstranit: ' . $user['name'] . '">&#10006;</a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table></div>';
    }
}
