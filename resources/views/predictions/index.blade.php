@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="padding-top: 50px;">
            <div class="card">
                <div class="card-header">{{ __('Select which demographic to use for predicting pneumonia prevalance') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('predictions') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="demographics" class="col-md-4 col-form-label text-md-right">{{ __('Predict based on') }}</label>

                            <div class="col-md-6">
                                {{ Form::select('demographics',$demographics,'',['class' => 'form-control']) }}

                                @if ($errors->has('demographics'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('demographics') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4"><br>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Predict') }}
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
