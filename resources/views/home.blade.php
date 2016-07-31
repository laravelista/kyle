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

    @include('partials._occurrences_table', [
        'title' => 'This Month',
        'occurrences' => $occurrencesThisMonth
    ])

    @include('partials._occurrences_table', [
        'title' => 'Upcoming Month',
        'occurrences' => $occurrencesNextMonth
    ])

    @include('partials._occurrences_table', [
        'title' => 'Have not received payment for',
        'occurrences' => $previousUnpaidOccurrences
    ])

</div>
@endsection
