<!DOCTYPE html>
<html>
<!-- Hlava html, odkaz na css a metadata -->
<head>
    <link href="style.css" rel="stylesheet" />
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analyzátor nadpisů</title>
</head>
<body>
    <h1 class="title">Výpis z webové stránky.</h1>
    <!-- formulář do kterého se zadává URL
         Uvnitř je php příkaz, který zajistí, že se data při kliknutí na button neztratí z vyplněného políčka.
     -->
    <form action="index.php" method="POST">
        <label for="URL">Zadejte URL adresu</label><br>
        <input type="text" class="input" name="URL" value="<?php echo filter_input(INPUT_POST, "URL"); ?>" required><br>
        <input type="submit" class="button" value="Odeslat">
    </form>
    <!-- zde je div s třídou php ve kterém je samozřejmě celý náš program.-->
    <div class="php">
        <!-- php -->
        <?php
        //zde jsme dostali data z formuláře pro URL
        $url = filter_input(INPUT_POST, "URL");
        //zde jsme využily Michalem ,,vypujčenou" funkci od https://stackoverflow.com/questions/11363022/get-url-content-php
        $page = getHtml($url);

        //následující část kódu jsou definice proměných, které se využívají ve funkcích pro hledání napdisů.

        //hledání nadpisu h1
        $h1_start = "<h1";
        $h1_end = "</h1>";
        echo "<br><h1>TOTO JSOU NADPISY h1:</h1><br>";
        getHeading($page, $h1_start, $h1_end, strlen($h1_start));

        //hledání nadpisu h2
        $h2_start = "<h2";
        $h2_end = "</h2>";
        echo "<br><h1>TOTO JSOU NADPISY h2:</h1><br>";
        getHeading($page, $h2_start, $h2_end, strlen($h2_start));

        //hledání nadpisu h3
        $h3_start = "<h3";
        $h3_end = "</h3>";
        echo "<br><h1>TOTO JSOU NADPISY h3:</h1><br>";
        getHeading($page, $h3_start, $h3_end, strlen($h3_start));

        //hledání nadpisu h4
        $h4_start = "<h4";
        $h4_end = "</h4>";
        echo "<br><h1>TOTO JSOU NADPISY h4:</h1><br>";
        getHeading($page, $h4_start, $h4_end, strlen($h4_start));

        //hledání nadpisu h5
        $h5_start = "<h5";
        $h5_end = "</h5>";
        echo "<br><h1>TOTO JSOU NADPISY h5:</h1><br>";
        getHeading($page, $h5_start, $h5_end, strlen($h5_start));

        //hledání nadpisu h6
        $h6_start = "<h6";
        $h6_end = "</h6>";
        echo "<br><h1>TOTO JSOU NADPISY h6:</h1><br>";
        getHeading($page, $h6_start, $h6_end, strlen($h6_start));

        //zde jsem si nadefinoval proměné, které se poté vloží do funkce pro vypsání odkazů.
        $odkaz_start = '<a href="';
        $odkaz_end = '"';
        echo "<br><h1>ZDE JSOU VŠECHNY LINKY:</h1><br>";
        getLink($page, $odkaz_start, $odkaz_end, strlen($odkaz_start));

        /**
         * Funkce getHeading()
         * vygeneruje nadpis, který chceme
         * @param $page stránka kterou skenujeme
         * @param $h_start začátek výskytu, který hledáme
         * @param $h_end konec výskytu, který heldáme
         * @param $h_start_length Délka začátku výskytu.
        */
        function getHeading($page, $h_start, $h_end, $h_start_length){
            //Forcyklus, který generuje nadpisy (analyzuje string $page dokud nedojede na jeho konec)
            for ($i = 0; $i < strlen($page); $i++) {
                /*
                 * $start bude vždy výběr stringu, který jde o $h_start_length dopředu
                 * poté nasleduje podmínka, která zjišťuje shodu s $h_start a poté provede akci,
                   která vyhledá název nadpisu, který následně vypíše pomocí switch podmínky.
                */
                $start = substr($page, $i, $h_start_length);
                if ($start == $h_start) {
                    $test = "";
                    for ($j = $i + $h_start_length; $test != ">"; $j++) {
                        $test = substr($page, $j, 1);
                    }
                    $end = "";
                    for ($j = $j; $end != $h_end; $j++) {
                        $end = substr($page, $j, 5);
                    }
                    $heading_length = $j - 1 - $i;
                    $heading = substr($page, $i, $heading_length);
                    switch ($h_start) {
                        case '<h1':
                            echo '<div id="h1">'.$heading.'</div><br>';
                            break;
                        case '<h2':
                            echo '<div id="h2">'.$heading.'</div><br>';
                            break;
                        case '<h3':
                            echo '<div id="h3">'.$heading.'</div><br>';
                            break;
                        case '<h4':
                            echo '<div id="h4">'.$heading.'</div><br>';
                            break;
                        case '<h5':
                            echo '<div id="h5">'.$heading.'</div><br>';
                            break;
                        case '<h6':
                            echo '<div id="h6">'.$heading.'</div><br>';
                            break;
                        default:
                        echo '<div id="h1">'.$heading.'</div><br>';
                            break;
                    }
                }
            }
        }

        /**
         * Funkce getLink()
         * vygeneruje linky, které jsou v zadané URL
         * @param $page stránka kterou skenujeme
         * @param $odkaz_start začátek výskytu, který hledáme
         * @param $odkaz_end konec výskytu, který heldáme
         * @param $odkaz_start_lendth Délka začátku výskytu.
        */
        function getLink($page, $odkaz_start, $odkaz_end, $odkaz_start_lendth){
            /*
             * princip je podobný jako u nadpisů, ve výsledku je jednodušší.
             * $start bude vždy výběr stringu, který jde o $odkaz_start_length dopředu
             * poté nasleduje podmínka, která zjišťuje shodu s $odkaz_start a poté provede akci, která vyhledá URL linku, kterou následně vypíše pomocí echo.
            */
            for ($i = 0; $i < strlen($page); $i++) {
                $start = substr($page, $i, $odkaz_start_lendth);
                if ($start == $odkaz_start) {
                    $end = "";
                    $i = $i + $odkaz_start_lendth;
                    for ($j = $i; $end != $odkaz_end; $j++) {
                        $end = substr($page, $j, 1);
                    }
                    $link_length = $j - $i;
                    $link = substr($page, $i, $link_length - 1);
                    echo '<a href="' . $link . '">' . $link . '</a><br>';
                }
            }
        }
        //UPOZORŇUJI, že tato funkce není mnou vytvořena, zde je odkaz na pravého tvůrce: https://stackoverflow.com/questions/11363022/get-url-content-php
        function getHtml($url, $post = null){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            if (!empty($post)) {
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            }
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }
        ?>
    </div>
</body>

</html>