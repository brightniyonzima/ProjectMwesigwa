<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Demographic;
use App\PneumoniaFactor;
use DB;
use Excel;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function show_records()
    {
        $pneumonia_factors = PneumoniaFactor::all();
        return view('home.show',compact('pneumonia_factors'));
    }

    public function step_one_registration()
    {
        $age_groups = [''=>'-- Select Age Group --','1'=>'0-20 months','2'=>'21-40 months','3'=>'41-60 months'];
        $districts = DB::table('districts')->orderBy('name','asc')->pluck('name','id')->toArray();
        $districts = array_prepend($districts, '-- select district --', '');
        return view('home.demographics',compact('age_groups','districts'));
    }

    public function store_demographics(Request $request)
    {
        $new_demographic = new Demographic;
        $new_demographic->age_group = $request->age_group;
        $new_demographic->selected_month = $request->pneumonia_month;
        $new_demographic->district = $request->district;
        if ($new_demographic->save()) {
            $demographic_id = $new_demographic->id;
            return redirect('pneumonia-factors?dem_id='.$demographic_id);
        }
        return redirect('demographics');
    }

    public function step_two_registration()
    {
        $demographic_id = $_GET['dem_id'];
        return view('home.pneumonia_factors',compact('demographic_id'));
    }

    public function store_pneumonia_factors(Request $request)
    {
        # code...
    }

    public function process_template(Request $request)
    {
        if ($request->file('factors_template')->isValid()) {
            $file = $request->file('factors_template');
            $originalfile = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            $RealPath = $file->getRealPath();
            /*$pneumonia_factors = Excel::load($RealPath, function($reader) {
            })->get(); this works too but i prefer the selectSheets()*/
            $pneumonia_factors_sheet = Excel::selectSheets('Please yous me')->load($RealPath,function($reader) {
            })->get();

            foreach ($pneumonia_factors_sheet as $factor) {
                $factors_array = $factor->toArray();
                $factors_values = array_values($factors_array);
                
                $new_factor_record = new PneumoniaFactor;
                $new_factor_record->year_of_admission = \Carbon\Carbon::createFromFormat('Y', $factors_values[0])->toDateString(); 
                $new_factor_record->age_group = $factors_values[1];
                $new_factor_record->gender = $factors_values[2];
                $new_factor_record->comorbidity = $factors_values[3];
                $new_factor_record->exclusive_breast_feeding = $factors_values[4];
                $new_factor_record->birthweight = $factors_values[5];
                $new_factor_record->save();
            }
        }
        //Alert::success('Your template saw successcully uploaded');
        return redirect('/show_factors');
    }

    public function prediction_algorithm()
    {
        //1.get number of records per year.
        //2.get the average increasing or decreasing rate sequence
        //3.use the sequence to predict the prevelance

    }
}
