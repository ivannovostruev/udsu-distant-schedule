@php /** @var \App\Support\Pages\Page $page */ @endphp

@extends('layouts.dashboard')

@section('content')
    <div id="{{ $page->getIndexPageId() }}">
        @include($page->getIndexPageHeaderView())
        @include($page->getIndexPageMainView())
    </div>
@endsection
