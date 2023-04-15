@php /** @var \App\Support\Pages\Page $page */ @endphp

@extends('layouts.dashboard')

@section('content')
    <div id="{{ $page->getEditPageId() }}">
        @include($page->getEditPageHeaderView())
        @include($page->getEditPageMainView())
    </div>
@endsection
