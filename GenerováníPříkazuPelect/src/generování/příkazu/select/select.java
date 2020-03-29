package generování.příkazu.select;

public class select {

    //Zde jsem si deklaroval textové řetězce se kterými operuji v metodách této třídy.
    String a, b, c, d, retezec_v_podprikazu, error;

    /*
        Pro lepší práci s programem a také abych dodržel pravidlo ,,Don't repeat yourself" jsem si vytvořil tyto private metody:
    
        - "double_replace" jsem si vytvořil, abych nemusel opakovat častý příkaz .replace( , ) dvakrát po sobě na stejný String.
        - "SPACE_INTO_COMMA" jsem si vytvořil, abych z mezer mezi slovy udělal čárky. (Převedení mé syntaxe na syntaxi SQL)
        - "PODPRIKAZ_PARAMETER" nahradí 1. znak na vstupu 2. znakem a 3. znak 4. znakem.
     */
    


    private String double_replace(String text1, String replaced1, String replace1, String replaced2, String replace2) {
        text1 = text1.replace(replaced1, replace1);
        text1 = text1.replace(replaced2, replace2);
        return text1;
    }

    private String SPACE_INTO_COMMA(String text1) {
        int tmplen, length = 0;
        for (int i = 0; i < 1; i--) {
            tmplen = length;
            length = text1.length();
            if (tmplen == length) {
                text1 = text1.replace(",", ", ");
                break;
            }
            text1 = text1.replace(",,", ",");
        }
        return text1;
    }

    private String PODPRIKAZ_PARAMETER(String text1, String replaced1, String replace1, String replaced2, String replace2) {
        int first_bracket = 0, last_bracket = 0;
        String text2;
        for (int i = 0; i < text1.length(); i++) {
            text2 = text1.substring(i, i + 1);
            if (text2.contains(replaced1)) {
                first_bracket = i;
            }
            if (text2.contains(replaced2)) {
                last_bracket = i + 1;
            }
        }
        text2 = text1.substring(first_bracket, last_bracket);
        this.retezec_v_podprikazu = text2;
        text2 = text2.replace(replaced1, replace1);
        text2 = text2.replace(replaced2, replace2);
        if (text2.contains("'")) {
            text2 = text2.replace(".", "_");
            if (text2.contains("!")) {
                text2 = text2.replace("!", "%");
            }
        }
        return text2;
    }
    
    /*
    Metoda "SELECT" vytvoří SQL příkaz SELECT.
    Metodu jsem se snažil udělat co nejvíce ,,blbuvzdornou". Takže by překliky v podobě více mezer, či nedejbože více čárek neohrozilo příkaz SELECT
    Když uživatel napíše "VSE", tak se vy příkazu SELECT vypíše '*'.
    */
    
    
    public void SELECT(String text1) {
        if (text1 == "") {
            error = "ERROR";
        } else {
            String text2 = text1;

            text1 = text1.trim();

            if (text1.endsWith(",") || text1.startsWith(",")) {
                text1 = text1.replace(",", "");
            }

            text2 = text1.replace(" ", ",");


            text2 = SPACE_INTO_COMMA(text2);

            if (text2 == "VSE") {
                text2 = text2.replace("VSE", "*");
                this.a = "SELECT " + text2 + "\n";
            } else {
                this.a = "SELECT " + text2 + "\n";
            }
        }
    }
    
    /*
    Metoda "FROM" vytvoří SQL příkaz FROM.
    Tato metoda je víceméně stejná jako metoda "SELECT" je stejně ,,blbuvzdorná" jako metoda SELECT, respektive jsou zde použity stejné funkce na zamezení menším hrubkám ze strany uživatele.
    Při zapsání "VSE" se stejně jako u metody "SELECT" vygeneruje '*'.
    */
    public void FROM(String text1) {
        if (text1 == "") {
            this.b = text1;
        } else {
            String text2 = text1;

            text1 = text1.trim();

            if (text1.endsWith(",") || text1.startsWith(",")) {
                text1 = text1.replace(",", "");
            }

            text2 = text1.replace(" ", ",");


            text2 = SPACE_INTO_COMMA(text2);

            if (text2 == "VSE") {
                text2 = text2.replace("VSE", "*");
                this.b = "FROM " + text2;
            } else {
                this.b = "FROM " + text2;
            }

        }
    }

    /*
    Metoda "WHERE" mi při tvorbě dala velmi zabrat, protože jsem si musel pečlivě nastudovat příkaz "WHERE" a jeho podpříkazy.
    Metodě jsem vytvořil (ano vím, že tak trochu zbytečně) svou vlastné syntaxi.
    Můžete používat klidně čístě syntaxi SQL příkazů a ta zustane netknuta mým programem.
    Syntaxe : 
        - A = AND
        - NEBO = OR
        - NIKOLIV = NOT
        - ROVNO =   = 
        - VĚTŠÍ = >
        - MENŠÍ = <
        - VETŠÍ_ROVNO = >=
        - MENŠÍ_ROVNO = <=
        - NEROVNO = <>
        - JAKO = LIKE
            * Syntaxe ['%' a '_' si doplní uživatel dle potřeby]: JAKO (a%) = LIKE 'a%'
        - MEZI = BETWEEN
            * Syntaxe: 
                       MEZI (hlavou) A (krkem) = BETWEEN 'hlavou' AND 'krkem'
                       MEZI 10 A 20 = BETWEEN 10 AND 20
        - JE = IN
            * Syntaxe:
                       IN [VYBER bydliste Z zaci] = IN (SELECT bydliste FROM zaci)
                       IN [bydliste vek okres] = IN ('bydliste','vek','okres')
    */
    
