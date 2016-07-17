@inject('Service', 'App\Service')

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
    @if(count($occurrences) > 0)
    <div class="row">
        <div class="col-md-12">
            <h3>
                This month
                <small class="pull-right" style="margin-top: 15px;">
                    TOTAL {{ $Service->getSumForMonth(date('n'), true) }}
                </small>
            </h3>
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
                            <td class="kyle-change-boolean"
                                data-url="/api/v1/occurrences/{{ $occurrence->id }}/offer"
                                data-state="{{ $occurrence->getFutureOfferState() }}">
                                {{ $occurrence->offer_sent }}
                            </td>
                            <td class="kyle-change-boolean"
                                data-url="/api/v1/occurrences/{{ $occurrence->id }}/payment"
                                data-state="{{ $occurrence->getFuturePaymentState() }}">
                                {{ $occurrence->payment_received }}
                            </td>
                            <td class="kyle-change-boolean"
                                data-url="/api/v1/occurrences/{{ $occurrence->id }}/receipt"
                                data-state="{{ $occurrence->getFutureReceiptState() }}">
                                {{ $occurrence->receipt_sent }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @else
        <p class="lead">Nothing to bill this month :/</p>
    @endif
    @if(count($upcomingOccurrences) > 0)
    <div class="row">
        <div class="col-md-12">
            <h3>
                Upcoming month
                <small class="pull-right" style="margin-top: 15px;">
                    TOTAL {{ $Service->getSumForMonth(date('n') + 1, true) }}
                </small>
            </h3>
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
                    @foreach($upcomingOccurrences as $occurrence)
                        <tr>
                            <td>{{ $occurrence->occurs_at->format('d.m.Y') }}</td>
                            <td>{{ $occurrence->service->title }}</td>
                            <td>{{ $occurrence->service->client->name }}</td>
                            <td>{{ $occurrence->service->formatted_cost }}</td>
                            <td class="kyle-change-boolean"
                                data-url="/api/v1/occurrences/{{ $occurrence->id }}/offer"
                                data-state="{{ $occurrence->getFutureOfferState() }}">
                                {{ $occurrence->offer_sent }}
                            </td>
                            <td class="kyle-change-boolean"
                                data-url="/api/v1/occurrences/{{ $occurrence->id }}/payment"
                                data-state="{{ $occurrence->getFuturePaymentState() }}">
                                {{ $occurrence->payment_received }}
                            </td>
                            <td class="kyle-change-boolean"
                                data-url="/api/v1/occurrences/{{ $occurrence->id }}/receipt"
                                data-state="{{ $occurrence->getFutureReceiptState() }}">
                                {{ $occurrence->receipt_sent }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
