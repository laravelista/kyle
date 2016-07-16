@extends('layouts.app')

@section('meta_title', 'Categories - Index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.partials.page_header', [
                'header' => 'Categories',
                'subtext' => 'Index'
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <p>
                <a href="{{ route('categories.create') }}" class="btn btn-primary btn-lg">Add Category</a>
            </p>
            <br />
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Services</th>
                        <th></th>
                    </tr>

                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->services->count() }}</td>
                            <td>
                                {{ Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'DELETE', 'class' => 'confirm']) }}
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-xs btn-default">
                                        <i class="fa fa-fw fa-edit"></i> Edit
                                    </a>
                                    <button name="category_{{ $category->id }}" type="submit" class="btn btn-xs btn-danger">
                                        <i class="fa fa-fw fa-trash"></i> Delete
                                    </button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
