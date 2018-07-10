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
            $excfile = new Excel;
            $RealPath = $file->getRealPath();
            $pneumonia_factors = Excel::load($RealPath, function($reader) {
            })->get();
            dd($ext);
            foreach ($pneumonia_factors as $factor) {
                $factors_array = $factor->toArray();
                dd($factor);
                $new_factor_record = new PneumoniaFactor;
                $new_factor_record->hiv_status = $factor[0];
            }
        }
    }
}
