<div class="btn-group" role="group">
    <button type="button"
            id="notifications"
            class="btn me-3 rounded"
            data-bs-toggle="dropdown"
            aria-expanded="false"><i class="bi bi-bell"></i></button>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
        @foreach(\Illuminate\Support\Facades\Auth::user()->notifications()->get() as $notification)
            @php /** @var \App\Models\Notification $notification */ @endphp
            <li><a href="{{ $notification->url }}"
                   class="dropdown-item">{{ $notification->small_message }}</a></li>
        @endforeach
    </ul>
</div>
