<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Court;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function add_court(Request $request)
    {
        $name=$request->input('court_name');
        $location=$request->input('location');
        $image_url=$request->input('url');

//        if($request->hasFile('cover_image')){
//            $image = $request->file('cover_image');
//            $imag_name = time().'.'.$image->getClientOriginalExtension();
//            $destinationPath = public_path('/court_images');
//            $image->move($destinationPath, $imag_name);
//        }




        $question = new Court([

            'name' => $name,
            'image' =>$image_url ,
            'location' => $location,
            'available' => '1',

        ]);
        $question->save();

        return redirect('/show_court')->with('status', 'Court has been Added');
    }
    public function destroy_court(Request $request)
    {
        $id=$request->input('id');
        DB::table('courts')->where('id',$id)->delete();
        return redirect('/show_court')->with('status', 'Court has been deleted');
    }

    public function update_court(Request $request)
    {
        $name=$request->input('court_name');
        $location=$request->input('location');
        $image_url=$request->input('url');

//        if($request->hasFile('cover_image')){
//            $image = $request->file('cover_image');
//            $imag_name = time().'.'.$image->getClientOriginalExtension();
//            $destinationPath = public_path('/court_images');
//            $image->move($destinationPath, $imag_name);
//        }
        DB::table('courts')
            ->where('id', $request->input('id'))
            ->update([
                'name' => $name,
                'location'=>$location,
                'image'=>$image_url,
            ]);
        return redirect('/show_court')->with('status', 'Court has been updated');
    }


    //-----------------------------------booking --------------------------------------
    public function destroy_booking(Request $request)
    {
        $id=$request->input('id');
        DB::table('court_books')->where('id',$id)->delete();
        return redirect('/view_booking')->with('status', 'Booking has been deleted');
    }

}
