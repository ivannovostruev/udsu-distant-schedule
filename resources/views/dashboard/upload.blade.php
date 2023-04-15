@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <h3 class="text-center">Загрузить файл</h3>
            </div>
        </div>
        @include('dashboard.includes.result_messages')
        <div class="row">
            <div class="col">
                @include('dashboard.includes.upload_form', ['routeName' => $routeNames->upload])
            </div>
        </div>
    </div>
@endsection
