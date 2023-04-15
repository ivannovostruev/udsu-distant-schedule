@php /** @var \App\Models\Dashboard\Sidebar $sidebar */ @endphp

<aside id="sidebar">
    <div class="mb-3 pt-3 ps-2 pe-2">
        <a href="{{ route('schedule') }}" class="logo"></a>
    </div>
    <nav class="nav flex-column">
        @foreach($sidebar->links() as $link)
            @php /** @var \App\Models\Dashboard\SidebarLink $link */ @endphp
            @can($link->getAbility())
                <a href="{{ route($link->getRoute()) }}"
                   class="@if($link->isActive()){!!'nav-link active'!!}@else{!!'nav-link'!!}@endif">
                    <i class="{{ $link->getIconClass() }}"></i>{{ $link->getTitle() }}
                </a>
            @endcan
        @endforeach
    </nav>
    {{--<hr>--}}
    {{--<p class="text-end fs-6" style="color:#777;padding-right:15px;">v24</p>--}}
</aside>