    public void WHERE(String text1) {
        if (text1 == "") {
            c = "";
        } else {
            String podprikaz_parameter;
            text1 = text1.replace(" A ", " AND ");
            text1 = text1.replace(" NEBO ", " OR ");
            text1 = text1.replace(" NIKOLIV ", " NOT ");
            text1 = text1.replace(" ROVNO ", " = ");
            text1 = text1.replace(" VĚTŠÍ ", " > ");
            text1 = text1.replace(" MENŠÍ ", " < ");
            text1 = text1.replace(" VĚTŠÍ_ROVNO ", " >= ");
            text1 = text1.replace(" MENŠÍ_ROVNO ", " <=");
            text1 = text1.replace(" NEROVNO ", " <> ");
            text1 = text1.replace(" JAKO ", " LIKE ");
            if (text1.contains("LIKE")) {
                podprikaz_parameter = PODPRIKAZ_PARAMETER(text1, "(", "'", ")", "'");
                text1 = text1.replace(retezec_v_podprikazu, podprikaz_parameter);
            }

            text1 = text1.replace(" MEZI ", " BETWEEN ");
            if (text1.contains("BETWEEN")) {
                text1 = double_replace(text1, "(", "'", ")", "'");
            }
            text1 = text1.replace(" JE ", " IN ");
            if (text1.contains("IN")) {
                if (text1.contains("VYBER") || text1.contains("Z")) {
                    text1 = double_replace(text1, "VYBER", "SELECT", "Z", "FROM");
                    text1 = double_replace(text1, "[", "(", "]", ")");
                } else {
                    podprikaz_parameter = PODPRIKAZ_PARAMETER(text1, "[", "('", "]", "')");
                    podprikaz_parameter = podprikaz_parameter.replace(" ", "',");
                    podprikaz_parameter = SPACE_INTO_COMMA(podprikaz_parameter);
                    text1 = text1.replace(retezec_v_podprikazu, podprikaz_parameter);
                    text1 = text1.replace(", ", ",'");
                }
            }
            this.c = "WHERE " + text1;
        }
    }

    /*
    Metoda "ORDER_BY" generuje poslední fází mého SQL příkazu.
    Tato metoda je také ,,blbuvzdorná" jako FROM a SELECT.
        * Syntaxe:
                    OD_NEJMENSIHO = ASC
                    OD_NEJVETSIHO = DESC
    */
    
    public void ORDER_BY(String text1) {
        if (text1 == "") {
            d = "";
        } else {
            if (text1.contains("OD_NEJVETSIHO") || text1.contains("OD_NEJMENSIHO")) {

                if (text1.contains("OD_NEJVETSIHO")) {
                    text1 = text1.replace("OD_NEJVETSIHO", "");
                    String text2 = text1;

                    text1 = text1.trim();

                    if (text1.endsWith(",") || text1.startsWith(",")) {
                        text1 = text1.replace(",", "");
                    }

                    text2 = text1.replace(" ", ",");


                    text2 = SPACE_INTO_COMMA(text2);

                    this.d = "ORDER BY " + text2 + " DESC";
                }
                if (text1.contains("OD_NEJMENSIHO")) {
                    text1 = text1.replace("OD_NEJMENSIHO", "");
                    String text2 = text1;

                    text1 = text1.trim();

                    if (text1.endsWith(",") || text1.startsWith(",")) {
                        text1 = text1.replace(",", "");
                    }

                    text2 = text1.replace(" ", ",");


                    text2 = SPACE_INTO_COMMA(text2);

                    this.d = "ORDER BY " + text2 + " ASC";
                }
            } else {
                String text2 = text1;

                text1 = text1.trim();

                if (text1.endsWith(",") || text1.startsWith(",")) {
                    text1 = text1.replace(",", "");
                }

                text2 = text1.replace(" ", ",");


                text2 = SPACE_INTO_COMMA(text2);
                this.d = "ORDER BY " + text2;
            }
        }
    }
    
    /*
    Tato metoda poskládá výsledky z ostatních metod, které společně vytvoří výsledný příkaz.
    Tato metoda je nedovolí aby vznikl příkaz SELECT ber příkazu FROM, či naopak.
    */
    
        public String SHOW() {
        String text1;
        if (b == "") {
            c = "";
            d = "";
            a = "";
            return "ERROR\n";
        }
        if (error == "ERROR") {
            return error + "\n";
        }
        if (c == "" && d == "") {
            return text1 = a + b + ";\n";
        }
        if (a != "" && b != "" && c == "" && d != "") {
            return text1 = a + b + "\n" + d + ";\n";
        }
        if (a != "" && b != "" && c != "" && d == "") {
            return text1 = a + b + "\n" + c + ";\n";
        }
        if (a != "" && b != "" && c != "" && d != "") {
            return text1 = a + b + "\n" + c + "\n" + d + ";\n";
        }
        return text1 = a + b + c + d + ";\n";
    }
}
