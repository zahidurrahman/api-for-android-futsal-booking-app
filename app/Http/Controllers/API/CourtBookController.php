<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CourtBookController extends Controller
{
    /**
     * book court
     *
     * @return \Illuminate\Http\Response
     */
    public function book(Request $request)
    {
        $court_id = $request->input('court_id');
        $time_slot = $request->input('time_slot');
        $the_date = $request->input('the_date');

        // check old record
        $old_record = DB::table('court_books')->where('court_id', $court_id)->where('time_slot', $time_slot)->where('the_date', $the_date)->first();
        if ($old_record != null) {
            $response = [
                'success' => false,
                'message' => 'Court already booked!'
            ];
        } else {
            // book new
            $id = DB::table('court_books')->insertGetId([
                    'user_id' => $request->input('user_id'),
                    'court_id' => $court_id,
                    'time_slot' => $time_slot,
                    'the_date' => $the_date,
                    'share_court' => $request->input('share_court'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
            $response = [
                'success' => true,
                'message' => 'Court booked successfully.'
            ];
        }

        return response()->json($response, 200);
    }

    /**
     * booking list
     *
     * @return \Illuminate\Http\Response
     */
    public function bookingList(Request $request)
    {
        $user_id = $request->input('user_id');
        $court_id = $request->input('court_id');

        // check request
        if (isset($user_id)) {
            $type = 3;
            $court_books = DB::table('court_books')->where('user_id', $user_id)->get();
        } else if (isset($court_id)) {
            $type = 2;
            $court_books = DB::table('court_books')->where('court_id', $court_id)->get();
        } else {
            $type = 2;
            $court_books = DB::table('court_books')->get();
        }

        // format results
        $results = array();
        foreach ($court_books as $court_book) {

            // court info
            $court = DB::table('courts')->where('id', $court_book->court_id)->first();

            $items = array(
                'id' => $court_book->id,
                'type' => $type,
                'user_id' => $court_book->user_id,
                'name' => $court->name,
                'image' => $court->image,
                'time_slot' => $court_book->time_slot,
                'the_date' => $court_book->the_date,
                'share_court' => $court_book->share_court,
                'created_at' => $court_book->created_at,
                'updated_at' => $court_book->updated_at,
            );
            array_push($results, $items);

        }

        if ($results != null) {
            $success = true;
            $message = "Booking List retrieved successfully";
        } else {
            $success = false;
            $message = "No record found!";
        }

        $response = [
            'success' => $success,
            'message' => $message,
            'results' => array_reverse($results)
        ];

        return response()->json($response, 200);
    }
}
