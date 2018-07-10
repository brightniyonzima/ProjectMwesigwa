@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload template</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ Form::open(['url' => 'process_template','data-toggle'=>'validator','class'=>'form-horizontal','files'=>'true']) }}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('factors_template') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Upload Template:</label>
                            <div class="col-md-6">
                                {{ Form::file('factors_template',['class' => 'form-control', 'required']) }}
                                @if ($errors->has('factors_template'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('factors_template') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Upload template
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
