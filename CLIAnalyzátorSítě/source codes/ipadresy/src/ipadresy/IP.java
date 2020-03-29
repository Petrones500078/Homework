/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ipadresy;

/**
 *
 * @author Michael_Petro
 */
public class IP {

    //zde jsem si deklaroval proměnné, kterým přidělí hodnotu konstruktor
    int o1, o2, o3, o4, prefix;
    String bin_o1, bin_o2, bin_o3, bin_o4;
    String bin_sjednoceny_pole[];
    String bin_sjednoceny = "";
    String dec_sjednoceny = "" + o1 + o2 + o3 + o4 + "";

    /**
     * KONSTRUKTOR
     *
     * @param o1 první oktet
     * @param o2 druhý oktet
     * @param o3 třetí oktet
     * @param o4 čtvrtý oktet
     * @param prefix konstruktor přidělí hodnotu téměř všem proměnným
     * deklarovaným nahoře MÁM OVĚŘENÉ I ŠPATNÉ ZADÁNÍ ADRESY viz: PODMÍNKA V
     * SPODNÍ ČÁSTI KONSTRUKTORU, která vynuluje ip adresu a zbytek metod toto
     * chování vyhodnotí jako error, pomocí funkce error_analyzator()
     */
    IP(int o1, int o2, int o3, int o4, int prefix) {
        this.o1 = o1;
        this.o2 = o2;
        this.o3 = o3;
        this.o4 = o4;
        this.prefix = prefix;
        this.bin_o1 = pad_left_zeros(Integer.toBinaryString(o1), 8);
        this.bin_o2 = pad_left_zeros(Integer.toBinaryString(o2), 8);
        this.bin_o3 = pad_left_zeros(Integer.toBinaryString(o3), 8);
        this.bin_o4 = pad_left_zeros(Integer.toBinaryString(o4), 8);
        this.bin_sjednoceny_pole = new String[4];
        this.bin_sjednoceny_pole[0] = bin_o1;
        this.bin_sjednoceny_pole[1] = bin_o2;
        this.bin_sjednoceny_pole[2] = bin_o3;
        this.bin_sjednoceny_pole[3] = bin_o4;
        for (int i = 0; i < 4; i++) {
            this.bin_sjednoceny = bin_sjednoceny + bin_sjednoceny_pole[i];
        }
        if (Integer.parseInt(bin_sjednoceny.substring(prefix, 32)) != 0) {
            this.o1 = 0;
            this.o2 = 0;
            this.o3 = 0;
            this.o4 = 0;
        }
    }

    /**
     * get_ip metoda, která vypíše zadanou ip adresu a prefix v desítkové
     * soustavě, poté adresu vypíše v dvojkové soustavě
     */
    void get_ip() {
        if (error_analyzator() == "error") {
            System.out.println("Špatně zadaná adresa (máš číselné hodnoty za prefixem nebo jsi zadal samé nuly)");
        } else {
            System.out.println("zadaná IP adresa:");
            System.out.println(o1 + "." + o2 + "." + o3 + "." + o4 + " / " + prefix + "\n");
            System.out.println("zadaná IP adresa v binární podobě:");
            System.out.println(bin_o1 + "." + bin_o2 + "." + bin_o3 + "." + bin_o4 + "\n");
        }

    }

    /**
     * get_mask Tato metoda se postará o vypsání masky zadané adresy
     */
    void get_mask() {
        if (error_analyzator() == "error") {
            System.out.println("Špatně zadaná adresa (máš číselné hodnoty za prefixem nebo jsi zadal samé nuly)");
        } else {
            String maska = "";
            for (int i = 0; i < 32; i++) {
                if (i < prefix) {
                    maska = maska + "1";
                } else {
                    int j = i + 1;
                    maska = maska + "0";
                }
                if (i == 7 || i == 15 || i == 23) {
                    maska = maska + ".";
                    
                }
            }
            System.out.println("maska zadané IP adresy:");
            System.out.println(maska + "\n");
        }
    }

    /**
     * get_mask Tato metoda se postará o vypsání broadcastu zadané adresy
     */
    void get_broadcast() {
        if (error_analyzator() == "error") {
            System.out.println("Špatně zadaná adresa (máš číselné hodnoty za prefixem nebo jsi zadal samé nuly)");
        } else {
            String broadcast = broadcast_counter();
            System.out.println("broadcast zadané IP adresy:");
            System.out.println(broadcast + "\n");
        }
    }

    /**
     * get_hosts Tato metoda vypíše adresu prvního hosta, adresu posledního
     * hosta a počet hostů;
     */
    void get_hosts() {
        if (error_analyzator() == "error") {
            System.out.println("Špatně zadaná adresa (máš číselné hodnoty za prefixem nebo jsi zadal samé nuly)");
        } else {
            int last_host = 254;
            int first_host = o4 + 1;
            System.out.println("adresa prvního hosta:");
            System.out.println(o1 + "." + o2 + "." + o3 + "." + first_host + "\n");
            System.out.println("adresa posledního hosta:");
            System.out.println(o1 + "." + o2 + "." + o3 + "." + last_host + "\n");
            System.out.println("počet hostů:");
            System.out.println(last_host - first_host + "\n");
        }
    }

    //privátní metoda, která ověřuje zdali jsme špatně zadali adresu.
    private String error_analyzator() {
        if (o1 == 0 && o2 == 0 && o3 == 0 && o4 == 0) {
            return "error";
        } else {
            return "ok";
        }
    }
    private String broadcast_counter(){
            String broadcast = "";
            for (int i = 0; i < 32; i++) {
                if (i < prefix) {
                    int j = i + 1;
                    broadcast = broadcast + bin_sjednoceny.substring(i, j);
                } else {
                    broadcast = broadcast + "1";
                }
                if (i == 7 || i == 15 || i == 23) {
                    broadcast = broadcast + ".";
                }
            }
            return broadcast;
    }

    //tuto metodu, jsem si vypůlčil z této stránky https://www.baeldung.com/java-pad-string, TATO METODA FUNGUJE JAKO FUNKCE ,,STR_PAD()" V JAZYCE PHP 
    private String pad_left_zeros(String inputString, int length) {
        if (inputString.length() >= length) {
            return inputString;
        }
        StringBuilder sb = new StringBuilder();
        while (sb.length() < length - inputString.length()) {
            sb.append('0');
        }
        sb.append(inputString);

        return sb.toString();
    }
}
