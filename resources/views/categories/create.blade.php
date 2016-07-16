@extends('layouts.app')

@section('meta_title', 'Categories - Create')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.partials.page_header', [
                'header' => 'Categories',
                'subtext' => 'Create'
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            @include('layouts.partials.validation')

            {{ Form::open(['route' => 'categories.store']) }}

                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) }}
                </div>

                <button type="submit" class="btn btn-primary">Save</button>

            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
