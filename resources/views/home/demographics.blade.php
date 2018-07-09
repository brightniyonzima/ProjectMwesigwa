@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="padding-top: 50px;">
            <div class="card">
                <div class="card-header">{{ __('Step 1 0f 2 (Demographics)') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('store-demographics') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="age_group" class="col-md-4 col-form-label text-md-right">{{ __('Select Age Group') }}</label>

                            <div class="col-md-6">
                                <!-- <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus> -->
                                {{ Form::select('age_group',$age_groups,'',['class' => 'form-control']) }}

                                @if ($errors->has('age_group'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('age_group') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Select Month') }}</label>

                            <div class="col-md-6">
                                <!-- <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required> -->
                                {{ Form::selectMonth('pneumonia_month',Carbon\Carbon::now()->month,['placeholder' => '--Select Month--','class' => 'form-control'])}}

                                @if ($errors->has('pneumonia_month'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pneumonia_month') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="district" class="col-md-4 col-form-label text-md-right">{{ __('Select District') }}</label>

                            <div class="col-md-6">
                                <!-- <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required> -->
                                {{ Form::select('district',$districts,'',['class' => 'form-control','required'=>'true']) }}

                                @if ($errors->has('district'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('district') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Next') }}
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
