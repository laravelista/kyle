@extends('layouts.app')

@section('meta_title', 'Clients - Edit')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.partials.page_header', [
                'header' => 'Clients',
                'subtext' => 'Edit'
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('layouts.partials.validation')

            {{ Form::model($client, ['route' => ['clients.update', $client->id], 'method' => 'PUT']) }}

                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('tax_number', 'Tax Number') }}
                    {{ Form::text('tax_number', null, ['class' => 'form-control', 'placeholder' => 'Tax Number']) }}
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
@endsection
