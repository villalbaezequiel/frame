<?php

use Illuminate\Database\Seeder;
use App\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // key: name, male, female
      $list = array(
        ['Alemania',	'alemán', 'alemana'],
        ['Argentina',	'argentino', 'argentina'],
        ['Bolivia',	'boliviano', 'boliviana'],
        ['Brasil',	'brasileño', 'brasileña'],
        ['Chile',	'chileno', 'chilena'],
        ['Colombia',	'colombiano', 'colombiana'],
        ['Costa Rica',	'costarricense', 'costarricense'],
        ['Cuba',	'cubano', 'cubana'],
        ['Ecuador',	'ecuatoriano', 'ecuatoriana'],
        ['España',	'español', 'española'],
        ['Francia',	'francés', 'francesa'],
        ['México',	'mexicano', 'mexicana'],
        ['Italia',	'italiano', 'italiana'],
        ['Paraguay',	'paraguayo', 'paraguaya'],
        ['Perú',	'peruano', 'peruana'],
        ['Republica Dominicana',	'dominicano', 'dominicana'],
        ['Uruguay',	'uruguayo', 'uruguaya'],
        ['Venezuela',	'venezolano', 'venezolana'],
        ['Estados Unidos',	'estadounidense', 'estadounidense'],
      );

      foreach ($list as $value) {
        $country = new Country;
        $country->name = $value[0];
        $country->male = $value[1];
        $country->female = $value[2];
        $country->save();
      }

    }
}
