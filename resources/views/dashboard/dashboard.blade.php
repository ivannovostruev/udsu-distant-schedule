@php /** @var \App\Models\Dashboard\Dashboard $dashboard */ @endphp

@extends('layouts.dashboard')

@section('content')
    <div id="main">
        <div class="container-fluid">
            <div class="row">
                @can(\App\Support\Abilities\DashboardAbilities::WIDGETS)
                    @each('dashboard.includes.widget', $dashboard->widgets(), 'widget')
                @endcan
            </div>
        </div>
    </div>
@endsection
