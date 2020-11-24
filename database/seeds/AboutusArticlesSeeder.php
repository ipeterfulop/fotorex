<?php

namespace Database\Seeders;

use App\Article;
use App\Articlecategory;
use Illuminate\Database\Seeder;

class AboutusArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $position = 1;
        $dataset = [
            [
                'position' => $position++,
                'title' => 'Cégismertető',
                'published_at' => now(),
                'summary' => '<p>TELJES KÖRŰ IRODATECHNIKAI MEGOLDÁSOK - PARTNEREINK SZOLGÁLATÁBAN</p>',
                'content' => '<p><span ><span ><strong >TELJES KÖRŰ IRODATECHNIKAI MEGOLDÁSOK - PARTNEREINK SZOLGÁLATÁBAN</strong></span><br></span><span><br></span></p><span ><span>A FOTOREX Irodatechnika Kft. 1996-ban azzal az elhatározással jött létre, hogy az irodatechnikai piacon olyan színvonalú szolgáltatással jelenjen meg, amely a legteljesebb mértékben kielégíti a minőségre igényes felhasználók egyre növekvő táborát.</span><br><br><span ><strong>CÉLUNK, HOGY A LEHETŐ LEGMAGASABB MINŐSÉGŰ TERMÉKEKKEL ÉS SZOLGÁLTATÁSOKKAL, AZ ÁLTALUNK NYÚJTOTT TELJESKÖRŰ IRODATECHNIKAI MEGOLDÁSOKKAL, MINDENKOR AZ ÖNÖK SEGÍTSÉGÉRE LEGYÜNK TELJES KÖRŰ IRODAATOMATIZÁLÁSI ÉS -ÜZEMELTETÉSI IGÉNYEIK TERÉN.</strong></span><br><br><span><span >MEGFOGALMAZOTT TÖREKVÉSEINKET ÍGY ÖSSZEGEZHETJÜK:</span></span></span><ul><li><span >Teljes és mindenre kiterjedő figyelem a felhasználó irányába, a szaktanácsadástól kezdve, a szervizelésen és kellékanyag-ellátáson át, egészen az elhasználódott irodatechnikai eszközök visszavásárlásáig és környezetbarát kezeléséig.</span></li><li><span >A felhasználóval szoros együttműködésben, annak minden felmerülő igényét kielégíteni a világ vezető gyártói által nyújtható eszközökkel.</span></li></ul><span ><span>Rendkívül fontosnak tartjuk, hogy Partnereink részére kedvező beszerzési lehetőséget és egyben teljes körű szervizellátás nyújtotta nyugalmat biztosítsunk. Ennek érdekében olyan gyártói és kereskedelmi kapcsolatokat építettünk ki, amelyek lehetővé teszik, hogy vevőink egy forrásból szerezhessék be az igényeiket optimálisan kielégítő berendezéseket, az üzemeltetéshez szükséges anyagokat, alkatrészeket, s mindeközben élvezhessék egy gyártói támogatással működő szerviz nyújtotta előnyöket.</span><br><br><span><span ><span>A TELJESSÉG IGÉNYE NÉLKÜL, AZ ALÁBBI IRODATECHNIKAI TERMÉKCSOPORTOKAT FORGALMAZZUK:</span></span></span><br></span><ul><li><span >SHARP monochrom és színes többfunkciós dokumentumkezelő rendszerek, (print/copy/scan/fax) </span></li><li><span >KYOCERA monochrom és színes többfunkciós dokumentumkezelő rendszerek (print/copy/scan/fax)<br></span></li><li><span >SAMSUNG monochrom és színes többfunkciós dokumentumkezelő rendszerek (print/copy/scan/fax)</span></li><li><span >HP, XEROX monochrom és színes többfunkciós dokumentumkezelő eszközök (print/copy/scan/fax)<br></span></li></ul><p ><span ><span>Cégünk 1997. óta, mint a <strong><span >SHARP</span></strong> kiemelt </span><span ><strong>Premium Partner</strong></span><span>e, </span><span ><strong>Főforgalmazó</strong></span><span>ja és </span><span ><strong>Garanciaviselő szakszerviz</strong></span></span><span >e, maga mögött tudhatja a gyártó honi disztribúciójának és ezáltal az egész világot átfogó szervezetének támogatását.<br>2004-2005. években fokozatosan bevezettük a <strong><span >XEROX</span></strong>, <strong><span >HP</span></strong> és <strong><span >SAMSUNG</span></strong> termékek forgalmazását, valamint kiépítettük az említett márkák garanciális és garancián túli szervizszolgáltatási hátterünket is.</span></p><p ><span><span >2010. évtől kezdve megkezdtük a minőségéről, s egyben kedvező üzemeltetési költéseiről ismert <strong><span >KYOCERA</span></strong> termékek értékesítését, és szervizellátását.<br><br><span ><a href="/szolgaltatasok"><span ><span>SZOLGÁLTATÁSAINK:</span></span></a></span></span></span></p><span><p ><br><span >A termékértékesítés mellett nagy hangsúlyt helyezünk a jótállási időn belüli és azon túli szerviztevékenységre. <br>Ügyfeleink részére teljes körű és személyre szabott megoldásokat nyújtunk az igényfelméréstől, a helyi adottságoknak megfelelő tervezéstől kezdődően, a beszerzésen és üzemeltetésen át egészen az elhasznált irodaeszközök újrahasznosításáig.<br><strong><span >M</span><span >indenre kiterjedő, komplex szolgáltatás</span></strong>ainkkal segítjük Ügyfeleinket nyomtatási, másolási, dokumentumkezelési feladataik könnyebb ellátásában, irodatechnikai eszközeik zökkenőmentes, átlátható és költséghatékony üzemeltetésében.<br>Kapcsolatainkat igyekszünk úgy építeni, hogy azok időtállóak legyenek, ezért Partnereinkkel folyamatos kétirányú kommunikációt tartunk fenn, felmerülő igényeikkel szemben pedig rugalmas hozzáállást tanúsítunk.<br><br>Ahhoz, hogy feladatunkat kifogástalanul elláthassuk, megszerveztük szerviztechnikus munkatársaink magas szintű és folyamatos képzését, amelyben elsősorban a márkaképviseletekre támaszkodunk.<br>Ezáltal közvetlenül, első kézből értesülünk a legfrissebb szakmai információkról, technikai újdonságokról és a jövőben várható fejlesztésekről is.<br>Munkánkról naprakész nyilvántartást vezetünk, teljesítményünket rendszeres ellenőrzésnek, értékelésnek vetjük alá. Az így megszerzett tapasztalatok felhasználásával arra törekszünk, hogy szolgáltatásaink minőségét hosszútávon biztosítsuk, lehetőség szerint folyamatosan fejlesszük.<br></span></p></span><p ><span><span >Őszintén reméljük, hogy a közeljövőben hozzájárulhatunk az irodatechnikai költségek csökkentéséhez, a géppark optimalizálásához, s mint az Önök partnere megvalósíthatjuk célunkat: kiváló minőségű termékeinkkel és az általunk nyújtott teljes körű irodatechnikai megoldásokkal, mindenkor Ügyfeleink segítségére lenni teljes körű irodaatomatizálási és -üzemeltetési igényeik terén.<br><br><strong><span >Tegyen próbára minket, legyen Ön is Partnerünk!</span></strong><br><br>Budapest, 2011. január 31.</span></span></p>',
                'slug' => 'cegismerteto',
            ],
            [
                'position' => $position++,
                'title' => 'Minőség',
                'published_at' => now(),
                'summary' => '<p>Büszkék vagyunk rá, hogy közel ezerötszáz Ügyfelünk között úgy az intézményi, mind a versenyszférában számos Partnerünk kitartó bizalmát élvezzük. Cégünk szerződött, vagy rendszeres szolgáltatóként és termékbeszállítóként több jelentős intézménnyel, országos hírű nagyvállalattal áll kapcsolatban, melyeket évről évre rendszeres megrendelőink között tarthatjuk számon.</p>',
                'content' => '<p><span style="font-size: 10pt;"><span style="text-decoration: underline;"><strong><span style="color: #ff0000;">MINŐSÉG MINDENEK FELETT:</span></strong></span></span></p><p>Büszkék vagyunk rá, hogy közel ezerötszáz Ügyfelünk között úgy az intézményi, mind a versenyszférában számos Partnerünk kitartó bizalmát élvezzük. Cégünk szerződött, vagy rendszeres szolgáltatóként és termékbeszállítóként több jelentős intézménnyel, országos hírű nagyvállalattal áll kapcsolatban, melyeket évről évre rendszeres megrendelőink között tarthatjuk számon.</p><p>Célunk, hogy szolgáltatásaink minősége, szakszerűsége és gyorsasága minden meglévő Partnerünk számára természetes legyen, új Ügyfeleinknek pedig kellemes meglepetést jelentsen.</p><p>Ügyfeleink lehető legmagasabb színvonalon történő kiszolgálása érdekében 2005. májusától ISO 9001: 2009 szabvány szerinti Minőségirányítási Rendszer bevezetése és működtetése mellett köteleztük el magunkat. Büszkén jelenthetjük ki, hogy minőségirányítási rendszerünk az IQNet és az AIB-Vincotte International Ltd. által nemzetközileg elismert tanúsítást kapott.</p>',
                'slug' => 'minoseg',
            ],
            [
                'position' => $position++,
                'title' => 'Üzemeltető adatai',
                'published_at' => now(),
                'summary' => '<p>Elérhetőségek, adatok</p>',
                'content' => '<p><span >ÜZEMELTETŐ ADATAI, ELÉRHETŐSÉGEK</span></p><p><strong><span ><span >FOTOREX Irodatechnika Kft.</span></span></strong></p><p><span ><span >H-1148 Budapest, Lengyel u. 16.<br><br> </span></span></p><p><span >Tel.: 06-1/470-4020</span></p><p><span >Fax: 06-1/470-4021</span></p><p><span >E-mail: </span><span class="nospam-email" data-rec="info" data-domain="fotorex" data-tld="hu"></span></span></p><p><span ><span >Adószám: 12190971-2-42</span></span></p><p><span ><span >Közösségi adószám: HU12190971</span></span></p><p><span ><span >Cégjegyzékszám: 01-09-563487</span></span></p><p><span >Bejegyezte: Fővárosi Bíróság mint Cégbíróság</span></p><p><span >Számlavezető: K&amp;H Bank Zrt..</span></p><p><span >Bankszámla: 10409015-90129986-00000000</span></p><p><span >Nyitva tartás:</span></p><p><span >Hétfőtől - Csütörtökig: 08:00 - 16:00<br>Pénteken: 08:00 - 15:00 </span></p><span >Cégünk nem járul hozzá a fenti elérhetőségek telemarketing, direkt marketing, valamint ügynöki, közvéleménykutatási célú felhasználásához!</span>',
                'slug' => 'felhasznaloi-feltetelek',
            ]
        ];
        $category = Articlecategory::findBySlug('cegismerteto');
        foreach ($dataset as $row) {
            $row['articlecategory_id'] = $category->id;
            $row['is_published'] = 1;
            $article = Article::findBySlug($row['slug'], false, false);
            if ($article == null) {
                $article = Article::create($row);
            } else {
                $article->update($row);
            }
        }
    }
}
