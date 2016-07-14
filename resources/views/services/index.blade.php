@extends('layouts.app')

@section('meta_title', 'Services - Index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <p>
                <a href="{{ route('services.create') }}" class="btn btn-primary btn-lg">Add Service</a>
            </p>

            <div class="panel panel-default">
                <div class="panel-heading">Services Index</div>

                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Repeats on</th>
                                <th>Title</th>
                                <th>Client</th>
                                <th>Active</th>
                                <th>Note</th>
                                <th>Cost</th>
                                <th></th>
                            </tr>

                            @foreach($services as $service)
                                <tr>
                                    <td>{{ $service->day }}.{{ $service->month }}</td>
                                    <td>{{ $service->title }}</td>
                                    <td>{{ $service->client->name }}</td>
                                    <td>{{ $service->active }}</td>
                                    <td>{{ $service->note }}</td>
                                    <td>{{ $service->cost }} {{ $service->currency }}</td>
                                    <td>
                                        {{ Form::open(['route' => ['services.destroy', $service->id], 'method' => 'DELETE', 'class' => 'confirm']) }}
                                            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-xs btn-default">
                                                <i class="fa fa-fw fa-edit"></i> Edit
                                            </a>
                                            <button name="service_{{ $service->id }}" type="submit" class="btn btn-xs btn-danger">
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
    </div>
</div>
@endsection
