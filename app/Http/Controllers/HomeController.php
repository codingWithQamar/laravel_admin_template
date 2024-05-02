<?php

namespace App\Http\Controllers;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{

    public function __construct(){
        // $this->middleware('auth');
    }

    public function index(){
		if (Auth::check()) {
            if (Auth()->user()->usertype == 'Admin') {
                return back();
            }
        }
		$pp = DB::table('properties')->first();
		// echo "<pre>";print_r(json_decode($pp->properties));echo "</pre>";exit;
        $properties = Property::all();
		$viewData = [
			'pageName' => 'Homepage',
			'properties' => $properties,
		];
        return view('user.home')->with($viewData);
    }
    public function property_detail(Request $request, $Ml_num = NULL){
		if (Auth::check()) {
            if (Auth()->user()->usertype == 'Admin') {
                return back();
            }
        }
		// $propertyData = Property::get()->toArray();
		// echo "<pre>";print_r($propertyData);echo "</pre>";exit;
		// foreach($propertyData as $key => $item){
			// $propertyData[$key]['p1'] = DB::table('property_details')->where('property_id',$item['id'])->first();
			// $propertyData[$key]['p2'] = DB::table('property_details2')->where('property_id',$item['id'])->first();
			// $propertyData[$key]['p3'] = DB::table('property_details3')->where('property_id',$item['id'])->first();
		// }
		// echo "<pre>";print_r($propertyData);echo "</pre>";exit;
		if($Ml_num != NULL){
			$propertyData = Property::where('Ml_num',$Ml_num)->first();
			// $propertyDatax = $propertyData->toArray();
			// echo "<pre>";print_r($propertyDatax);echo "</pre>";exit;
			if(!empty($propertyData)){
				$property_id = $propertyData->id;
				$propertyData1 = DB::table('property_details')->where('property_id',$property_id)->first();
				// echo "<pre>";print_r($propertyData1);echo "</pre>";exit;
				$propertyData2 = DB::table('property_details2')->where('property_id',$property_id)->first();
				$propertyData3 = DB::table('property_details3')->where('property_id',$property_id)->first();
				$propertyDatax = $propertyData->toArray();
				unset($propertyDatax['latlngpoint']);
				// $propertyData1x = (array) $propertyData1;
				// $propertyData2x = (array) $propertyData2;
				// $propertyData3x = (array) $propertyData3;
				$propertyDatax = array_merge($propertyDatax, (array) $propertyData1);
				$propertyDatax = array_merge($propertyDatax, (array) $propertyData2);
				$propertyDatax = array_merge($propertyDatax, (array) $propertyData3);
				// echo "<pre>";print_r($propertyDatax);echo "</pre>";exit;

				if($property_id != '' && $property_id > 0){
					$viewData = [
						'pageName' => 'Property Detail',
						'property' => json_decode(json_encode($propertyDatax)),
					];
					return view('user.property_detail')->with($viewData);
				}else{

				}
			}else{

			}
		}else{

		}
    }
	public function home1(){
		if (Auth::check()) {
            if (Auth()->user()->usertype == 'Admin') {
                return back();
            }
        }
		$pp = DB::table('properties')->get();
		// foreach($pp as $key => $p){
			// echo "<pre>";print_r(json_decode($p->properties));echo "</pre>";
		// }
		// exit;
		// echo "<pre>";print_r($pp);echo "</pre>";exit;
        $properties = Property::select('id','Ml_num','name','listed_price','listed_date','residence_type','bed','bed_extra','bath','garage','residance_family_type','place_id','full_address','latitude','longitude')->get()->toArray();
		// echo "<pre>";print_r($properties);echo "</pre>";exit;
		$viewData = [
			'pageName' => 'Homepage',
			'properties' => json_encode($properties),
		];
        return view('user.home')->with($viewData);
    }
}
