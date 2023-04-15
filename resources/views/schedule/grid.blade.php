@extends('layouts.schedule')

@section('content')
    <div id="grid" class="container-fluid">
        <div class="row">
            <table class="table table-bordered border-dark">
                @include('schedule.includes.grid_table_head')
                @include('schedule.includes.grid_table_body')
            </table>
        </div>
    </div>
@endsection
