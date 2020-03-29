package generování.příkazu.select;

public class GenerováníPříkazuSelect {

    public static void main(String[] args) {
        select a = new select();
        select b = new select();
        select c = new select();
        select d = new select();
        // VSE = *
        a.SELECT("VSE");
        // VSE = *
        a.FROM("VSE");
        /*
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
                * Syntaxe ["%" a "_" si doplní uživatel dle potřeby]: JAKO (a%) = LIKE 'a%'
            - MEZI = BETWEEN
            * Syntaxe: 
                       MEZI (hlavou) A (krkem) = BETWEEN 'hlavou' AND 'krkem'
                       MEZI 10 A 20 = BETWEEN 10 AND 20
        - JE = IN
            * Syntaxe:
                       IN [VYBER bydliste Z zaci] = IN (SELECT bydliste FROM zaci)
                       IN [bydliste vek okres] = IN ('bydliste','vek','okres')
         */
        a.WHERE("");
        /*
            OD_NEJMENSIHO = ASC
            OD_NEJVETSIHO = DESC
        */
        a.ORDER_BY("");
        
        //Zde budu demonstrovat chybný příkaz, který můj program opraví
        b.SELECT("oci       usi,,,,,,, pusa , , , nos");
        b.FROM(" hlava,,,");
        b.WHERE("");
        b.ORDER_BY("");
        
        //Zde se budu soustředit na příkaz WHERE a tímto chci v rámci mezí demonstrovat funkčnost mé syntaxe.
        c.SELECT("hlava");
        c.FROM("telo");
        c.WHERE("ID ROVNO 1 A delka_usi NEROVNO 5 A delka_nosu VETSI 10 A barva_oci JAKO (%modra) A stav_oci NIKOLIV JE [slepy zranen bryle]");
        c.ORDER_BY("delka_nosu OD_NEJMENSIHO");
        
        //Zde si můžete vyzkoušet nějaký svůj příkaz. Pokud nebude vyplněné žádná z metod, či zadáte neplatnou kombinaci, tak se napíše ERROR.
        d.SELECT("");
        d.FROM("*");
        d.WHERE("");
        d.ORDER_BY("");
        
        System.out.println(a.SHOW());
        System.out.println(b.SHOW());
        System.out.println(c.SHOW());
        System.out.println(d.SHOW());
    }
}
