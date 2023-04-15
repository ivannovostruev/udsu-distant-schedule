@if(!empty($UI))
    @foreach($UI->mainMenu()->links() as $link)
        @php /** @var \App\Support\MainMenuLink $link */ @endphp
        @can($link->getAbility())
            <div class="nav-item">
                <a href="{{ route($link->getRoute()) }}"
                   class="@if($link->isActive()){!!'nav-link active'!!}@else{!!'nav-link'!!}@endif">{{ $link->getTitle() }}
                </a>
            </div>
        @endcan
    @endforeach
@endif
