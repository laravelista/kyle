@extends('layouts.app')

@section('meta_title', 'Overview')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <p class="lead">These are the services that need to be billed this month.</p>
            <div class="panel panel-default">
                <div class="panel-heading">This month</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Date</th>
                                <th>Service</th>
                                <th>Client</th>
                                <th>Cost</th>
                                <th>Offer sent</th>
                                <th>Payment received</th>
                                <th>Receipt sent</th>
                            </tr>
                            @foreach($occurrences as $occurrence)
                                <tr>
                                    <td>{{ $occurrence->occurs_at->format('d.m.Y') }}</td>
                                    <td>{{ $occurrence->service->title }}</td>
                                    <td>{{ $occurrence->service->client->name }}</td>
                                    <td>{{ $occurrence->service->cost }} {{ $occurrence->service->currency }}</td>
                                    <td>{{ $occurrence->offer_sent }}</td>
                                    <td>{{ $occurrence->payment_received }}</td>
                                    <td>{{ $occurrence->receipt_sent }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    @if(count($occurrences) == 0)
                        <p class="lead">Nothing to bill this month :/</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
