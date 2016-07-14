@extends('layouts.app')

@section('meta_title', 'Clients - Edit')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Clients Edit</div>

                <div class="panel-body">

                    @include('layouts.partials.validation')

                    {{ Form::model($client, ['route' => ['clients.update', $client->id], 'method' => 'PUT']) }}

                        <div class="form-group">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('oib', 'OIB') }}
                            {{ Form::text('oib', null, ['class' => 'form-control', 'placeholder' => 'OIB']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('street', 'Street') }}
                            {{ Form::text('street', null, ['class' => 'form-control', 'placeholder' => 'Street']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('city', 'City') }}
                            {{ Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'City']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('postal_code', 'Postal code') }}
                            {{ Form::text('postal_code', null, ['class' => 'form-control', 'placeholder' => 'Postal code']) }}
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
