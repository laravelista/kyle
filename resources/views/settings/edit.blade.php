@extends('layouts.app')

@section('meta_title', 'Settings')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.partials.page_header', [
                'header' => 'Settings',
                'subtext' => 'Edit your settings here'
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('layouts.partials.validation')

            {{ Form::model($user, ['url' => '/settings', 'method' => 'PUT']) }}

                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('password', 'Password') }}
                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('password_confirmation', 'Password confirmation') }}
                    {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Password confirmation']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('preferred_currency', 'Preferred currency') }}
                    {{ Form::select('preferred_currency', $currencies, null, [
                        'class' => 'form-control',
                        'placeholder' => 'Select a preferred currency'
                    ]) }}
                </div>

                <div class="checkbox">
                    <label>
                        {{ Form::checkbox('email_notifications', '1') }} Receive email notifications?
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>

            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
