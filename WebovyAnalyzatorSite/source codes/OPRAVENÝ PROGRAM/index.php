        <head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
        <div class="formular">
                <form action="index.php" method="POST">
                <!--    
                Gui pro zadávání hodnot
                -->
                <h1>vložte ip adresu</h1>
                        <label for="oktet1"></label>
                        <input type="number" class="input" id="oktet1" name="oktet1" min="0" max="255" value="<?php echo filter_input(INPUT_POST, "oktet1");?>" required >

                        <label for="oktet2"></label>
                        <input type="number" class="input" id="oktet2" name="oktet2" min="0" max="255" value="<?php echo filter_input(INPUT_POST, "oktet2");?>" required>

                        <label for="oktet3"></label>
                        <input type="number" class="input" id="oktet3" name="oktet3" min="0" max="255" value="<?php echo filter_input(INPUT_POST, "oktet3");?>" required>

                        <label for="oktet4"></label>
                        <input type="number" id="oktet4" class="input" name="oktet4" min="0" max="255" value="<?php echo filter_input(INPUT_POST, "oktet4");?>" required>
                         /
                        <label for="prefix"></label>
                        <input type="number" id="prefix" class="input" name="prefix" min="0" max="32" value="<?php echo filter_input(INPUT_POST, "prefix");?>"required>

                        <input name="button" class="button" type="submit">
                </form>
        </div>
        <?php
                /**
                 * Zde jsem si načetl přijmutá data z mého GUI rozhraní a uložil je do promenných.
                */
                $oktet1 = filter_input(INPUT_POST, "oktet1");
                $oktet2 = filter_input(INPUT_POST, "oktet2");
                $oktet3 = filter_input(INPUT_POST, "oktet3");
                $oktet4 = filter_input(INPUT_POST, "oktet4");
                $prefix = filter_input(INPUT_POST, "prefix");

                $last_oktet;
                /**
                 * Toto je hlavní část mého php programu.
                 * Jsou zde možné stavy dle podmínek:
                        * Hlavní část podmínky provede program pokud jsou všechna políčka vyplněná.
                        * Elseif 1. zajišťuje, že se při zapnutí webové stránky nic nevypíše
                        * Elseif 2. zajišťuje, že nebude vadit, když budou nějaké zadané hodnoty nulové a poté se provede ten samý program jako v HLAVNÍ ČÁSTI podmínky
                 */
                if ( !empty($oktet1) && !empty($oktet2) && !empty($oktet3) && !empty($oktet4) && !empty($prefix)) {

                        if(verify($oktet1, $oktet2, $oktet3, $oktet4, $prefix) == 1){
                                vypocet_adres($oktet1, $oktet2, $oktet3, $oktet4, $prefix);
                        }else{
                                echo '<div class="vysledek">'; 
                                echo '<b class="ruda">TATO ADRESA NENÍ VALIDNÍ!</b>';
                                echo '</div>';

                        }

                }elseif($oktet1 == 0 && $oktet2 == 0 && $oktet3 == 0 && $oktet4 == 0 && $prefix == 0){
                        echo "";
                }elseif( $oktet1 == 0 || $oktet2 == 0 || $oktet3 == 0 || $oktet4 == 0 || $prefix == 0){

                        if(verify($oktet1, $oktet2, $oktet3, $oktet4, $prefix) == 1){
                                vypocet_adres($oktet1, $oktet2, $oktet3, $oktet4, $prefix);
                        }else{
                                echo '<div class="vysledek">'; 
                                echo '<b class="ruda">TATO ADRESA NENÍ VALIDNÍ!</b>';
                                echo '</div>';
                        }

                }
                /**
                 * tato funkce ověří zdali je adresa validní, v případě, že ne vypíše ,,TATO ADRESA NENÍ VALIDNÍ!"
                */
                function verify($oktet1, $oktet2, $oktet3, $oktet4, $prefix){
                        $binos1 = str_pad(decbin("$oktet1"), 8, "0", STR_PAD_LEFT);
                        $binos2 = str_pad(decbin("$oktet2"), 8, "0", STR_PAD_LEFT);
                        $binos3 = str_pad(decbin("$oktet3"), 8, "0", STR_PAD_LEFT);
                        $binos4 = str_pad(decbin("$oktet4"), 8, "0", STR_PAD_LEFT);

                        /**
                         * sjedncený string je string binárů bez teček
                         */
                        $sjednoceny_string = $binos1.$binos2.$binos3.$binos4;

                        /**
                         * toto je část za prefixem (zbylé bity za prefixem)
                         */
                        $cast_za_prefixem = substr($sjednoceny_string, $prefix);

                        if(bindec($cast_za_prefixem) != 0){
                                return 0;
                        }else{
                                return 1;
                        }
                }

                /**
                 *  tato funkce je vytvořená pro zkrácení a přehlednost programu... V ní se skrývá hlavní program mé WAP
                 */ 
                function vypocet_adres($oktet1, $oktet2, $oktet3, $oktet4, $prefix){
                        echo '<div class="vysledek">';

                        /**
                         * výpis zadané ip adresy
                         */

                        $IP_adres = $oktet1.".".$oktet2.".".$oktet3.".".$oktet4;

                        echo '<h2>zadaná IP adresa:</h2>'."<p class='zelena'>".$IP_adres."</p>";

                        /**
                         * převedení oktetů na binární soustavu a následné vynulování zleva
                         */
                        $binos1 = str_pad(decbin("$oktet1"), 8, "0", STR_PAD_LEFT);
                        $binos2 = str_pad(decbin("$oktet2"), 8, "0", STR_PAD_LEFT);
                        $binos3 = str_pad(decbin("$oktet3"), 8, "0", STR_PAD_LEFT);
                        $binos4 = str_pad(decbin("$oktet4"), 8, "0", STR_PAD_LEFT);

                        /**
                         * sjedncený string je string binárů bez teček
                         */
                        $sjednoceny_string = $binos1.$binos2.$binos3.$binos4;

                        /**
                         * toto je část za prefixem (zbylé bity za prefixem)
                         */
                        $cast_za_prefixem = substr($sjednoceny_string, $prefix);

                        /**
                         * toto je část před prefixem (všechny bity v prefixu)
                         */
                        $cast_pred_prefixem = substr($sjednoceny_string,0,$prefix);

                        /**
                         * zde se zkombinuje string a rovnou se odkáže na třídu v dokumntu style.css
                         */
                        $barevny_string = '<b class="ruda">'.$cast_pred_prefixem."</b>".'<b class="zelena">'.$cast_za_prefixem."</b>";
                        /**
                         * zde se zadá výsledek operace s proměnnými nad tímto komentářem do funkce complete_IP()
                         */
                        complete_IP('<span class="zelena">'.$sjednoceny_string.'</span>',"IP adresa v bitové podobě");


                        maska($prefix);

                        broadcast_adress($prefix, $oktet1, $oktet2, $oktet3, $oktet4);

                        hosts($oktet1, $oktet2, $oktet3, $oktet4, $IP_adres, $prefix);

                        echo '</div>';
                }

                /**
                 * Funkce, která dá dohromady, vybarví a vykreslí část IP před i za prefixem.
                 * Nepovinný parametr $h1 se využívá jako nadpis daného výpočtu.
                 * complete_IP($fullstring, $h1).
                 */
                function complete_IP($fullstring, $h1 = ""){
                $pocet = 0;
                $array_of_strings = str_split($fullstring, 1);
                echo "<h2>".$h1.":</h2>";
                echo "<p>";
                for ($i=0; $i < strlen($fullstring); $i++) { 
                        if($array_of_strings[$i] == "0" || $array_of_strings[$i] == "1"){
                                $pocet++;
                                if($pocet / 8 == 1 || $pocet / 8 == 2 || $pocet / 8 == 3 || $pocet / 8 == 4 ){
                                        $array_of_strings[$i] = $pocet/8==4?$array_of_strings[$i]:$array_of_strings[$i].'.';
                                }
                        }
                        echo $array_of_strings[$i];
                }
                echo "</p>";
                }

                /**
                 * Funkce na vygenerování masky sítě
                 */
                function maska($prefix){
                        $max_prefix = 32;

                        $pocet_bitu_za_prefixem = $max_prefix - $prefix;

                        $cast_za_prefixem = "0";

                        $cast_za_prefixem = str_pad("", $pocet_bitu_za_prefixem, "0", STR_PAD_LEFT);

                        $maska = str_pad("$cast_za_prefixem", 32, "1", STR_PAD_LEFT);

                        $cast_pred_prefixem = substr($maska, 0,$prefix);

                        $BIN_maska = '<b class="zelena">'.$cast_pred_prefixem."</b>".'<b class="ruda">'.$cast_za_prefixem."</b>";
                        
                        $DEC_maska = explode(".", $cast_pred_prefixem.$cast_za_prefixem);

                        $DEC_maska_sjednocena = str_split($DEC_maska[0], 8) ;

                        $DEC_maska1 = "";
                        $DEC_maska2 = "";
                        for($i = 0; $i < 4; $i++){
                                if(bindec($DEC_maska_sjednocena[$i]) != 255){
                                        $DEC_maska2 = $i==0?$DEC_maska2.bindec($DEC_maska_sjednocena[$i]):$DEC_maska2.".".bindec($DEC_maska_sjednocena[$i]);  
                                }else{ 
                                        $DEC_maska1 = $i==0?$DEC_maska1.bindec($DEC_maska_sjednocena[$i]):$DEC_maska1.".".bindec($DEC_maska_sjednocena[$i]);
                                }
                        }

                        complete_IP($BIN_maska, "maska v binární soustavě");
                        echo "<h2>maska v desítkové soustavě</h2>";
                        echo '<p><b class="zelena">'.$DEC_maska1."</b>".'<b class="ruda">'.$DEC_maska2."</b></p>";
                }
                /**
                 * Funkce na vygenerování broadcastu sítě
                 */
                function broadcast_adress($prefix, $oktet1, $oktet2, $oktet3, $oktet4){
                        $max_prefix = 32;

                        $pocet_bitu_za_prefixem = $max_prefix - $prefix;

                        $cast_pred_prefixem = str_pad("", $prefix, "0", STR_PAD_LEFT);

                        $cast_za_prefixem = str_pad("", $pocet_bitu_za_prefixem, "1", STR_PAD_RIGHT);

                        $fullstring = $cast_pred_prefixem.$cast_za_prefixem;

                        $array_of_strings = str_split($fullstring, 8);

                        echo "<h2>Broadcast v desítkové soustavě</h2>";

                        $oktets = array($oktet1, $oktet2, $oktet3, $oktet4);

                        for($i = 0;$i<4;$i++){
                                if($i == 0){
                                        $oktets[0] = $oktet1;
                                        $oktets[1] = $oktet2;
                                        $oktets[2] = $oktet3;
                                        $oktets[3] = $oktet4;
                                }
                                $array_of_strings[$i] = bindec($array_of_strings[$i]) + $oktets[$i];
                                if($array_of_strings[$i] >= 256){ $array_of_strings[$i] = 255;}
                        }
                        echo '<p>';
                        switch($prefix){
                                case $prefix < 32 && $prefix >= 24:
                                        echo '<b class="ruda">'.$array_of_strings[0].".".$array_of_strings[1].".".$array_of_strings[2].'</b>'.'<b class="zelena">'.".".$array_of_strings[3].'</b>';
                                        break;
                                case $prefix < 24 && $prefix >= 16:
                                        echo '<b class="ruda">'.$array_of_strings[0].".".$array_of_strings[1].'</b>'.'<b class="zelena">'.".".$array_of_strings[2].".".$array_of_strings[3].'</b>';
                                        break;
                                case $prefix < 16 && $prefix >= 8:
                                        echo '<b class="ruda">'.$array_of_strings[0].'</b>'.'<b class="zelena">'.".".$array_of_strings[1].".".$array_of_strings[2].".".$array_of_strings[3].'</b>';
                                        break;
                                case $prefix < 8 && $prefix >= 0:
                                        echo '<b class="zelena">'.$array_of_strings[0].".".$array_of_strings[1].".".$array_of_strings[2].".".$array_of_strings[3].'</b>';
                                        break;
                                case 32:
                                        echo '<b class="ruda">'.$array_of_strings[0].".".$array_of_strings[1].".".$array_of_strings[2].".".$array_of_strings[3].'</b>';
                                        break;
                        }
                        echo '</p>';
                }
                /**
                 * Funkce na vysání a vypočítání last host, first host a host count
                 */
                function hosts($oktet1, $oktet2, $oktet3, $oktet4, $IP_adres, $prefix){
                        $comas = 0;
                        $substring = 0;
                        $broadcast = zjisteni_posledniho_oktetu($oktet1, $oktet2, $oktet3, $oktet4, $prefix);
                        do{
                        $string = $IP_adres[$substring];
                                if($string == "."){
                                        $comas++;
                                        if($comas == 3){
                                                $strlen = $substring + 1;
                                                break;
                                        }
                                }

                        $substring++;
                        }while($comas < 3);

                        $oktet4 = $oktet4 + 1;
                        $const = $broadcast - 1;

                        echo "<h2>První host:</h2>";
                        $first_host = "<p><b class='ruda'>".substr($IP_adres,0, $strlen)."</b><b class='zelena'>".$oktet4."</b></p>";
                        echo $first_host;
                        echo "<h2>Poslední host:</h2>";
                        $last_host = "<p><b class='ruda'>".substr($IP_adres,0, $strlen)."</b><b class='zelena'>".$const."</b></p>";
                        echo $last_host;
                        echo "<h2>Počet hostů:</h2>";
                        $host_count1 = $const - $oktet4 + 1;
                        $host_count2 = "<p>"."<b class='zelena'>".$host_count1."</b></p>";
                        echo $host_count2;
                }
                //funkce, která zjistí poslední oktet masky, která je potřeba k vypočítání posledního hosta
                function zjisteni_posledniho_oktetu($oktet1, $oktet2, $oktet3, $oktet4, $prefix){
                        $max_prefix = 32;

                        $pocet_bitu_za_prefixem = $max_prefix - $prefix;

                        $cast_pred_prefixem = str_pad("", $prefix, "0", STR_PAD_LEFT);

                        $cast_za_prefixem = str_pad("", $pocet_bitu_za_prefixem, "1", STR_PAD_RIGHT);

                        $fullstring = $cast_pred_prefixem.$cast_za_prefixem;

                        $array_of_strings = str_split($fullstring, 8);

                        $oktets = array($oktet1, $oktet2, $oktet3, $oktet4);

                        for($i = 0;$i<4;$i++){
                                if($i == 0){
                                        $oktets[0] = $oktet1;
                                        $oktets[1] = $oktet2;
                                        $oktets[2] = $oktet3;
                                        $oktets[3] = $oktet4;
                                }
                                $array_of_strings[$i] = bindec($array_of_strings[$i]) + $oktets[$i];
                                if($array_of_strings[$i] >= 256){ $array_of_strings[$i] = 255;}
                        }
                        return $array_of_strings[3];
                }
                ?>
                
</body>
