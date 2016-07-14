@extends('layouts.app')

@section('meta_title', 'Services - Create')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Services Create</div>

                <div class="panel-body">

                    @include('layouts.partials.validation')

                    {{ Form::open(['route' => 'services.store']) }}

                        <div class="form-group">
                            {{ Form::label('title', 'Title') }}
                            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('note', 'Note') }}
                            {{ Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => 'Note']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('month', 'Month') }}
                            {{ Form::text('month', null, ['class' => 'form-control', 'placeholder' => 'Month']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('day', 'Day') }}
                            {{ Form::text('day', null, ['class' => 'form-control', 'placeholder' => 'Day']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('cost', 'Cost') }}
                            {{ Form::text('cost', null, ['class' => 'form-control', 'placeholder' => 'Cost']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('currency', 'Currency') }}
                            {{ Form::select('currency', $currencies, null, [
                                'class' => 'form-control',
                                'placeholder' => 'Select a currency'
                            ]) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('client_id', 'Client') }}
                            {{ Form::select('client_id', $clients, null, [
                                'class' => 'form-control',
                                'placeholder' => 'Select a client'
                            ]) }}
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
