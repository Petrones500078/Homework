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
public class Ipadresy {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        //zadaná adresa je 190.160.1.128/25
        IP spravna_ip_adresa = new IP(190, 160, 1, 0, 26);
        System.out.println("Validní adresa:");
        spravna_ip_adresa.get_ip();
        spravna_ip_adresa.get_mask();
        spravna_ip_adresa.get_broadcast();
        spravna_ip_adresa.get_hosts();

        //zadaná adresa je 190.160.1.128/16
        System.out.println("1. nevalidní adresa");
        IP spatna_ip_adresa1 = new IP(190, 160, 0, 128, 16);
        spatna_ip_adresa1.get_ip();
        spatna_ip_adresa1.get_mask();
        System.out.println("");

        //zadaná adresa je 0.0.0.0/24 TUDÍŽ NEVALIDNÍ HLOUPOST!
        System.out.println("2. nevalidní adresa");
        IP spatna_ip_adresa2 = new IP(0, 0, 0, 0, 24);
        spatna_ip_adresa2.get_ip();
    }
}
