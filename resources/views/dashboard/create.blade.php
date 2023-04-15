@php /** @var \App\Support\Pages\Page $page */ @endphp

@extends('layouts.dashboard')

@section('content')
    <div id="{{ $page->getCreatePageId() }}">
        @include($page->getCreatePageHeaderView())
        @include($page->getCreatePageMainView())
    </div>
@endsection
