@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="padding-top: 50px;">
            <div class="card">
                <div class="card-header">{{ __('Step 2 0f 2 (Pneumonia factors)') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('store-factors') }}" aria-label="{{ __('Register') }}">
                        @csrf
                        <input type="hidden" name="demo_id" value="{{ $demographic_id }}">

                        <div class="form-group row">
                            <label for="age_group" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <div style="padding-top: 5px;">
                                <input type="radio" name="gender" value="3" required>Male &nbsp;
                                <input type="radio" name="gender" value="1" required>Female
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="weight_for_height" class="col-md-4 col-form-label text-md-right">{{ __('Weight For Height') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="weight_for_height" required>
                                    <option value="">--select--</option>
                                    <option value="5"> Very Malnourished</option>
                                    <option value="3"> Malnourished</option>
                                    <option value="2"> Nourished</option>
                                    <option value="0">Not Available</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="HIV_status" class="col-md-4 col-form-label text-md-right">{{ __('HIV Status') }}</label>

                            <div class="col-md-6">
                                <div style="padding-top: 5px;">
                                <input type="radio" name="HIV_status" value="5" required>Positive &nbsp;
                                <input type="radio" name="HIV_status" value="1" required>Negative &nbsp;
                                <input type="radio" name="HIV_status" value="0" required>Unknown
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nutrition" class="col-md-4 col-form-label text-md-right">{{ __('Nutrition Status') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="nutrition" required>
                                    <option value="">--select--</option>
                                    <option value="1">Very Good</option>
                                    <option value="2">Good</option>
                                    <option value="3">Moderate</option>
                                    <option value="4">Poor</option>
                                    <option value="5">Very Poor</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="breast_feeding" class="col-md-4 col-form-label text-md-right">{{ __('Breast Feeding') }}</label>

                            <div class="col-md-6">
                                <div style="padding-top: 5px;">
                                <input type="radio" name="breast_feeding" value="1" required>Yes &nbsp;
                                <input type="radio" name="breast_feeding" value="5" required>No
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="congestion_at_home" class="col-md-4 col-form-label text-md-right">{{ __('Congestion at home') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="congestion_at_home" required>
                                    <option value="">--select--</option>
                                    <option value="5">Very High</option>
                                    <option value="4">High</option>
                                    <option value="3">Moderate</option>
                                    <option value="1">Low</option>
                                    <option value="0">No congestion</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Immunized" class="col-md-4 col-form-label text-md-right">{{ __('Immunized?') }}</label>

                            <div class="col-md-6">
                                <div style="padding-top: 5px;">
                                <input type="radio" name="Immunisation" value="1" required>Yes &nbsp;
                                <input type="radio" name="Immunisation" value="5" required>No
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smookers" class="col-md-4 col-form-label text-md-right">{{ __('Any smokers at home?') }}</label>

                            <div class="col-md-6">
                                <div style="padding-top: 5px;">
                                <input type="radio" name="smokers" value="5" required>Yes &nbsp;
                                <input type="radio" name="smokers" value="1" required>No
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Complete') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
