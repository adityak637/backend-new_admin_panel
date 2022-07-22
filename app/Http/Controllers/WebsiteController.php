<?php

namespace App\Http\Controllers;

use App\Models\CreateTravel;
use App\Models\Createtrip;
use App\Utils\Facades\Helpers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {

        $validator = Validator::make($request->all(), [
            'locations' => 'required_without:traveller_name',
            'traveller_name' => 'required_without:locations',
        ]);

        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }

        $dates = $request->date;
        $locations = $request->locations;
        $traveller_name = $request->traveller_name;

        $trips = Createtrip::where('status', 4)
            ->when($dates, function ($trip) use($dates) {
                $trip->whereDate('start_date', Helpers::dateFormat($dates));
            })
            ->when($locations, function ($trip) use($locations) {
                //            $trip->where('desination_name', "LIKE", "%$locations%");
                $trip->where('id', "$locations");
            })
            ->when($traveller_name, function ($trip) use($traveller_name) {
                /*$trips->whereHas('user', function ($query) use ($traveller_name) {
                $query->where('First_Name', 'like', "%$traveller_name%");
            });*/
                $trip->whereTravellerId($traveller_name);
            });

            $Createtrip = $trips->paginate(10);

        return response()->json(['code' => 200, 'Createtrip' => $Createtrip, 'locations' => $locations]);

    }

    public function triplist($id)
    {

        if (!empty($id) && is_numeric($id)) {
            $trips = Createtrip::where('traveller_id', $id)->where('status', 4)->paginate(10);
            return response()->json(['code' => 200, 'trips' => $trips]);
        }

        return response()->json(['code' => 403, 'Createtrip' => "No Traveller Found"]);

    }

    public function hotlocation()
    {
        $trips = Createtrip::where('hotlocation', 1)->where('status', 4)->get();
        return response()->json(['code' => 200, 'trips' => $trips]);
    }

    public function randomtrip()
    {
        $trips = Createtrip::where('status', 4)->inRandomOrder()->limit(10)->get();
        return response()->json(['code' => 200, 'trips' => $trips]);
    }

    public function get_search_items(Request $request)
    {
        $locations = Createtrip::select('desination_name as label', 'id as value')->where('status', 4)->get();
        $traveller_names = CreateTravel::where('status', 1)->get();
        foreach($traveller_names as $traveller_name) {
            $formattedTravallerData[] = [
                'value' => $traveller_name->id,
                'label' => $traveller_name->First_Name . " " . $traveller_name->Last_Name 
            ];
        }

        return response()->json(['code' => 200, 'locations' => $locations, 'traveller_name' => $formattedTravallerData]);
    }

}
