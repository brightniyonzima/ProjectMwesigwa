<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

function predict($base_year,$current_year)
{
	/*
	rate_of_change = (1 / time_in_years) * exponential * (change_in_no_of_pneumonia_cases_btn_current_year_and_base_year/no_patient_in_base_year)

	//the determined constants are rate_of_change = 0.0795, exponential = 2.7183

	Table indicating prediction for 2017
	Base Year	Time (t)	N17
	2014	    3	        1466
	2015	    2	        1513
	2016	    1	        1466

	Base year 2016	 Time (t)	 Predicted statistics
	N18	             2	         1587
	N19	             3	         1719
	N20	             4	         1861
	N25	             9	         2769
	*/
}

function get_name($id, $id_column, $name_column, $table) {
    $result = DB::table($table)->where($id_column, $id)->first();

    if (!$result) {
        return 'N/A';
    } else {
        return $result->$name_column;
    }
}