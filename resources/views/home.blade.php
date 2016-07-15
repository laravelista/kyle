@extends('layouts.app')

@section('meta_title', 'Overview')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.partials.page_header', [
                'header' => 'Overview',
                'subtext' => 'These are the services that need to be billed.'
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>This month</h2>
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
                            <td>{{ $occurrence->service->formatted_cost }}</td>
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
@endsection
