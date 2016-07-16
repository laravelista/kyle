@extends('layouts.app')

@section('meta_title', 'Services - Edit')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.partials.page_header', [
                'header' => 'Services',
                'subtext' => 'Edit'
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            @include('layouts.partials.validation')

            {{ Form::model($service, ['route' => ['services.update', $service->id], 'method' => 'PUT']) }}

                <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('category_id', 'Category') }}
                    {{ Form::select('category_id', $categories, null, [
                        'class' => 'form-control',
                        'placeholder' => 'Select a category'
                    ]) }}
                </div>

                <div class="checkbox">
                    <label>
                        {{ Form::checkbox('active', '1') }} Active
                    </label>
                </div>

                <div class="form-group">
                    {{ Form::label('note', 'Note') }}
                    {{ Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => 'Note']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('month', 'Month') }}
                    {{ Form::text('month', null, ['class' => 'form-control', 'placeholder' => 'Month']) }}
                    <p class="help-text">1 = January, 2 = February...</p>
                </div>

                <div class="form-group">
                    {{ Form::label('day', 'Day') }}
                    {{ Form::text('day', null, ['class' => 'form-control', 'placeholder' => 'Day']) }}
                    <p class="help-text">1, 2, 3...</p>
                </div>

                <div class="form-group">
                    {{ Form::label('cost', 'Cost') }}
                    {{ Form::text('cost', null, ['class' => 'form-control', 'placeholder' => 'Cost']) }}
                    <p class="help-text">Eg. 1050,00</p>
                </div>

                <div class="form-group">
                    {{ Form::label('currency', 'Currency') }}
                    {{ Form::select('currency', $currencies, null, [
                        'class' => 'form-control',
                        'placeholder' => 'Select a currency'
                    ]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('exchange_rate', 'Exchange Rate') }}
                    {{ Form::text('exchange_rate', null, ['class' => 'form-control']) }}
                    <p class="help-text">If the currency is USD leave this blank or set to "1".</p>
                </div>

                <div class="form-group">
                    {{ Form::label('client_id', 'Client') }}
                    {{ Form::select('client_id', $clients, null, [
                        'class' => 'form-control',
                        'placeholder' => 'Select a client'
                    ]) }}
                </div>

                <button type="submit" class="btn btn-primary">Update</button>

            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
