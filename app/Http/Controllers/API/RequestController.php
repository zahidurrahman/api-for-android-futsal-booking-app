<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class RequestController extends Controller
{
    /**
     * send request
     *
     * @return \Illuminate\Http\Response
     */
    public function sendRequest(Request $request)
    {
        $requester_id = $request->input('requester_id');
        $booker_id = $request->input('booker_id');
        $booked_id = $request->input('booked_id');

        // check old record
        $old_record = DB::table('requests')->where('requester_id', $requester_id)->where('booker_id', $booker_id)->where('booked_id', $booked_id)->first();
        if ($old_record != null) {
            $response = [
                'success' => false,
                'message' => 'Your already sent request!'
            ];
        } else {
            // book new
            $id = DB::table('requests')->insertGetId([
                    'requester_id' => $request->input('requester_id'),
                    'booker_id' => $request->input('booker_id'),
                    'booked_id' => $request->input('booked_id'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );

            // send email or push notification to booker

            $response = [
                'success' => true,
                'message' => 'Request sent successfully.'
            ];
        }

        return response()->json($response, 200);
    }

    /**
     * requests
     *
     * @return \Illuminate\Http\Response
     */
    public function requests(Request $request)
    {
        $requester_id = $request->input('requester_id');
        $booker_id = $request->input('booker_id');

        // check request
        if (isset($requester_id)) {
            $type = 4;
            $requests = DB::table('requests')->where('requester_id', $requester_id)->get();
        } else if (isset($booker_id)) {
            $type = 5;
            $requests = DB::table('requests')->where('booker_id', $booker_id)->where('accept', "Pending")->get();
        } else {
            $response = [
                'success' => false,
                'message' => "Enter requester or booker id",
            ];
            return response()->json($response, 200);
        }

        // format results
        $results = array();
        foreach ($requests as $request) {

            // court booked data
            $court_book = DB::table('court_books')->where('id', $request->booked_id)->first();

            // court info
            $court = DB::table('courts')->where('id', $court_book->court_id)->first();

            // user info
            $user = DB::table('users')->where('id', $request->requester_id)->first();

            $items = array(
                'id' => $request->id,
                'type' => $type,
                'requester_id' => $request->requester_id,
                'requester_name' => $user->name,
                'booker_id' => $request->booker_id,
                'booked_id' => $request->booked_id,
                'accept' => $request->accept,
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
            $message = "Requests retrieved successfully";
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

    /**
     * request action
     *
     * @return \Illuminate\Http\Response
     */
    public function requestAction(Request $request)
    {
        $id = $request->input('id');
        $accept = $request->input('accept');

        if ($accept == "Yes")
            $status_message = "accepted";
        else
            $status_message = "denied";

        // update
        DB::table('requests')->where('id', $id)->update(['accept' => $accept]);

        // send email or push notification to requester

        $response = [
            'success' => true,
            'message' => 'Request ' . $status_message
        ];

        return response()->json($response, 200);
    }
}
