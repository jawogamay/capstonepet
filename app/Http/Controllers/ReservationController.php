<?php

namespace App\Http\Controllers;
use App\Notifications\TransactionCreatedSMS;
use App\Reservation;
use Notification;
use Illuminate\Http\Request;
use Nexmo;
use Auth;
use App\User;
use App\Pet;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
       public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        if(!\Gate::allows('isAdmin') || !\Gate::allows('isAuthor')){
            if(Auth::check())
            {
                $id = Auth::user()->id;
                return User::find($id)->reservations()->latest()->paginate(5);
            }
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function getPet(){
        if (!\Gate::allows('isAdmin') || \Gate::allows('isAuthor')){
              if (Auth::check())
            {
                $user = Auth::user()->id;
                return Pet::where('user_id',$user)->get();
            }
        }
    }


    public function getAppointments(){
          if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')){
              if (Auth::check())
            {
                return Reservation::latest()->with('user')->paginate(10);
            }
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
                'petname' => 'required',
                'petage' => 'required|numeric',
                'petgender' => 'required',
                'petbreed' => 'required'
        ]);
        $user = (int)Auth::user()->id;
  
        $reserve =  Reservation::create([
            'user_id' => $user,
            'petname' => $request['petname'],
            'petage' => $request['petage'],
            'petgender' => $request['petgender'],
            'petbreed' => $request['petbreed'],
            'service' => $request['service']
        ]);

/**//* $basic  = new Nexmo\Client\Credentials\Basic('9c9350e6', '8Eo5CgibNgBHEs7K');
        $client = new Nexmo\Client($basic);
$reserve = $client->message()->send([
    'to' => '639472195796',
    'from' => 'Pet Centre Animal Clinic',
    'text' => 'New Reservation'
]);*/
    Nexmo::message()->send([
        'to'   => '639472195796',
    'from' => '639472195796',
    'text' => 'Reservation added.'
    ]); 
        return $reserve;

     


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
