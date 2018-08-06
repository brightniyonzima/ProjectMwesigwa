<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Demographic;
use App\District;
use App\PneumoniaFactor;
use DB;
use Excel;
//use Alert;

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
        $new_factor_record = new PneumoniaFactor;

        $new_demographic->age_group = $request->age_group;
        $new_demographic->selected_month = $request->pneumonia_month;
        $new_demographic->district = $request->district;

        $new_factor_record->age_group = $request->age_group;
        $new_factor_record->month_of_admission = $request->pneumonia_month;
        $new_factor_record->district_id = $request->district;
        $new_demographic->save();
        if ($new_factor_record->save()) {
            $demographic_id = $new_factor_record->id;
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
        $id = $request->demo_id;
        $new_factor_record = PneumoniaFactor::findOrFail($id);
        $new_factor_record->gender = $request->gender;
        $new_factor_record->level_of_education = $request->weight_for_height;
        $new_factor_record->breast_feeding = $request->breast_feeding;
        $new_factor_record->weight_for_height = $request->weight_for_height;
        $new_factor_record->nutrition_status = $request->nutrition;
        $new_factor_record->HIV_status = $request->HIV_status;
        $new_factor_record->congestion = $request->congestion_at_home;
        $new_factor_record->immusation_status = $request->Immunisation;
        $new_factor_record->family_cigaratte_smoker = $request->smokers;
        if ($new_factor_record->update()) {
            //Alert::success('New record has been added');
            return redirect('/demographics');
        }
        return 'error occured. contact sys admin';
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
            $pneumonia_factors_sheet = Excel::selectSheets('Sheet1')->load($RealPath,function($reader) {
            })->get();
            foreach ($pneumonia_factors_sheet as $factor) {
                $factors_array = $factor->toArray();
                $factors_values = array_values($factors_array);

                $new_factor_record = new PneumoniaFactor;
                $new_factor_record->district_id = $factors_values[0];
                $new_factor_record->month_of_admission = $factors_values[1];
                $new_factor_record->age_in_month = $factors_values[2];
                $new_factor_record->body_mass_index = $factors_values[3];
                $new_factor_record->immusation_status = $factors_values[4];
                $new_factor_record->symptoms = $factors_values[5];
                $new_factor_record->outcome = $factors_values[6];
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
