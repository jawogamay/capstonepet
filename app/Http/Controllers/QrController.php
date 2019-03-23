<?php

namespace App\Http\Controllers;

use App\Qr;
use Illuminate\Http\Request;

class QrController extends Controller
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
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reference = str_random();
        return Qr::create([
            'reservation_id' => $request['transaction'],
            'reference' => $reference
        ]);
    }
    public function getQr(){
        return Qr::latest()->with('reservation')->paginate(5);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Qr  $qr
     * @return \Illuminate\Http\Response
     */
    public function show(Qr $qr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Qr  $qr
     * @return \Illuminate\Http\Response
     */
    public function edit(Qr $qr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Qr  $qr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Qr $qr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Qr  $qr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Qr $qr)
    {
        //
    }
}
