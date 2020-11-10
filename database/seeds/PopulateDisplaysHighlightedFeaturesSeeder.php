<?php

namespace Database\Seeders;

use App\Display;
use App\PrinterAttribute;
use Illuminate\Database\Seeder;

class PopulateDisplaysHighlightedFeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataSet = $this->getRawDataSet();
        $this->addOrUpdateRecords($dataSet);
    }

    private function getRawDataSet(): array
    {
        $dataSet = [
            'PNCD701'  => '<ul class=\'highlighted-features\'><li>Megfelel a Microsoft Windows collaboration display specifikációjának</li><li>Integrált audio és 4K videó, támogatja a Microsoft Teams / Skype for Business alkalmazásokat</li><li>Zökkenőmentes működés és konferencia beszélgetés a Microsoft Office 365 és Teams segítségével</li></ul>',
            'PN85TH1'  => '<ul class=\'highlighted-features\'><li>BIG PAD irodai tárgyalókba, vállalati tanácstermekbe és professzionális oktatótermekbe</li><li>85&quot;-ös (214 cm-es) méret 3840 x 2160 képponttal</li><li>&quot;Pen-On-Paper&quot; felhasználói élmény 20 érintőpontos InGlass™ érintéstechnológiával</li></ul>',
            'PN75TH1'  => '<ul class=\'highlighted-features\'><li>BIG PAD irodai tárgyalókba, vállalati tanácstermekbe és professzionális oktatótermekbe</li><li>75&quot;-ös (189 cm-es) méret 3840 x 2160 képponttal</li><li>&quot;Pen-On-Paper&quot; felhasználói élmény 20 érintőpontos InGlass™ érintéstechnológiával</li></ul>',
            'PN65TH1'  => '<ul class=\'highlighted-features\'><li>BIG PAD irodai tárgyalókba, vállalati tanácstermekbe és professzionális oktatótermekbe</li><li>65&quot;-ös (163 cm-es) méret 3840 x 2160 képponttal</li><li>&quot;Pen-On-Paper&quot; felhasználói élmény 20 érintőpontos InGlass™ érintéstechnológiával</li></ul>',
            'PN80TH5'  => '<ul class=\'highlighted-features\'><li>BIG PAD egyedi szakmai, oktatási és kulcsfontosságú rendszerekhez történő felhasználáshoz</li><li>80&quot;-es (204,4 cm-es) képátló 3840x2160 képponttal</li><li>&quot;Pen-On-Paper&quot; felhasználói élmény kiváló reszponzivitású, 30 érintőpontos P-CAP érintéstechnológiával</li></ul>',
            'PN70TH5'  => '<ul class=\'highlighted-features\'><li>4K-s BIG PAD igényes vállalati irodai, oktatási és valós idejű döntéshozatalt igénylő környezetekbe</li><li>70&quot;-es (176,6 cm-es) képátló 3840x2160 képponttal</li><li>&quot;Pen-On-Paper&quot; felhasználói élmény kiváló reszponzivitású, 30 érintőpontos P-CAP érintéstechnológiával</li></ul>',
            'PN60TB3'  => '<ul class=\'highlighted-features\'><li>152,5 cm-es képátló</li><li>1.920 x 1.080 képpontos felbontás</li><li>IR 10 érintőpont - 4 felhasználóig</li></ul>',
            'PN86HC1'  => '<ul class=\'highlighted-features\'><li>4K-s BIG PAD oktatási, képzési és tárgyalótermi használatra</li><li>86&quot;-os (217,4 cm-es) képátló 3840 x 2160 képponttal</li><li>Gyors és reszponzív infravörös (IR) technológiájú 20 pontos érintés</li></ul>',
            'PN75HC1'  => '<ul class=\'highlighted-features\'><li>4K-s BIG PAD oktatási, képzési célokra és tárgyalótermi használatra</li><li>75&quot;-ös (189,3 cm-es) képátló 3840 x 2160 képponttal</li><li>Gyors és reszponzív infravörös (IR) technológiájú 20 pontos érintés</li></ul>',
            'PN70HC1E' => '<ul class=\'highlighted-features\'><li>4K-s BIG PAD oktatási, képzési célokra és tárgyalótermi használatra</li><li>70&quot;-es (176,6 cm-es) képátló 3840x2160 képponttal</li><li>Gyors és reszponzív infravörös (IR) technológiájú 10 pontos érintés</li></ul>',
            'PN50TC1'  => '<ul class=\'highlighted-features\'><li>BIG PAD képernyő informális kistárgyalókba és interaktív kiskereskedelmi signage használatra</li><li>50&quot;-es (125,7 cm-es) képátló 1920x1080 képponttal</li><li>&quot;Pen-on-paper&quot; (Tollal papírra) felhasználói élmény gyors és reszponzív PCAP kapacitív 10 pontos érintésvezérlési technológiával</li></ul>',
            'PN40TC1'  => '<ul class=\'highlighted-features\'><li>BIG PAD képernyő informális irodai tárgyalókba és interaktív kiskereskedelmi signage felhasználáshoz</li><li>40&quot;-as (100,33 cm) méret 1920 x 1080 pixel felbontással</li><li>Gyors és reszponzív PCAP 10 pontos kapacitív érintésvezérlés - akár 4 felhasználónak</li></ul>',
        ];

        return $dataSet;
    }

    private function addOrUpdateRecords(array $dataSet)
    {
        $modelnumbers = array_keys($dataSet);
        foreach ($modelnumbers as $modelnumber) {
            $display = Display::findByModelNumber($modelnumber);
            if (!is_null($display)) {
                PrinterAttribute::addOrUpdate($display->id, 'highlighted_features', $dataSet[$modelnumber]);
            }
        }
    }


}
