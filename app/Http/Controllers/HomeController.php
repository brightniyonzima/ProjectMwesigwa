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
            $pneumonia_factors_sheet = Excel::selectSheets('Factors')->load($RealPath,function($reader) {
            })->get();
            foreach ($pneumonia_factors_sheet as $factor) {
                $factors_array = $factor->toArray();
                $factors_values = array_values($factors_array);

                $new_factor_record = new PneumoniaFactor;
                $district = District::where(['name' => ucwords($factors_values[0])])->first();
                $district_id = is_object($district) ? $district->id : null;
                $new_factor_record->district_id = $district_id;
                $age_group =  $factors_values[2];
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
                $new_factor_record->age_group = $age_group;
                $new_factor_record->month_of_admission = $factors_values[1];
                $gender = null;
                if ($factors_values[3] == 'Male') {
                    $gender = 0;
                } 
                elseif ($factors_values[3] == 'Female') {
                    $gender = 1;
                } 
                $new_factor_record->gender = $gender;
                $education = 0;
                if ($factors_values[4] == 'O Level') {
                    $education = 2;
                } 
                elseif ($factors_values[4] == 'A Level') {
                    $education = 1;
                }
                $new_factor_record->level_of_education = $education;
                $breast_feeding = 0;
                if ($factors_values[5] == 'No') {
                    $breast_feeding = 5;
                } 
                elseif ($factors_values[5] == 'Yes') {
                    $breast_feeding = 2;
                }
                $new_factor_record->breast_feeding = $breast_feeding;
                $weight_for_height = 0;
                if ($factors_values[6] == 'Malnourished') {
                    $weight_for_height = 5;
                } 
                elseif ($factors_values[6] == 'Nourished') {
                    $weight_for_height = 2;
                }
                $new_factor_record->weight_for_height = $weight_for_height;
                $nutrition_status = 0;
                if ($factors_values[7] == 'Good') {
                    $nutrition_status = 1;
                } 
                elseif ($factors_values[7] == 'Moderate') {
                    $nutrition_status = 3;
                }
                elseif ($factors_values[7] == 'Severe') {
                    $nutrition_status =  5;
                }
                $new_factor_record->nutrition_status = $nutrition_status;
                $hiv_status = 0;
                if ($factors_values[8] == 'Unknown') {
                    $hiv_status = 1;
                } 
                elseif ($factors_values[8] == 'NEGATIVE') {
                    $hiv_status = 3;
                }
                elseif ($factors_values[8] == 'POSITIVE') {
                    $hiv_status =  5;
                }
                $new_factor_record->HIV_status = $hiv_status;
                $congestion = 0;
                if ($factors_values[9] == 'N/A') {
                    $congestion = 0;
                } 
                elseif ($factors_values[9] == 'N') {
                    $congestion = 3;
                }
                elseif ($factors_values[9] == 'Y') {
                    $congestion =  5;
                }
                $new_factor_record->congestion = $congestion;
                $immusation_status = 0;
                if ($factors_values[10] == 'Y') {
                    $immusation_status = 1;
                } 
                elseif ($factors_values[10] == 'N') {
                    $immusation_status = 4;
                }
                $new_factor_record->immusation_status = $immusation_status;
                $smokers = 0;
                if ($factors_values[10] == 'Y') {
                    $smokers = 5;
                } 
                elseif ($factors_values[10] == 'N') {
                    $smokers = 1;
                }
                $new_factor_record->family_cigaratte_smoker = $smokers;
                $new_factor_record->save();
            }
        }
        //Alert::success('Your template saw successcully uploaded');
        return redirect('/home');
    }
}
