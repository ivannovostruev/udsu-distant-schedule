@php /** @var \App\Support\Pages\Page $page */ @endphp

@extends('layouts.dashboard')

@section('content')
    <div id="{{ $page->getShowPageId() }}">
        @include($page->getShowPageHeaderView())
        @include($page->getShowPageMainView())
    </div>
@endsection
