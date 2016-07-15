@extends('layouts.app')

@section('meta_title', 'Clients - Index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.partials.page_header', [
                'header' => 'Clients',
                'subtext' => 'Index'
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <p>
                <a href="{{ route('clients.create') }}" class="btn btn-primary btn-lg">Add Client</a>
            </p>
            <br />
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Tax Number</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>Postal Code</th>
                        <th></th>
                    </tr>

                    @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->tax_number }}</td>
                            <td>{{ $client->street }}</td>
                            <td>{{ $client->city }}</td>
                            <td>{{ $client->postal_code }}</td>
                            <td>
                                {{ Form::open(['route' => ['clients.destroy', $client->id], 'method' => 'DELETE', 'class' => 'confirm']) }}
                                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-xs btn-default">
                                        <i class="fa fa-fw fa-edit"></i> Edit
                                    </a>
                                    <button name="client_{{ $client->id }}" type="submit" class="btn btn-xs btn-danger">
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
