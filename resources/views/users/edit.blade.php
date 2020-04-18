@extends('layouts.app')

@section('content')
<x-errors/>
{{ Form::model($user, ['url' => route('users.update', compact('user')), 'files' => true, 'method' => 'PATCH']) }}
    <div>
        <div class="row">
            <div class="col-4 text-center">
                <div class="card mt-4">
                    <div class="card-body">
                        <img src="{{ isset($user->image) ? $user->image->url : "https://udemy-project-1.s3.eu-west-3.amazonaws.com/avatars/default-user-image.png" }}" class="img-thumbnail avatar mb-3">
                        <h6>{{__('Upload thumbnail')}}</h6>
                        {{ Form::file('avatar', ['class' => 'form-control-file']) }}
                    </div>
                </div>
                <br>
            </div>
            <div class="col-8 font-weight-bold text-muted">
                <div class="form-group my-0">
                    {{ Form::label('name',(__('Name')) . ':') }}<br>
                    {{ Form::text('name', $user->name, ['class' => 'form-control']) }}<br>
                </div>
            </div>
            <div class="form-group col-12">
                {{ Form::submit(__('Save changes'), ['class' => 'btn btn-primary btn-block']) }}
            </div>
        </div>
    </div>
@endsection('content')
