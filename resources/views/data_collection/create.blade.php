@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data Collection Tool</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row collection-form">
                        

                            <div class="col-md-6">
                                <form method="POST" action="{{ url('data_collection') }}" style="width: 100%">
                                @csrf
                                <div class="form-group{{ $errors->has('date_of_admission') ? ' has-error' : '' }}">
                                    <label for="date_of_admission" class="col-md-4 control-label">Date of Admission</label>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                {{ Form::selectRange('dobday', 1, 31,'' , ['class' => 'form-control']) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::selectMonth('dobmonth',Carbon\Carbon::now()->month,['placeholder' => '--Select Month--','class' => 'form-control'])}}
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::selectYear('dobyear', date('Y'), 1915, 2018,['class'=>'form-control']) !!} 
                                            </div>
                                        </div> 
                                        @if ($errors->has('date_of_admission'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('date_of_admission') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('date_of_admission') ? ' has-error' : '' }}">
                                    <label for="date_of_admission" class="col-md-4 control-label">Caretakers</label>
                                    <div class="col-md-12">
                                        <input type="radio" name="caretakers" value="1" required>Parent &nbsp;
                                        <input type="radio" name="caretakers" value="2" required>Other
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                    <label for="gender" class="col-md-4 control-label">Gender</label>
                                    <div class="col-md-12">
                                        <input type="radio" name="gender" value="1" required>Male &nbsp;
                                        <input type="radio" name="gender" value="2" required>Female
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                                    <label for="age" class="col-md-4 control-label">Age</label>
                                    <div class="col-md-12">
                                        <input id="age" type="text" class="form-control" name="age" value="{{ old('age') }}">
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('exclusive_breast_feeding') ? ' has-error' : '' }}">
                                    <label for="exclusive_breast_feeding" class="col-md-12 control-label">Exclusive breast feeding for 6 months</label>
                                    <div class="col-md-12">
                                        <input type="radio" name="exclusive_breast_feeding" value="1" required>1-2 Months &nbsp;
                                        <input type="radio" name="exclusive_breast_feeding" value="2" required>3-4 Months &nbsp;
                                        <input type="radio" name="exclusive_breast_feeding" value="3" required>5-6 Months 
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('immunization_status') ? ' has-error' : '' }}">
                                    <label for="immunization_status" class="col-md-12 control-label">Immunization status</label>
                                    <div class="col-md-12">
                                        <input type="checkbox" name="immunization_status[]" value="1" required>Tetanus &nbsp;
                                        <input type="checkbox" name="immunization_status[]" value="2" required>Hepatitis &nbsp;
                                        <input type="checkbox" name="immunization_status[]" value="3" required>Influenza &nbsp;
                                        <input type="checkbox" name="immunization_status[]" value="4" required>Pneumonia &nbsp;
                                        <input type="checkbox" name="immunization_status[]" value="5" required>Chickenpox &nbsp; <br>
                                        <input type="checkbox" name="immunization_status[]" value="6" required>MMR (Measles, Mumps, Rubella) &nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="address" class="col-md-4 control-label">Address</label>
                                    <div class="col-md-12">
                                        <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" >
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('comorbidity') ? ' has-error' : '' }}">
                                    <label for="comorbidity" class="col-md-12 control-label">Comorbidity</label>
                                    <div class="col-md-12">
                                        <input type="checkbox" name="comorbidity[]" value="1" required>HIV &nbsp;
                                        <input type="checkbox" name="comorbidity[]" value="2" required>TB &nbsp;
                                        <input type="checkbox" name="comorbidity[]" value="3" required>Malaria &nbsp;
                                        <input type="checkbox" name="comorbidity[]" value="4" required>Measles &nbsp;
                                        <input type="checkbox" name="comorbidity[]" value="5" required>Diarrhea &nbsp; 
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('body_mass_index') ? ' has-error' : '' }}">
                                    <label for="body_mass_index" class="col-md-12 control-label">Body Mass Index</label>
                                    <div class="col-md-12">
                                        <input type="radio" name="body_mass_index" value="1" required>1-1.5 &nbsp;
                                        <input type="radio" name="body_mass_index" value="2" required>2-2.5 &nbsp;
                                        <input type="radio" name="body_mass_index" value="3" required>3-3.5 &nbsp;
                                        <input type="radio" name="body_mass_index" value="4" required>< 3.5  
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('birth_weight') ? ' has-error' : '' }}">
                                    <label for="birth_weight" class="col-md-12 control-label">Birth Weight</label>
                                    <div class="col-md-12">
                                        <input type="radio" name="birth_weight" value="low" required>Low &nbsp;
                                        <input type="radio" name="birth_weight" value="moderate" required>Moderate &nbsp;
                                        <input type="radio" name="birth_weight" value="normal" required>Normal &nbsp;
                                        <input type="radio" name="birth_weight" value="obess" required>Obess  
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('prematurity') ? ' has-error' : '' }}">
                                    <label for="prematurity" class="col-md-4 control-label">Pre-maturity</label>
                                    <div class="col-md-12">
                                        <input type="radio" name="prematurity" id="child_premature" value="yes" required>Yes &nbsp;
                                        <input type="radio" name="prematurity" id="child_not_premature" value="no" required>No

                                        <div id="age_in_months" style="display: none;">
                                            <label class="control-label">How old in months</label><br>
                                            <input id="prematurity_in_months" type="text" class="form-control" name="prematurity_in_months" value="{{ old('prematurity_in_months') }}" >
                                        </div>
                                    </div>                                
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" id="save_button">
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="/js/js/jquery3.2.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() { 
        $("#child_premature").click(function(e) {
            $("#age_in_months").show();
        });

        $("#child_not_premature").click(function(e) {
            $("#age_in_months").hide();
        });
    })
</script>
