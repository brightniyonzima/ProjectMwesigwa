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
        $demographics = ['1'=>'General Prevelance Prediction','2'=>'Short term prediction (2020)','3'=>'Long term predition (2025)'];
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
        $seasons_array = ['2014','2015','2016','2020','2025'];
        $predictions_array = [30.8,33.8,35.4,44.9,56.4];
        return view('predictions.general_charts',compact('seasons_array','predictions_array'));
    }

    public function multi_factor_graph()
    {
        $seasons_array = [];
        $predictions_array = [];
        $seasons_array = ['2014','2015','2016'];
        $predictions_array = [];
        return view('predictions.multi_factor_graph',compact('seasons_array','predictions_array'));
    }
}
