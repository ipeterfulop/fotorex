<?php

namespace Database\Seeders;

use App\Printer;
use App\PrinterAttribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PopulatePrintersAdditionalInformation extends Seeder
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

    private function addOrUpdateRecords(array $dataSet)
    {
        foreach ($dataSet as $dataItem) {
            $printerData = [];
            $printer = Printer::find($dataItem['id']);
            if (!is_null($printer)) {
                if (!is_null($dataItem['name'])) {
                    $printerData['name'] = Str::lower($dataItem['name']);
                    $printerData['slug'] = Str::slug(
                        $printer->manufacturer->name
                        . '-'
                        . $printer->model_number
                        . '-'
                        . $dataItem['name']
                    );
                }
                if (!is_null($dataItem['price'])) {
                    $printerData['price'] = $dataItem['price'];
                    $printerData['request_for_price'] = 0;
                }

                if (!is_null($dataItem['popularity_index'])) {
                    $printerData['popularity_index'] = $dataItem['popularity_index'];
                }

                if (count(array_keys($printerData)) > 0) {
                    DB::table('printers')
                      ->where('id', $dataItem['id'])
                      ->update($printerData);
                }

                if (!is_null($dataItem['key_features'])) {
                    PrinterAttribute::addOrUpdate($dataItem['id'], 'key_features', $dataItem['key_features']);
                }
            }
        }
    }

    /**
     * @return array
     */
    private function getRawDataSet(): array
    {
        $dataRows = [

            [
                'model_number'     => 'MX6071',
                'name'             => 'Hagyja magát meggyőzni: Brilliáns színek, termelékenység, teljes hálózati integráció, robosztus biztonsági funkciók, energiatakarékosság',
                'price'            => '',
                'key_features'     => 'max SRA3, 60 lap/perc, teljes duplex funkcionalitás, DADF, AdobePsotScript3, villámgyors OCR, kereshető PDF és MSOffice fájlok szkennelése, WiFi, felhőszolgáltatások elérése, NFC, QR-kódos nyomtatás, PrintRelease',
                'popularity_index' => '44',
            ],
            [
                'model_number'     => 'MX6051',
                'name'             => 'Sebesség, terhelhetőség, magas képminőség, kedvező üzemeltetés -mindezt színesben',
                'price'            => '',
                'key_features'     => 'max SRA3, 60 lap/perc, duplex színes hálózati nyomtatás, másolás, szkenner, nagy papírkacitás és hatalmas lcd-vezérlő panel, jól bővíthető',
                'popularity_index' => '46',
            ],
            [
                'model_number'     => 'MXC557F',
                'name'             => '',
                'price'            => '',
                'key_features'     => '',
                'popularity_index' => '71',
            ],
            [
                'model_number'     => 'MX5071',
                'name'             => 'Hagyja magát meggyőzni: Brilliáns színek, termelékenység, teljes hálózati integráció, robosztus biztonsági funkciók, energiatakarékosság',
                'price'            => '',
                'key_features'     => 'max SRA3, 50 lap/perc, teljes duplex funkcionalitás, DADF, AdobePsotScript3, villámgyors OCR, kereshető PDF és MSOffice fájlok szkennelése, WiFi, felhőszolgáltatások elérése, NFC, QR-kódos nyomtatás, PrintRelease',
                'popularity_index' => '42',
            ],
            [
                'model_number'     => 'MX5051',
                'name'             => 'Sebesség, terhelhetőség, magas képminőség, kedvező üzemeltetés -mindezt színesben',
                'price'            => '',
                'key_features'     => 'max SRA3, 50 lap/perc, duplex színes hálózati nyomtatás, másolás, szkenner, nagy papírkacitás és hatalmas lcd-vezérlő panel, jól bővíthető',
                'popularity_index' => '34',
            ],
            [
                'model_number'     => 'MXC507F',
                'name'             => '',
                'price'            => '',
                'key_features'     => '',
                'popularity_index' => '72',
            ],
            [
                'model_number'     => 'MX4141N',
                'name'             => 'Felújított, keveset futott A3-as színes mindenttudó, garanciával',
                'price'            => '',
                'key_features'     => 'A3-as, teljesen felszerelt hálózatos többfunkciós nyomtató, színes szkenner, duplex, beépített hdd, nagy kapacitású papírfiókok, önhordó, kedvező üzemeltetés',
                'popularity_index' => '15,1',
            ],
            [
                'model_number'     => 'MX4071',
                'name'             => 'Hagyja magát meggyőzni: Brilliáns színek, termelékenység, teljes hálózati integráció, robosztus biztonsági funkciók, energiatakarékosság',
                'price'            => '',
                'key_features'     => 'max SRA3, 40 lap/perc, teljes duplex funkcionalitás, DADF, AdobePsotScript3, villámgyors OCR, kereshető PDF és MSOffice fájlok szkennelése, WiFi, felhőszolgáltatások elérése, NFC, QR-kódos nyomtatás, PrintRelease',
                'popularity_index' => '33',
            ],
            [
                'model_number'     => 'MX4061',
                'name'             => 'Hagyja magát meggyőzni: Brilliáns színek, termelékenység, teljes hálózati integráció, robosztus biztonsági funkciók, energiatakarékosság',
                'price'            => '',
                'key_features'     => 'max SRA3, 40 lap/perc, teljes duplex funkcionalitás, AdobePsotScript3, villámgyors OCR, kereshető PDF és MSOffice fájlok szkennelése, WiFi, felhőszolgáltatások elérése, NFC, QR-kódos nyomtatás, PrintRelease',
                'popularity_index' => '38',
            ],
            [
                'model_number'     => 'MX4051',
                'name'             => 'Sebesség, terhelhetőség, magas képminőség, kedvező üzemeltetés -mindezt színesben',
                'price'            => '',
                'key_features'     => 'max SRA3, 40 lap/perc, duplex színes hálózati nyomtatás, másolás, szkenner, nagy papírkacitás és hatalmas lcd-vezérlő panel, jól bővíthető',
                'popularity_index' => '28',
            ],
            [
                'model_number'     => 'MXC407F',
                'name'             => '',
                'price'            => '',
                'key_features'     => '',
                'popularity_index' => '70',
            ],
            [
                'model_number'     => 'MX3571',
                'name'             => 'Hagyja magát meggyőzni: Brilliáns színek, termelékenység, teljes hálózati integráció, robosztus biztonsági funkciók, energiatakarékosság',
                'price'            => '',
                'key_features'     => 'max SRA3, 35 lap/perc, teljes duplex funkcionalitás, DADF, AdobePsotScript3, villámgyors OCR, kereshető PDF és MSOffice fájlok szkennelése, WiFi, felhőszolgáltatások elérése, NFC, QR-kódos nyomtatás, PrintRelease',
                'popularity_index' => '13',
            ],
            [
                'model_number'     => 'MX3561',
                'name'             => 'Hagyja magát meggyőzni: Brilliáns színek, termelékenység, teljes hálózati integráció, robosztus biztonsági funkciók, energiatakarékosság',
                'price'            => '',
                'key_features'     => 'max SRA3, 35 lap/perc, teljes duplex funkcionalitás, AdobePsotScript3, villámgyors OCR, kereshető PDF és MSOffice fájlok szkennelése, WiFi, felhőszolgáltatások elérése, NFC, QR-kódos nyomtatás, PrintRelease',
                'popularity_index' => '17',
            ],
            [
                'model_number'     => 'MX3551',
                'name'             => 'Sebesség, terhelhetőség, magas képminőség, kedvező üzemeltetés -mindezt színesben',
                'price'            => '',
                'key_features'     => 'max SRA3, 35 lap/perc, duplex színes hálózati nyomtatás, másolás, szkenner, nagy papírkacitás és hatalmas lcd-vezérlő panel, jól bővíthető',
                'popularity_index' => '8',
            ],
            [
                'model_number'     => 'MXC357F',
                'name'             => '',
                'price'            => '',
                'key_features'     => '',
                'popularity_index' => '73',
            ],
            [
                'model_number'     => 'MX3140N',
                'name'             => 'Felújított, keveset futott A3-as színes mindenttudó, garanciával',
                'price'            => '',
                'key_features'     => 'A3-as, teljesen felszerelt hálózatos többfunkciós nyomtató, színes szkenner, duplex, beépített hdd, nagy kapacitású papírfiókok, önhordó, kedvező üzemeltetés',
                'popularity_index' => '18,1',
            ],
            [
                'model_number'     => 'MX3071',
                'name'             => 'Hagyja magát meggyőzni: Brilliáns színek, termelékenység, teljes hálózati integráció, robosztus biztonsági funkciók, energiatakarékosság',
                'price'            => '',
                'key_features'     => 'max SRA3, 30 lap/perc, teljes duplex funkcionalitás, DADF, AdobePsotScript3, villámgyors OCR, kereshető PDF és MSOffice fájlok szkennelése, WiFi, felhőszolgáltatások elérése, NFC, QR-kódos nyomtatás, PrintRelease',
                'popularity_index' => '5',
            ],
            [
                'model_number'     => 'MX3061',
                'name'             => 'Hagyja magát meggyőzni: Brilliáns színek, termelékenység, teljes hálózati integráció, robosztus biztonsági funkciók, energiatakarékosság',
                'price'            => '',
                'key_features'     => 'max SRA3, 30 lap/perc, teljes duplex funkcionalitás, AdobePsotScript3, villámgyors OCR, kereshető PDF és MSOffice fájlok szkennelése, WiFi, felhőszolgáltatások elérése, NFC, QR-kódos nyomtatás, PrintRelease',
                'popularity_index' => '23',
            ],
            [
                'model_number'     => 'MX3051',
                'name'             => 'Sebesség, terhelhetőség, magas képminőség, kedvező üzemeltetés -mindezt színesben',
                'price'            => '',
                'key_features'     => 'max SRA3, 30 lap/perc, duplex színes hálózati nyomtatás, másolás, szkenner, nagy papírkacitás és hatalmas lcd-vezérlő panel, jól bővíthető',
                'popularity_index' => '20',
            ],
            [
                'model_number'     => 'MX2651',
                'name'             => 'Slágertermék! Teljes körű színes dokumentumfeldolgozás A3-as méretig',
                'price'            => '699000',
                'key_features'     => 'kedvező költségek, kiváló minőség, széleskörű szolgáltatások a hálózatban',
                'popularity_index' => '1',
            ],
            [
                'model_number'     => 'MX2614N',
                'name'             => 'Felújított, keveset futott A3-as színes mindenttudó, garanciával',
                'price'            => '',
                'key_features'     => 'A3-as, teljesen felszerelt hálózatos többfunkciós nyomtató, színes szkenner, duplex, beépített hdd, nagy kapacitású papírfiókok, önhordó, kedvező üzemeltetés',
                'popularity_index' => '11,1',
            ],
            [
                'model_number'     => 'MXC304W',
                'name'             => 'Színes A4-es, jól terhelhető  mindenttudó méregzsák',
                'price'            => '',
                'key_features'     => 'színes teljes körű megoldás, hdd, villámgyors, duálfejes ocr szkennelés, WiFi, Adobe PostSript3',
                'popularity_index' => '9',
            ],
            [
                'model_number'     => 'MXC303W',
                'name'             => 'Egyedi tervezés, elegáns vonalak, mindenhol jól mutat',
                'price'            => '',
                'key_features'     => 'A4-es, gyors, kétoldalas színes 4in1 mfp, WiFi, PostScript3, fax, kedvező fenntartással',
                'popularity_index' => '4',
            ],
            [
                'model_number'     => 'MXC607P',
                'name'             => '',
                'price'            => '',
                'key_features'     => '',
                'popularity_index' => '1',
            ],
            [
                'model_number'     => 'MXC507P',
                'name'             => '',
                'price'            => '',
                'key_features'     => '',
                'popularity_index' => '2',
            ],
            [
                'model_number'     => 'MXC407P',
                'name'             => '',
                'price'            => '',
                'key_features'     => '',
                'popularity_index' => '3',
            ],
            [
                'model_number'     => 'MXM7570',
                'name'             => '',
                'price'            => '',
                'key_features'     => '',
                'popularity_index' => '48',
            ],
            [
                'model_number'     => 'MXB707F',
                'name'             => '',
                'price'            => '',
                'key_features'     => '',
                'popularity_index' => '74',
            ],
            [
                'model_number'     => 'MXM6570',
                'name'             => '',
                'price'            => '',
                'key_features'     => '',
                'popularity_index' => '47',
            ],
            [
                'model_number'     => 'MXM6071',
                'name'             => 'Sebesség, terhelhetőség, magas képminőség, kedvező üzemeltetés -mindezt A3W méretig és 300 g/m2 papírsúlyig',
                'price'            => '',
                'key_features'     => 'max A3W, 60 lap/perc, duplex fekete hálózati nyomtatás, másolás, színes duálfejes szkenner, WiFi, nagy papírkacitás és hatalmas lcd-vezérlő panel, jól bővíthető',
                'popularity_index' => '45',
            ],
            [
                'model_number'     => 'MXM6051',
                'name'             => 'Sebesség, terhelhetőség, magas képminőség, kedvező üzemeltetés -mindezt A3W méretig',
                'price'            => '',
                'key_features'     => 'max A3W, 60 lap/perc, duplex fekete hálózati nyomtatás, másolás, színes szkenner, nagy papírkacitás és hatalmas lcd-vezérlő panel, jól bővíthető',
                'popularity_index' => '49',
            ],
            [
                'model_number'     => 'MXM564N',
                'name'             => 'Felújított, keveset futott A3-as monochrom mindenttudó, garanciával',
                'price'            => '',
                'key_features'     => 'A3-as, teljesen felszerelt hálózatos többfunkciós monochrom nyomtató, színes szkenner, duplex, beépített hdd, nagy kapacitású papírfiókok, önhordó, kedvező üzemeltetés',
                'popularity_index' => '40,1',
            ],
            [
                'model_number'     => 'MXB557F',
                'name'             => '',
                'price'            => '',
                'key_features'     => '',
                'popularity_index' => '75',
            ],
            [
                'model_number'     => 'MXM5071',
                'name'             => 'Sebesség, terhelhetőség, magas képminőség, kedvező üzemeltetés -mindezt A3W méretig és 300 g/m2 papírsúlyig',
                'price'            => '',
                'key_features'     => 'max A3W, 50 lap/perc, duplex fekete hálózati nyomtatás, másolás, színes duálfejes szkenner, WiFi, nagy papírkacitás és hatalmas lcd-vezérlő panel, jól bővíthető',
                'popularity_index' => '43',
            ],
            [
                'model_number'     => 'MXM5051',
                'name'             => 'Sebesség, terhelhetőség, magas képminőség, kedvező üzemeltetés -mindezt A3W méretig',
                'price'            => '',
                'key_features'     => 'max A3W, 50 lap/perc, duplex fekete hálózati nyomtatás, másolás, színes szkenner, nagy papírkacitás és hatalmas lcd-vezérlő panel, jól bővíthető',
                'popularity_index' => '41',
            ],
            [
                'model_number'     => 'MXM503U',
                'name'             => 'Felújított, keveset futott A3-as monochrom mindenttudó, garanciával',
                'price'            => '',
                'key_features'     => 'A3-as, teljesen felszerelt hálózatos többfunkciós monochrom nyomtató, színes szkenner, duplex, nagy kapacitású papírfiókok, önhordó, kedvező üzemeltetés',
                'popularity_index' => '35,1',
            ],
            [
                'model_number'     => 'MXM465N',
                'name'             => 'Felújított, keveset futott A3-as monochrom mindenttudó, garanciával',
                'price'            => '',
                'key_features'     => 'A3-as, teljesen felszerelt hálózatos többfunkciós monochrom nyomtató, színes szkenner, duplex, beépített hdd, nagy kapacitású papírfiókok, önhordó, kedvező üzemeltetés',
                'popularity_index' => '37,1',
            ],
            [
                'model_number'     => 'MXM464N',
                'name'             => 'Felújított, keveset futott A3-as monochrom mindenttudó, garanciával',
                'price'            => '',
                'key_features'     => 'A3-as, teljesen felszerelt hálózatos többfunkciós monochrom nyomtató, színes szkenner, duplex, beépített hdd, nagy kapacitású papírfiókok, önhordó, kedvező üzemeltetés',
                'popularity_index' => '37,2',
            ],
            [
                'model_number'     => 'MXM452N',
                'name'             => 'Felújított, keveset futott A3-as monochrom mindenttudó, garanciával',
                'price'            => '',
                'key_features'     => 'A3-as, teljesen felszerelt hálózatos többfunkciós monochrom nyomtató, színes szkenner, duplex, beépített hdd, nagy kapacitású papírfiókok, önhordó, kedvező üzemeltetés',
                'popularity_index' => '33,1',
            ],
            [
                'model_number'     => 'MXM453U',
                'name'             => 'Felújított, keveset futott A3-as monochrom mindenttudó, garanciával',
                'price'            => '',
                'key_features'     => 'A3-as, teljesen felszerelt hálózatos többfunkciós monochrom nyomtató, színes szkenner, duplex, nagy kapacitású papírfiókok, önhordó, kedvező üzemeltetés',
                'popularity_index' => '33,2',
            ],
            [
                'model_number'     => 'MXM4071',
                'name'             => 'Sebesség, terhelhetőség, magas képminőség, kedvező üzemeltetés -mindezt A3W méretig és 300 g/m2 papírsúlyig',
                'price'            => '',
                'key_features'     => 'max A3W, 40 lap/perc, duplex fekete hálózati nyomtatás, másolás, színes duálfejes szkenner, WiFi, nagy papírkacitás és hatalmas lcd-vezérlő panel, jól bővíthető',
                'popularity_index' => '31',
            ],
            [
                'model_number'     => 'MXM4051',
                'name'             => 'Sebesség, terhelhetőség, magas képminőség, kedvező üzemeltetés -mindezt A3W méretig',
                'price'            => '',
                'key_features'     => 'max A3W, 40 lap/perc, duplex fekete hálózati nyomtatás, másolás, színes szkenner, nagy papírkacitás és hatalmas lcd-vezérlő panel, jól bővíthető',
                'popularity_index' => '36',
            ],
            [
                'model_number'     => 'MXM4050',
                'name'             => '',
                'price'            => '',
                'key_features'     => '',
                'popularity_index' => '44,1',
            ],
            [
                'model_number'     => 'MXM365N',
                'name'             => 'Felújított, keveset futott A3-as monochrom mindenttudó, garanciával',
                'price'            => '',
                'key_features'     => 'A3-as, teljesen felszerelt hálózatos többfunkciós monochrom nyomtató, színes szkenner, duplex, beépített hdd, nagy kapacitású papírfiókok, önhordó, kedvező üzemeltetés',
                'popularity_index' => '44,2',
            ],
            [
                'model_number'     => 'MXM364N',
                'name'             => 'Felújított, keveset futott A3-as monochrom mindenttudó, garanciával',
                'price'            => '',
                'key_features'     => 'A3-as, teljesen felszerelt hálózatos többfunkciós monochrom nyomtató, színes szkenner, duplex, beépített hdd, nagy kapacitású papírfiókok, önhordó, kedvező üzemeltetés',
                'popularity_index' => '44,3',
            ],
            [
                'model_number'     => 'MXM3571',
                'name'             => 'Sebesség, terhelhetőség, magas képminőség, kedvező üzemeltetés -mindezt A3W méretig és 300 g/m2 papírsúlyig',
                'price'            => '',
                'key_features'     => 'max A3W, 35 lap/perc, duplex fekete hálózati nyomtatás, másolás, színes duálfejes szkenner, WiFi, nagy papírkacitás és hatalmas lcd-vezérlő panel, jól bővíthető',
                'popularity_index' => '14',
            ],
            [
                'model_number'     => 'MXM3570',
                'name'             => '',
                'price'            => '',
                'key_features'     => '',
                'popularity_index' => '7,1',
            ],
            [
                'model_number'     => 'MXM3551',
                'name'             => 'Sebesség, terhelhetőség, magas képminőség, kedvező üzemeltetés -mindezt A3W méretig',
                'price'            => '',
                'key_features'     => 'max A3W, 35 lap/perc, duplex fekete hálózati nyomtatás, másolás, színes szkenner, nagy papírkacitás és hatalmas lcd-vezérlő panel, jól bővíthető',
                'popularity_index' => '7',
            ],
            [
                'model_number'     => 'MXM3550',
                'name'             => '',
                'price'            => '',
                'key_features'     => '',
                'popularity_index' => '7,2',
            ],
            [
                'model_number'     => 'MXM356NV',
                'name'             => 'Felújított, keveset futott A3-as monochrom mindenttudó, garanciával',
                'price'            => '',
                'key_features'     => 'A3-as, teljesen felszerelt hálózatos többfunkciós monochrom nyomtató, színes szkenner, duplex, beépített hdd, nagy kapacitású papírfiókok, önhordó, kedvező üzemeltetés',
                'popularity_index' => '47,7',
            ],
            [
                'model_number'     => 'MXM316NV',
                'name'             => 'Irodai mindenes fekete-fehérben',
                'price'            => '',
                'key_features'     => 'max A3, duplex hálózati nyomtató, másoló, színes hálózati szkenner',
                'popularity_index' => '47,8',
            ],
            [
                'model_number'     => 'MXM3071',
                'name'             => 'Sebesség, terhelhetőség, magas képminőség, kedvező üzemeltetés -mindezt A3W méretig és 300 g/m2 papírsúlyig',
                'price'            => '',
                'key_features'     => 'max A3W, 30 lap/perc, duplex fekete hálózati nyomtatás, másolás, színes duálfejes szkenner, WiFi, nagy papírkacitás és hatalmas lcd-vezérlő panel, jól bővíthető',
                'popularity_index' => '24',
            ],
            [
                'model_number'     => 'MXM3070',
                'name'             => '',
                'price'            => '',
                'key_features'     => '',
                'popularity_index' => '24,1',
            ],
            [
                'model_number'     => 'MXM3051',
                'name'             => 'Sebesség, terhelhetőség, magas képminőség, kedvező üzemeltetés -mindezt A3W méretig',
                'price'            => '',
                'key_features'     => 'max A3W, 30 lap/perc, duplex fekete hálózati nyomtatás, másolás, színes szkenner, nagy papírkacitás és hatalmas lcd-vezérlő panel, jól bővíthető',
                'popularity_index' => '21',
            ],
            [
                'model_number'     => 'MXM2651',
                'name'             => 'Slágertermék! Teljes körű monochrom dokumentumfeldolgozás A3-as méretig',
                'price'            => '',
                'key_features'     => 'kedvező költségek, kiváló minőség, teljes körű duplex funkcionalitás, fekete másolás/nyomtás, színes szkennelés,  széleskörű szolgáltatások a hálózatban',
                'popularity_index' => '2',
            ],
            [
                'model_number'     => 'MXM2630',
                'name'             => 'Felújított, keveset futott A3-as fekete-fehér mindenttudó, garanciával',
                'price'            => '',
                'key_features'     => 'A3-as, teljesen felszerelt hálózatos többfunkciós monochrom nyomtató, színes szkenner, duplex, beépített hdd, nagy kapacitású papírfiókok, önhordó, kedvező üzemeltetés',
                'popularity_index' => '20,1',
            ],
            [
                'model_number'     => 'MXM266NV',
                'name'             => 'Irodai mindenes fekete-fehérben',
                'price'            => '429000',
                'key_features'     => 'max A3, duplex hálózati nyomtató, másoló, színes hálózati szkenner',
                'popularity_index' => '19,1',
            ],
            [
                'model_number'     => 'AR6023NV',
                'name'             => 'Amire csak szüksége lehet... mindezt olcsón',
                'price'            => '219900',
                'key_features'     => 'hálózatos, duplex nyomtató, másoló, kis-közepes munkacsoportok számára ideális belépő szintű, A3-as  többfunkciós eszköz',
                'popularity_index' => '32',
            ],
            [
                'model_number'     => 'AR6020NV',
                'name'             => 'Egyszerű, de nagyszerű, kedvező árú fekete-fehér A3-as MFP ',
                'price'            => '179000',
                'key_features'     => 'hálózatos, duplex nyomtató, másoló, kis-közepes munkacsoportok számára ideális belépő szintű, A3-as többfunkciós eszköz',
                'popularity_index' => '27',
            ],
            [
                'model_number'     => 'AR6020DV',
                'name'             => 'Egyszerű duplex másoló nyomtató szkenner, A3-ban',
                'price'            => '',
                'key_features'     => 'korrekt minőség, kedvező fenntartás, megbízható üzemelés, tudja amit kell',
                'popularity_index' => '39',
            ],
            [
                'model_number'     => 'AR6020V',
                'name'             => 'Legolcsóbb másoló nyomtató szkenner, A3-ban',
                'price'            => '',
                'key_features'     => 'korrekt minőség, kedvező fenntartás, megbízható üzemelés',
                'popularity_index' => '51',
            ],
            [
                'model_number'     => 'MXB456W',
                'name'             => 'OCR szkennelés kell? Azt is tudja!',
                'price'            => '',
                'key_features'     => 'teljes körű megoldás, fekete nyomtatás, másolás, hdd-vel, színes ocr szkennelés, villámgyors duálszkenner, Adobe PS3, megdöbbentően olcsó üzemeltetés',
                'popularity_index' => '35',
            ],
            [
                'model_number'     => 'MXB450W',
                'name'             => 'Mindent tud, amit a nagyok',
                'price'            => '',
                'key_features'     => 'max A4, jól terhelhető monochrom hálózatos nyomtató, másoló, színes szkenner, kedvező üzemeltetéssel',
                'popularity_index' => '25',
            ],
            [
                'model_number'     => 'MXB356W',
                'name'             => 'Színes A4-es, jól terhelhető  mindenttudó méregzsák',
                'price'            => '',
                'key_features'     => 'színes ocr szkenner, minőségi monochrom hálózatos nyomtató, másoló, nagy lcd-kijelzővel, Adobe PostSript3',
                'popularity_index' => '19',
            ],
            [
                'model_number'     => 'MXB350W',
                'name'             => 'Mindent tud, amit a nagyok',
                'price'            => '195000',
                'key_features'     => 'max A4, jól terhelhető monochrom hálózatos nyomtató, másoló, színes szkenner, kedvező üzemeltetéssel',
                'popularity_index' => '11',
            ],
            [
                'model_number'     => 'MXB707P',
                'name'             => 'Meggyőző 66 lap/perces sebesség, kompakt méret. ',
                'price'            => '',
                'key_features'     => 'nagy teljesítmény, brutális terhelhetőség, monochrom  A4-es duplex hálózati nyomtatás, PS3, WiFi opcióval Android és iOS nyomtatás,  fillérekért nyomtathat',
                'popularity_index' => '0.9',
            ],
            [
                'model_number'     => 'MXB557P',
                'name'             => 'Meggyőző 52 lap/perces sebesség, kompakt méret. ',
                'price'            => '',
                'key_features'     => 'nagy teljesítmény, brutális terhelhetőség, monochrom  A4-es duplex hálózati nyomtatás, PS3, WiFi opcióval Android és iOS nyomtatás,  fillérekért nyomtathat',
                'popularity_index' => '0.89',
            ],
            [
                'model_number'     => 'MXB450P',
                'name'             => 'Sebesség, terhelhetőség, magas képminőség, kedvező üzemeltetés',
                'price'            => '',
                'key_features'     => '45 lap/perc, monochrom, A4, duplex, PCL, PostScript3, WiFi, USB',
                'popularity_index' => '58',
            ],
            [
                'model_number'     => 'MXB350P',
                'name'             => 'Sebesség, terhelhetőség, magas képminőség, kedvező üzemeltetés',
                'price'            => '',
                'key_features'     => '35 lap/perc, monochrom, A4, duplex, PCL, PostScript3, WiFi, USB',
                'popularity_index' => '56',
            ],
            [
                'model_number'     => 'MS521dn',
                'name'             => 'Kis méretű erőgép, kedvező nyomtatási költségekkel',
                'price'            => '62900',
                'key_features'     => 'gyors, hálózatos, jól terhelhető, monochrom duplex nyomtató',
                'popularity_index' => '55',
            ],
            [
                'model_number'     => 'MS621dn',
                'name'             => 'Meggyőző 47 lap/perces sebesség, kompakt méret. ',
                'price'            => '',
                'key_features'     => 'nagy teljesítmény, brutális terhelhetőség, monochrom  A4-es duplex hálózati nyomtatás, fillérekért nyomtathat',
                'popularity_index' => '57',
            ],
            [
                'model_number'     => 'MS711dn',
                'name'             => 'Meggyőző 55 lap/perces sebesség, kompakt méret. ',
                'price'            => '',
                'key_features'     => 'nagy teljesítmény, brutális terhelhetőség, monochrom  A4-es duplex hálózati nyomtatás, fillérekért nyomtathat',
                'popularity_index' => '59',
            ],
            [
                'model_number'     => 'MS823dn',
                'name'             => 'Meggyőző 60 lap/perces sebesség, kompakt méret. ',
                'price'            => '',
                'key_features'     => 'nagy teljesítmény, brutális terhelhetőség, monochrom  A4-es duplex hálózati nyomtatás, fillérekért nyomtathat',
                'popularity_index' => '61',
            ],
            [
                'model_number'     => 'CS622de',
                'name'             => 'Színes A4-es erőnyomtató',
                'price'            => '',
                'key_features'     => '37 lap/perc, duplex, hálózat, kedvező nyomtatási költségek',
                'popularity_index' => '60',
            ],
            [
                'model_number'     => 'MX521de',
                'name'             => 'Teljes körű megoldás, kis méretben',
                'price'            => '94900',
                'key_features'     => 'duplex monochrom nyomtatás, másolás, színes szkennelés, hálózatban, meglepően jó áron',
                'popularity_index' => '6',
            ],
            [
                'model_number'     => 'MX521ade',
                'name'             => 'Ha nem elég, hogy mindent tud, de faxra is szükség van',
                'price'            => '',
                'key_features'     => 'duplex monochrom nyomtatás, másolás, fax, színes szkennelés, hálózatban, olcsón',
                'popularity_index' => '22',
            ],
            [
                'model_number'     => 'MX522adhe',
                'name'             => 'Villámgyors nyomtatás, utánozhatatlanul olcsó üzemeltetéssel',
                'price'            => '164900',
                'key_features'     => 'A4-es, teljesen felszerelt hálózatos többfunkciós nyomtató, színes szkenner, duplex, beépített hdd-vel',
                'popularity_index' => '15',
            ],
            [
                'model_number'     => 'MX622adhe',
                'name'             => 'Fekete-fehér mindenttudó A4-es erőgép',
                'price'            => '234900',
                'key_features'     => '47 lap/perc, duplex hálózati nyomtatás, másolás, színes szkenner, nagy papírkacitás és hatalmas lcd-vezérlő panel',
                'popularity_index' => '30',
            ],
            [
                'model_number'     => 'MX722ade',
                'name'             => 'Elbír egy egész irodát. Nagy irodát!',
                'price'            => '',
                'key_features'     => 'hálózatos duplex monochrom erőgép, 66 lap/perc, villámgyors duálszkenner akár nagyteljesítményű archiváláshoz, miközben fillérekért nyomtathat',
                'popularity_index' => '52',
            ],
            [
                'model_number'     => 'CX522ade',
                'name'             => 'Színes egyéniségű, megbízható munkatárs',
                'price'            => '134900',
                'key_features'     => 'A4-es, gyors, kétoldalas színes mfp, 10,9"-os lcd kijelzővel és kedvező fenntartással',
                'popularity_index' => '10',
            ],
            [
                'model_number'     => 'CX622ade',
                'name'             => 'Színes A4-es, jól terhelhető  mindenttudó méregzsák',
                'price'            => '164900',
                'key_features'     => 'minőségi színes, hálózatos multifunkciós eszköz, villámgyors duálszkennerrel nagy lcd-kijelzővel',
                'popularity_index' => '18',
            ],
            [
                'model_number'     => 'CX725de',
                'name'             => 'Gyors színes nyomtatásra van szüksége? Jó minőségben? Válassza ezt a gépet!',
                'price'            => '',
                'key_features'     => 'A4-es színes mindenttudó mfp, gyors munkavégzés, alapkivitelben nagy papírkapacitás',
                'popularity_index' => '37',
            ],
            [
                'model_number'     => 'CX725dhe',
                'name'             => 'OCR szkennelés kell? És tudja!',
                'price'            => '',
                'key_features'     => 'színes teljes körű megoldás, hdd-vel, ocr szkenneléssel, villámgyorsan',
                'popularity_index' => '40',
            ],
        ];
        $dataSet = [];
        foreach ($dataRows as $dataRow) {
            $printer = Printer::findByModelNumber($dataRow['model_number']);
            if (!is_null($printer)) {
                $dataSet[] = [
                    'id'               => $printer->id,
                    'name'             => (strlen($dataRow['name']) > 0) ? $dataRow['name'] : null,
                    'price'            => (strlen($dataRow['price']) > 0) ? (int)$dataRow['price'] : null,
                    'popularity_index' => (strlen($dataRow['popularity_index']) > 0)
                        ? (float)$dataRow['popularity_index']
                        : null,
                    'key_features'     => (strlen($dataRow['key_features']) > 0)
                        ? $dataRow['key_features']
                        : null,
                ];
            }
        }

        return $dataSet;
    }


}
