<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Demographic;
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
            $pneumonia_factors_sheet = Excel::selectSheets('Factors')->load($RealPath,function($reader) {
              })->get();
            foreach ($pneumonia_factors_sheet as $factor) {
                $factors_array = $factor->toArray();
                dd($factors_array);
                $new_factor_record = new PneumoniaFactor;
                $new_factor_record->district_id = $factor[0];//
                $age_group =  $factor[2];
                /* 1 -> 0-20 months,2 -> 21-40 months,3 -> 22-60 months*/
                if ($age_group > 1 && $age_group <= 20) {
                    $age_group = 1;
                } 
                elseif ($age_group > 11 && $age_group <= 40) {
                    $age_group = 2;
                } 
                elseif ($age_group > 41 && $age_group <= 60){
                    $age_group = 3;
                }
                
                /*$new_factor_record->age_group = $factor[];
                $new_factor_record->month_of_admission = $factor[];
                $new_factor_record->gender = $factor[];
                $new_factor_record->level_of_education = $factor[];
                $new_factor_record->breast_feeding = $factor[];
                $new_factor_record->weight_for_height = $factor[];
                $new_factor_record->nutrition_status = $factor[];
                $new_factor_record->HIV_status = $factor[];
                $new_factor_record->congestion = $factor[];
                $new_factor_record->immusation_status = $factor[];
                $new_factor_record->family_cigaratte_smoker = $factor[];
                $new_factor_record->save();*/
            }
        }
    }
}
