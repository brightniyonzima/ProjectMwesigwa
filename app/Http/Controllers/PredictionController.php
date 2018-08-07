<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Demographic;
use App\District;
use App\PneumoniaFactor;
use DB;
use Excel;
//use Alert;

class PredictionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demographics = ['1'=>'General Prevelance Prediction','2'=>'Prediction based on age','3'=>'Prediction based on years'];
        return view('predictions.index',compact('demographics'));
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
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function general_graph()
    {
        /*$districts = \App\District::orderBy('name','asc')->get();
        $hospitals = [];
        $districts_array = [];
        $hospitals_score_array = [];
        foreach ($districts as $district) {
            $districts_array[] = $district->name;
            $hospital_ids_in_district = HealthUnit::where('location',$district->id)->pluck('id')->toArray();
            $hospitals_score_array[] = calculate_mulitple_hospital_points($hospital_ids_in_district);
        }*/
        $seasons_array = [];
        $predictions_array = [];
        $seasons_array = ['2014-2017','2018-2020','2021-2024','2025-2028'];
        $predictions_array = [30,50,70,60];
        return view('predictions.general_charts',compact('seasons_array','predictions_array'));
    }
}
