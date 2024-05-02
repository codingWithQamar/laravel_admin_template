<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Location;
use App\Models\Property;

class LocationController extends Controller
{
    public function saveCoordinates(Request $request)
    {
        if (Auth::check()) {
            if (Auth()->user()->usertype == 'Admin') {
                return back();
            }
        }
        if ($user = Auth::user()) {
            $coordinates = $request->input('coordinates'); // Assuming you pass coordinates in the request
            // Save coordinates for the user
            $location = new Location();
            $location->user_id = $user->id;
            $location->title = $request->area_name;
            $location->coordinates = json_encode($coordinates);
            if ($location->save()) {
                return response()->json(['status' => true, 'message' => 'Watch area saved successfully']);
            } else {
                return response()->json(['status' => false, 'message' => 'Something went wrong']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Please login to continue']);
        }
    }
    public function watched_area_summary(Request $request)
    {
        if ($user = Auth::user()) {
            if (Auth::check()) {
                if (Auth()->user()->usertype == 'Admin') {
                    $viewData = [
                        'pageName' => 'Login',
                    ];
                    return view('user.Auth.login')->with($viewData);
                }
            }
            $locations = $user->locations;
            // dd($locations);
            $userId = $user->id;
            $locations = DB::table('locations')->where('user_id', $userId)->get();
            //  dd($locations);
            $locations = DB::table('locations')->get();
            // Decode JSON coordinates
            foreach ($locations as $polygon) {
                $polygon->coordinates = json_decode(str_replace('[[', '[', str_replace(']]', ']', $polygon->coordinates)), true);
            }
            $viewData = [
                'pageName' => 'Homepage',
                'locations' => $locations,
            ];
            return view('user.user_watch_area')->with($viewData);
        } else {
            $viewData = [
                'pageName' => 'Login',
            ];
            return view('user.Auth.login')->with($viewData);
        }

        //dd($locations);
    }
    public function watched_area_summary_detail(Request $request, $watch_area_id = null)
    {
        //         SELECT *, latlngpoint FROM properties WHERE ST_Contains( ST_GeomFromText('POLYGON((44.456329575747 -78.467102050781, 44.475930960751 -77.706298828125, 43.98787438232 -77.772216796875, 43.972063240998 -78.294067382812, 44.456329575747 -78.467102050781))', 4326), latlngpoint );

        // $properties = DB::select('SELECT id, name, latitude, longitude FROM properties');
        // // echo "<pre>";print_r($properties);echo "</pre>";exit;
        // foreach($properties as $key => $item){
        //  $property = Property::find($item->id);
        //  // $property->latlngpoint = DB::raw("(ST_GeometryFromText('POINT(". $item->latitude ." ". $item->longitude .")', 4326))");
        //  $property->latlngpoint = DB::raw("ST_GeometryFromText('POINT(".$item->latitude." ".$item->longitude.")', 4326)");
        //  // $property->latlngpoint = DB::raw("POINT(". $item->latitude ." ". $item->longitude .")");
        //  $property->save();
        // }
        // exit;

        if (Auth::check()) {
            if (Auth()->user()->usertype == 'Admin') {
                return back();
            }
        }
        if ($user = Auth::user()) {
            if ($watch_area_id != null && $watch_area_id > 0) {
                $locationData = Location::find($watch_area_id);
                if (!empty($locationData)) {
                    $locationData->coordinates = json_decode(str_replace('[[', '[', str_replace(']]', ']', $locationData->coordinates)), true);
                    $radius = 1000;
                    $userLocations = json_decode($locationData->coordinates, true);
                    // echo "<pre>";print_r($userLocations);echo "</pre>";exit;
                    $center = [];
                    $all_lat = [];
                    $all_lng = [];
                    $new_coordinates = [];
                    foreach ($userLocations as $lkey => $litem) {
                        $all_lat[] = $litem['lat'];
                        $all_lng[] = $litem['lng'];
                        $new_coordinates[] = $litem['lat'] . ' ' . $litem['lng'];
                    }
                    if (count($userLocations) > 0) {
                        $center['lat'] = array_sum($all_lat) / count($userLocations);
                        $center['lng'] = array_sum($all_lng) / count($userLocations);
                    } else {
                        $center['lat'] = '51.9467508';
                        $center['lng'] = '-84.6544609';
                    }
                    $new_coordinates[] = $userLocations[0]['lat'] . ' ' . $userLocations[0]['lng'];
                    $new_coordinates = implode(', ', $new_coordinates);
                    // echo "<pre>";print_r($new_coordinates);echo "</pre>";exit;
                    $PropertiesInsidePolygon = DB::select(
                        DB::raw(
                            "SELECT id, Ml_num, name, listed_price, listed_date, residence_type, bed, bed_extra, bath, garage, residance_family_type, place_id, full_address, latitude, longitude FROM properties
     WHERE ST_Contains(
     ST_GeomFromText('POLYGON((" .
                                $new_coordinates .
                                "))', 4326), latlngpoint )",
                        ),
                    );
                    // echo "<pre>";print_r($PropertiesInsidePolygon);echo "</pre>";exit;
                    $viewData = [
                        'pageName' => 'Homepage',
                        'location' => $locationData,
                        'nearbyProperties' => $PropertiesInsidePolygon,
                        'center' => $center,
                    ];
                    return view('user.user_watch_area_detail')->with($viewData);
                } else {
                }
            } else {
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Please login to continue']);
        }
    }
}
