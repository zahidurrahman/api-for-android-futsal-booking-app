<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CourtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = array();
        $courts = DB::table('courts')->get();

        foreach ($courts as $court) {

            // check available
            if ($court->available == 1)
                $available = "Yes";
            else
                $available = "No";

            $items = array(
                'id' => $court->id,
                'type' => 1,
                'name' => $court->name,
                'image' => $court->image,
                'location' => $court->location,
                'available' => $available,
                'created_at' => $court->created_at,
                'updated_at' => $court->updated_at,
            );
            array_push($results, $items);

        }

        $response = [
            'success' => true,
            'message' => 'Courts retrieved successfully.',
            'results' => $results
        ];

        return response()->json($response, 200);
    }
}
