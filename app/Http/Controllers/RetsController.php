<?php

namespace App\Http\Controllers;
use App\Models\Property;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RetsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::check()) {
            if (Auth()->user()->usertype == 'Admin') {
                return back();
            }
        }
        // $properties = DB::table('properties')->get();
        // foreach($properties as $key => $item){
        // $property = new Property;
        // $property->name = $item->full_address;
        // $property->latitude = $item->lat;
        // $property->longitude = $item->lng;
        // $property->save();
        // }
        // exit;
        date_default_timezone_set('America/New_York');
        require_once base_path() . '/vendor/vendorrets/autoload.php';
        $config = new \PHRETS\Configuration();
        $config->setLoginUrl('http://retsau.torontomls.net:6103/rets-treb3pv/server/login')->setUsername('EV23maa')->setPassword('K3$a971')->setRetsVersion('1.5');
        // $config->setLoginUrl('http://rets.torontomls.net:6103/rets-treb3pv/server/login')
        // ->setUsername('D23maa')
        // ->setPassword('T3$q194')
        // ->setRetsVersion('1.7');
        $rets = new \PHRETS\Session($config);
        $connect = $rets->Login();

        /*
  $search_ml_num = '(Ml_num=N7294526)';
  $search = $rets->Search("HISTORY","ResidentialProperty","(".$search_ml_num.")");
  echo "<pre>";print_r($search);echo "</pre>";exit;
  
  $classes = $rets->GetClassesMetadata('Property');
  // var_dump($classes->first());
  echo "<pre>";print_r($classes->first());echo "</pre>";exit;
  
  
  $objects = $rets->GetObject('Property', 'Photo', '00-1669', '*', 1);
  echo "<pre>";print_r($objects->toArray());echo "</pre>";exit;
  
*/

        // $system = $rets->GetSystemMetadata();
        // echo "Server Name: " . $system->getSystemDescription();
        // $timestamp_field = 'Timestamp_sql';
        //$timestamp_field = 'Ml_num';
        // $ml_num_value = 'N7294526';
        // $property_classes = ['ResidentialProperty'];
        // $property_classes = ['CommercialProperty'];

        // echo "<pre>";
        $search_last_status = '(Lsc=Pc),(Timestamp_sql=2024-01-04T00:00:00-2024-01-04T23:59:59)';
        $search_listed_date = '(Ld=2024-01-25+)';
        $search_Timestamp_date = '(Timestamp_sql=2024-01-04T00:00:00-2024-01-04T23:59:59)';
        $search_ml_num = '(Ml_num=N7294526)';
        // $search = $rets->Search("Property","ResidentialProperty","*"); //
        // $search = $rets->Search("Property","ResidentialProperty","(Status=A)");
        // $search = $rets->Search("Property","ResidentialProperty","(".$search_last_status.")");
        $search = $rets->Search('Property', 'ResidentialProperty', '(' . $search_listed_date . ')');
        // $search = $rets->Search("Property","ResidentialProperty","(".$search_Timestamp_date.")");
        // $search = $rets->Search("Property","ResidentialProperty","(".$search_ml_num.")");
        // echo count($search);exit;
        $results = $search->toArray();
        echo '<pre>';
        print_r($results);
        echo '</pre>';
        exit();
        $insert_array = [];
        $count_insert = 0;
        foreach ($results as $key => $items) {
            // $items = $item->toArray();

            // echo "<pre>";print_r($items);echo "</pre>";exit;
            $insert_array[$count_insert]['properties'] = json_encode($items);
            $insert_array[$count_insert]['Ml_num'] = $items['Ml_num'] != '' ? $items['Ml_num'] : '';
            $insert_array[$count_insert]['Pr_lsc'] = $items['Pr_lsc'] != '' ? $items['Pr_lsc'] : '';
            $insert_array[$count_insert]['Lsc'] = $items['Lsc'] != '' ? $items['Lsc'] : '';
            $insert_array[$count_insert]['Status'] = $items['Status'] != '' ? $items['Status'] : '';
            $insert_array[$count_insert]['Lp_dol'] = $items['Lp_dol'] != '' ? $items['Lp_dol'] : '0';
            $insert_array[$count_insert]['Orig_dol'] = $items['Orig_dol'] != '' ? $items['Orig_dol'] : '0';
            $insert_array[$count_insert]['Sp_dol'] = $items['Sp_dol'] != '' ? $items['Sp_dol'] : '0';
            $insert_array[$count_insert]['Input_date'] = $items['Input_date'] != '' ? \date('Y-m-d H:i:s', strtotime($items['Input_date'])) : null;
            $insert_array[$count_insert]['Ld'] = $items['Ld'] != '' ? \date('Y-m-d H:i:s', strtotime($items['Ld'])) : null;
            $insert_array[$count_insert]['Poss_date'] = $items['Poss_date'] != '' ? \date('Y-m-d H:i:s', strtotime($items['Poss_date'])) : null;
            $insert_array[$count_insert]['Timestamp_sql'] = $items['Timestamp_sql'] != '' ? \date('Y-m-d H:i:s', strtotime($items['Timestamp_sql'])) : null;
            $insert_array[$count_insert]['Cd'] = $items['Cd'] != '' ? \date('Y-m-d H:i:s', strtotime($items['Cd'])) : null;
            $insert_array[$count_insert]['Xd'] = $items['Xd'] != '' ? \date('Y-m-d H:i:s', strtotime($items['Xd'])) : null;
            $insert_array[$count_insert]['Xdtd'] = $items['Xdtd'] != '' ? \date('Y-m-d H:i:s', strtotime($items['Xdtd'])) : null;
            $insert_array[$count_insert]['Unavail_dt'] = $items['Unavail_dt'] != '' ? \date('Y-m-d H:i:s', strtotime($items['Unavail_dt'])) : null;
            $insert_array[$count_insert]['created_at'] = \date('Y-m-d H:i:s');
            $insert_array[$count_insert]['updated_at'] = \date('Y-m-d H:i:s');
            // echo "<pre>";print_r($insert_array);echo "</pre>";exit;
            if (count($insert_array) == 100) {
                DB::table('props')->insert($insert_array);
                $insert_array = [];
                $count_insert = 0;
                // exit;
            } else {
                $count_insert++;
            }
            // echo "<pre>";print_r($items);echo "</pre>";exit;
        }
        DB::table('props')->insert($insert_array);
    }
    public function get_properties()
    {
        if (Auth::check()) {
            if (Auth()->user()->usertype == 'Admin') {
                return back();
            }
        }
        exit();
        $map_key = 'AIzaSyDfwn9g2vfCGPeoia11CZDFTc9PDs6FXNU';
        // $address = '62 hillholm road, ontario, m5p 1m5';
        // $address = str_replace(" ", "+", $address);
        // $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=".$address."&sensor=false&key=".$key);
        // $json = json_decode($json);
        // echo "<pre>";print_r($json->results[0]->address_components);echo "</pre>";//exit;
        // echo "<pre>";print_r($json->results[0]->formatted_address);echo "</pre>";//exit;
        // echo "<pre>";print_r($json->results[0]->geometry->location->lat);echo "</pre>";//exit;
        // echo "<pre>";print_r($json->results[0]->geometry->location->lng);echo "</pre>";//exit;
        // echo "<pre>";print_r($json->results[0]->place_id);echo "</pre>";//exit;
        // echo "<pre>";print_r($json);echo "</pre>";exit;
        // $properties = DB::table('properties')->get();
        // foreach($properties as $key => $item){
        // $address_value_array = [];
        // $property = json_decode($item->properties);
        // $address_value_array['listed_price'] = $property->Lp_dol;
        // $address_value_array['listed_date'] = \date('Y-m-d H:i:s',strtotime($property->Input_date));
        // $address_value_array['residence_type'] = $property->S_r;
        // $address_value_array['bed'] = ($property->Br != '')?$property->Br:0;
        // $address_value_array['bed_extra'] = ($property->Br_plus != '')?$property->Br_plus:0;
        // $address_value_array['bath'] = ($property->Bath_tot != '')?$property->Bath_tot:0;
        // $address_value_array['garage'] = ($property->Gar_spaces != '' && $property->Gar_spaces > 0)?intval($property->Gar_spaces):0;
        // $address_value_array['residance_family_type'] = $property->S_r;
        // DB::table('properties')->where('id',$item->id)->update($address_value_array);
        // }
        // exit;

        $address_array = ['street_number', 'route', 'political', 'locality', 'administrative_area_level_3', 'administrative_area_level_2', 'administrative_area_level_1', 'country', 'postal_code'];
        $properties = DB::table('properties')->get();
        foreach ($properties as $key => $item) {
            $address_value_array = [];
            for ($i = 0; $i <= 8; $i++) {
                $col_name = $address_array[$i];
                $address_value_array[$col_name] = '';
            }
            // echo "<pre>";print_r($address_value_array);echo "</pre>";exit;
            $property = json_decode($item->properties);
            $address = '';
            if ($property->Addr != '') {
                $address .= $property->Addr;
            }
            if ($property->Area != '') {
                if ($address != '') {
                    $address .= ', ';
                }
                $address .= $property->Area;
            }
            if ($property->County != '') {
                if ($address != '') {
                    $address .= ', ';
                }
                $address .= $property->County;
            }
            if ($property->Zip != '') {
                if ($address != '') {
                    $address .= ', ';
                }
                $address .= $property->Zip;
            }
            // echo "<pre>";print_r($address);echo "</pre>";exit;
            // $address = '62 hillholm road, ontario, m5p 1m5';
            $address = str_replace(' ', '+', $address);
            $json = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $address . '&sensor=false&key=' . $map_key);
            $json = json_decode($json);
            // echo "<pre>";print_r($json);echo "</pre>";exit;
            if (isset($json->status) && $json->status == 'OK') {
                $Ml_num = $property->Ml_num;
                $place_id = $json->results[0]->place_id;
                $full_address = $json->results[0]->formatted_address;
                $lat = $json->results[0]->geometry->location->lat;
                $lng = $json->results[0]->geometry->location->lng;
                $address_value_array['Ml_num'] = $Ml_num;
                $address_value_array['listed_price'] = $property->Lp_dol;
                $address_value_array['listed_date'] = \date('Y-m-d H:i:s', strtotime($property->Input_date));
                $address_value_array['residence_type'] = $property->S_r;
                $address_value_array['bed'] = $property->Br != '' ? $property->Br : 0;
                $address_value_array['bed_extra'] = $property->Br_plus != '' ? $property->Br_plus : 0;
                $address_value_array['bath'] = $property->Bath_tot != '' ? $property->Bath_tot : 0;
                $address_value_array['garage'] = $property->Gar_spaces != '' && $property->Gar_spaces > 0 ? int($property->Gar_spaces) : 0;
                $address_value_array['residance_family_type'] = $property->S_r;
                $address_value_array['place_id'] = $place_id;
                $address_value_array['latitude'] = $lat;
                $address_value_array['longitude'] = $lng;
                $address_value_array['full_address'] = $full_address;
                $address_value_array['name'] = $full_address;
                foreach ($address_array as $aakey => $aaitem) {
                    foreach ($json->results[0]->address_components as $ackey => $acitem) {
                        // echo "<pre>";print_r($aaitem);echo "</pre>";//exit;
                        // echo "<pre>";print_r($acitem);echo "</pre>";exit;
                        if (isset($acitem->types) && $acitem->types[0] == $aaitem) {
                            if (isset($acitem->long_name)) {
                                $address_value_array[$aaitem] = $acitem->long_name;
                            } else {
                                $address_value_array[$aaitem] = $acitem->short_name;
                            }
                            // echo "<pre>";print_r($address_value_array);echo "</pre>";exit;
                            break;
                        }
                    }
                }
                DB::table('properties')
                    ->where('id', $item->id)
                    ->update($address_value_array);
            }
            // echo "<pre>";print_r($address_value_array);echo "</pre>";//exit;
            // echo "<pre>";print_r($address_value_array);echo "</pre>";exit;
        }
    }
    public function properties_value()
    {
		if (Auth::check()) {
            if (Auth()->user()->usertype == 'Admin') {
                return back();
            }
        }
        $all_properties = DB::table('properties')->get();
        $table1Start = 'A_c';
        $table1Limit = 'Num_kit';
        $table2Start = 'Occ';
        $table2Limit = 'Rm5_dc1_out';
        $table3Start = 'Rm5_dc2_out';
        // $table1 = 'Rm5_dc1_out';
        foreach ($all_properties as $key => $item) {
            $json_property = json_decode($item->properties);
            $table1Data = $table2Data = $table3Data = ['property_id' => $item->id, 'Ml_num' => $item->Ml_num];
            $table1Insert = $table2Insert = $table3Insert = false;
            foreach ($json_property as $property_key => $property_value) {
                if ($property_key == $table1Start) {
                    $table1Insert = true;
                }
                if ($property_key == $table2Start) {
                    $table2Insert = true;
                }
                if ($property_key == $table3Start) {
                    $table3Insert = true;
                }
                if ($table1Insert) {
                    $table1Data[$property_key] = $property_value;
                }
                if ($table2Insert) {
                    $table2Data[$property_key] = $property_value;
                }
                if ($table3Insert) {
                    $table3Data[$property_key] = $property_value;
                }
                if ($property_key == $table1Limit) {
                    $table1Insert = false;
                }
                if ($property_key == $table2Limit) {
                    $table2Insert = false;
                }
            }
            // echo "<pre>";print_r($table1Data);echo "</pre>";
            // echo "<pre>";print_r($table2Data);echo "</pre>";
            // echo "<pre>";print_r($table3Data);echo "</pre>";
            // exit;
            $ifDetail1Exsists = DB::table('property_details')
                ->where('property_id', $item->id)
                ->where('Ml_num', $item->Ml_num)
                ->count();
            $ifDetail2Exsists = DB::table('property_details2')
                ->where('property_id', $item->id)
                ->where('Ml_num', $item->Ml_num)
                ->count();
            $ifDetail3Exsists = DB::table('property_details3')
                ->where('property_id', $item->id)
                ->where('Ml_num', $item->Ml_num)
                ->count();
            if ($ifDetail1Exsists == 0) {
                DB::table('property_details')->insert($table1Data);
            } else {
                DB::table('property_details')->update($table1Data);
            }
            if ($ifDetail2Exsists == 0) {
                DB::table('property_details2')->insert($table2Data);
            } else {
                DB::table('property_details2')->update($table2Data);
            }
            if ($ifDetail3Exsists == 0) {
                DB::table('property_details3')->insert($table3Data);
            } else {
                DB::table('property_details3')->update($table3Data);
            }
        }
    }
    public function property_images()
    {
		if (Auth::check()) {
            if (Auth()->user()->usertype == 'Admin') {
                return back();
            }
        }
        date_default_timezone_set('America/New_York');
        require_once base_path() . '/vendor/vendorrets/autoload.php';
        $config = new \PHRETS\Configuration();
        $config->setLoginUrl('http://3pv.torontomls.net:6103/rets-treb3pv/server/login')->setUsername('Pt023maa')->setPassword('V6$e321')->setRetsVersion('1.5');
        $rets = new \PHRETS\Session($config);
        $properties = DB::table('properties')->select('id', 'Ml_num')->where('images', 0)->limit(5)->get();
        $rets_resource = 'Property';
        $object_type = 'Photo';
        // $object_keys = 'C6107976';
        $connect = $rets->Login();
        $mainPath = public_path('uploads/properties');
        foreach ($properties as $key => $item) {
            // echo "<pre>";print_r($item);echo "</pre>";exit;
            $image_array = [];
            $Ml_num = $item->Ml_num;
            $objects = $rets->GetObject($rets_resource, $object_type, $Ml_num);
            foreach ($objects as $okey => $object) {
                // echo "<pre>";print_r($object->getObjectId());echo "</pre>";exit;
                $mimeType = $object->getContentType();
                $folderPath = $mainPath . '/' . $Ml_num;
                if ($mimeType == 'image/jpeg') {
                    $ext = '.jpg';
                } else {
                    $ext = '.png';
                }
                $fileName = $Ml_num . '-' . $object->getObjectId() . $ext;
                if (!file_exists($folderPath) || !is_dir($folderPath)) {
                    mkdir($folderPath);
                }
                if (file_put_contents($folderPath . '/' . $fileName, $object->getContent())) {
                    $image_array[] = [
                        'property_id' => $item->id,
                        'Ml_num' => $item->Ml_num,
                        'image' => $fileName,
                        'created_at' => \date('Y-m-d H:i:s'),
                    ];
                }
            }
            DB::table('property_images')->insert($image_array);
            DB::table('properties')
                ->where('id', $item->id)
                ->update(['images' => 1]);
        }
    }
}
