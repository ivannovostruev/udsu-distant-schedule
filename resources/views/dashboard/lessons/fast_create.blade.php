@php /** @var \App\Support\Pages\LessonPage $page */ @endphp

@extends('layouts.dashboard')

@section('content')
    <div id="{{ $page->getCreatePageId() }}">
        @include($page->getCreatePageHeaderView())
        @include($page->getFastCreatePageMainView())
    </div>
@endsection
