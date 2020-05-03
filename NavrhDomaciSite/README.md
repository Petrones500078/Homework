# Návrh domácí sítě

#### Na celý tento úkol jsem se snažil přihlížet jako na zakázku pro zákazníka, který si nadiktoval nějaké své zařízení, které by na to chtěl připojit a následně mě pustil dovnitř k němu domů ať si naplánuju připojení (Tudíž spíš z pohledu praxe). Protože jsem již u pár takovách připojovaček byl, tak je to pro mě přirozenější na to koukat jako na zakázku než na tvorbu pro mne (jsem velmi nenáročný). Možná se mě ptáte jaký je rozdíl mezi zakázkou a tvorbu pro sebe samotného? No je to velmi jednoduché, když jdete dělat síť pro sebe musíte si koupit třeba 40 metrů lišt za 590 Kč, ale když jdete někomu dělat internet, tak máte 40 metrů pořízených na firmu a zákazníkovy dáte zaplatit pouze to co jste na něj využil. V tomto je hlavní a zásadní rozdíl (ovšemže ne jen u lišt, ale u UTP atd..). Zmiňuji to jen proto aby vás při čtení mé dokumentace neuvedlo do rozpaku slovo zákazník (v němčině der Kunde nebo také die Kundschaft).

# Zadání

### Můj zakazník si tedy přeje síť s wifi která by měla pokrýt obývací pokoj a pokoj jeho syna.

### Zákazník mi řekl a ukázal která zařízení vlastní a chce je připojit.

## zařízení, která připojuji

<ul>
<li>Smart TV</li>
<li>Stolní počítač</li>
<li>Tiskárna</li>
<li>Tablet a mobily</li>
</ul>

# Zhodnocení a následné řešení této sítě

### Vyhodnotil jsem, že nejlepší připojení bude bezdrátové přes příjmač z firmy,mikroTIK(mikroTIK SXT), protože vzhledem k struktuře naší sítě (která je tvořená z 95% mikroTIKY) to bude nejpřehlednější řešení, která nám poskytne značné výhody při řešení problémů s připojením našeho zákazníka do budoucna. Bezdrátové připojení musím zavést, protože v okolí neposkytuji adsl připojení a můj zákazník má výhled na naše AP umístěné necelých 500 metrů od něj. 

##### Další zařízení v síti (router) budou též od výrobce mikroTIK, switche nebudou v tomto případě potřeba.

### Dobrý výhled na AP má náš zákazník z balkónu a je to strategicky nejlepší místo z kterého bude jednoduché rozvést síť na potřebná místa skrz balkonové dveře.

## Zde můžeme vidět nákres bytu našeho zákazníka i s polohou jeho zařízení. <br> (mobily a tablet mají zadanou přibližnou polohu)
![1.PNG](Screenshots/1.PNG)

### Nejlepší místo pro router bude vedle televizního zařízení v obýváku, wifi dosáhne s celkem dobrým signálem do kuchyně a vedlejšího pokoje,ale hlavně ušetříme za lišty, protože kabeláž z routru do PC se bude tahat stejným místem, kterým bude zavedena do routeru.

## Zde vyřeším která zařízení jak připojím

##### Snažím se myslet do budoucna, je možné že zařízení která má jdou připojit přes bezdrátově, ale musím myslet i na to, že to tak být nemusí a pokusím se zavést i drátové spojení do zařízení jako je TV a PC. JE VŽDY LEPŠÍ MYSLET NA TO CO BUDE NEŽLI NA TO CO JE. Například tiskárna bude buď připojená k PC nebo bezdrátově, my ji tedy započteme do zařízení v kategorii BEZDRÁTOVÉHO PŘIPOJENÍ.

<ul>
<li>Smart TV bude připojeno kabelem z routeru vedle tv</li>
<li>Stolní počítač bude připojen drátově z routeru.</li>
<li>Tiskárna bude připojena bezdrátově</li>
<li>Tablety a mobily budou samozřejmě připojeny též bezdrátově.</li>
</ul>

## zde můžete vidět nákres mého řešení.
![2.PNG](Screenshots/2.PNG)
# Prvky sítě 

### Přijímač: [MikroTik RouterBOARD RBSXTG-5HPacD-SA, SXT SA5 ac, L4](https://www.abctech.cz/?cls=stoitem&stiid=14190&gclid=EAIaIQobChMIrteO7MeY6QIVDM53Ch1djAmTEAQYASABEgJ3WPD_BwE)
### Router: [Mikrotik RouterBOARD RB952Ui-5ac2nD](https://www.czc.cz/mikrotik-routerboard-rb952ui-5ac2nd/195329/produkt?gclid=EAIaIQobChMIxrXC5MOY6QIVi-J3Ch1ZTQfOEAQYAiABEgJw0fD_BwE)

# Kabeláž
#### kabel: [PATCH kabel UTP 5E, 25m](https://shop.emos.cz/2309010100-patch-kabel-utp-5e,-25m)
#### Lišty: [Soklová lišta Fatra 1363 PVC 112 (Páska, která zakryje kabely pod sebou... vypadá jak lišta)](https://www.floorwood.cz/soklova-pvc-lista-fatra-1363-342-delka-40m/?gclid=EAIaIQobChMIkfbo68WY6QIVWeN3Ch2iIQwOEAQYAiABEgITX_D_BwE)

# Ceník
## Ceny jsou čistě orientační, protože ne vždy zboží najdete za tuto cenu.
### Přijímač: 2 898 Kč,- 
### Router: 1 830 Kč,-
### Kabeláž: 180 Kč,-
### lišty: 290 Kč,-
# Celková cena činní 6 605 Kč,-
