@inject('Service', 'App\Service')

@extends('layouts.app')

@section('meta_title', 'Report')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.partials.page_header', [
                'header' => 'Report',
                'subtext' => 'Yearly report of services, clients and categories.'
            ])
            <dl>
                <dt>Date</dt>
                <dd>{{ date('d.m.Y') }}</dd>
                <dt>User</dt>
                <dd>{{ auth()->user()->name }}</dd>
            </dl>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Statistics</h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <?php
                                $total = 0;
                                foreach($services as $service) {
                                    $total += ($service->cost / 100) * $service->exchange_rate;
                                }
                            ?>
                            <span class="badge">{{ $Service->getSum($services) }}</span>
                            TOTAL INCOME
                        </li>
                        <li class="list-group-item">
                            <span class="badge">{{ $clients->count() }}</span>
                            CLIENTS
                        </li>
                        <li class="list-group-item">
                            <span class="badge">{{ $categories->count() }}</span>
                            CATEGORIES
                        </li>
                        <li class="list-group-item">
                            <span class="badge">{{ $services->count() }}</span>
                            SERVICES
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Categories</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Services #</th>
                                <th class="text-right">Income</th>
                            </tr>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->services->count() }}</td>
                                <td class="text-right">{{ $Service->getSum($category->services) }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Clients</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Services #</th>
                                <th class="text-right">Income</th>
                            </tr>
                            @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->services->count() }}</td>
                                <td class="text-right">{{ $Service->getSum($client->services) }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Services by month</h3>
                </div>
                <div class="panel-body">
                    @for($i = 1; $i <= 12; $i++)
                        @if($services->where('month', $i)->count() > 0)

                            <h3>
                                {{ date('F', mktime(0, 0, 0, $i)) }}
                                <small>{{ $i }}</small>
                                <small class="pull-right" style="margin-top: 15px;">
                                    TOTAL {{ $Service->getSumForMonth($i, true) }}
                                </small>
                            </h3>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Repeats on</th>
                                        <th>Title</th>
                                        <th>Client</th>
                                        <th>Category</th>
                                        <th>Cost</th>
                                    </tr>

                                    @foreach($services->where('month', $i) as $service)
                                        <tr>
                                            <td>{{ $service->day }}.{{ $service->month }}</td>
                                            <td>{{ $service->title }}</td>
                                            <td>{{ $service->client->name }}</td>
                                            <td>{{ $service->category->name or 'n/a' }}</td>
                                            <td>{{ $service->formatted_cost }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
