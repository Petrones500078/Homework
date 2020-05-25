<?php
error_reporting(E_ALL);
require "functions/db.php";
require "functions/html.php";
$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbDatabase = 'map';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <script type="text/javascript" src="https://api.mapy.cz/loader.js"></script>
        <script type="text/javascript">Loader.load();</script>
        <title>Zadávání souřadnic do mapy</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <main>
            <h1>Zadávání souřadnic do mapy</h1>
            <?php
            $action = 'show';
            $db = db_init($dbHost, $dbUser, $dbPassword, $dbDatabase);

            //Mazání uživatele z DB
            if (filter_input(INPUT_POST, 'action') === 'del') {
                db_delete_user($db);
            } else if (filter_input(INPUT_GET, 'action') === 'del') {
                $user = db_load_user($db);
                if (is_array($user) && !empty($user)) {
                    echo '<h2>Odstranit bod</h2>';
                    echo '<p><a href="index.php" title="back to table">&#10096;</a></p>';
                    html_yes_no_form('Opravdu chcete bod  ' . $user['name'] . ' smazat ?', ['action' => 'del', 'id' => $user['id']]);
                    $action = '';
                } else {
                    echo '<p class="alert">Bod nenalezen.</p>';
                }
            }

            //upravit uživatele
            if (filter_input(INPUT_GET, 'action') === 'edit' && !db_update_user($db)) {
                $user = db_load_user($db);
                if (is_array($user) && !empty($user)) {
                    echo '<h2>Edit User</h2>';
                    echo '<p><a href="index.php" title="Zpět k tabulce">&#10096;</a></p>';
                    html_user_form($user, 'edit', ['gps']);
                    $action = '';
                } else {
                    echo '<p class="alert">User not found.</p>';
                }
            }

            //nový uživatel
            if (filter_input(INPUT_GET, 'action') === 'new' && !db_insert_user($db)) {
                echo '<h2>Nový bod</h2>';
                echo '<p><a href="index.php" title="Zpět k tabulce">&#10096;</a></p>';
                $user = [
                    'name' => strval(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)),
                    'gps' => strval(filter_input(INPUT_POST, 'gps', FILTER_SANITIZE_STRING)),
                ];
                html_user_form($user, 'new', ['gps']);
                $action = '';
                
            }

            //ukázat uživatele z tabulky
            if ($action === 'show') {
                echo '<h2>Body</h2>';
                echo '<p><a href="index.php?action=new" title="Vytvořit nový bod">&#10010;</a></p>';
                html_users_table($db);
            }

            echo 
            '<article>
                <div id="m" >
                    <script>
                        var center = SMap.Coords.fromWGS84(15.7685645, 49.9277423);
                        var m = new SMap(JAK.gel("m"), center, 6);
                        m.addDefaultLayer(SMap.DEF_BASE).enable();                    
                    </script>
                </div>
            </article>';

            mysqli_close($db); //ukončí připojení do MySQL
            
            ?>
        </main>
    </body>
</html>