<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PneumoniaFactor;

class DataCollectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('data_collection.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_pneumonia_infection = new PneumoniaFactor;
        $admission_day = $request->dobday;
        $admission_month = $request->dobmonth;
        $admission_year = \Carbon\Carbon::createFromFormat('Y', $request->dobyear)->toDateString(); 
        $new_pneumonia_infection->year_of_admission = $admission_year;
        $new_pneumonia_infection->age_group = $request->age;
        $new_pneumonia_infection->gender = $request->gender;
        $comorbidity_array = $request->comorbidity;
        $new_pneumonia_infection->comorbidity = $comorbidity_array[0];
        $new_pneumonia_infection->exclusive_breast_feeding = $request->exclusive_breast_feeding;
        $new_pneumonia_infection->birthweight = $request->birth_weight;
        $new_pneumonia_infection->save();
        return redirect('show_factors');
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
}
