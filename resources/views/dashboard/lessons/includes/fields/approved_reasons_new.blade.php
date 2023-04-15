@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

@empty($lesson->id)
    @foreach($approvedReasons as $approvedReason)
        <div class="col-auto me-2 mb-2">
            @php /** @var \App\Models\Schedule\Reason $approvedReason */ @endphp
            @if(old('reasons'))
                <input name="reasons[]"
                       type="checkbox"
                       value="{{ $approvedReason->id }}"
                       id="reason{{ $approvedReason->id }}"
                       class="btn-check"
                       @if(in_array($approvedReason->id, old('reasons'))) checked @endif
                       autocomplete="off">
            @else
                <input name="reasons[]"
                       type="checkbox"
                       value="{{ $approvedReason->id }}"
                       id="reason{{ $approvedReason->id }}"
                       class="btn-check">
            @endif
            <label class="btn btn-light"
                   for="reason{{ $approvedReason->id }}"
                   data-bs-toggle="tooltip"
                   data-bs-placement="top"
                   data-bs-custom-class="color-tooltip"
                   data-bs-title="{{ $approvedReason->name }}">{{ $approvedReason->shortname }}</label>
        </div>
    @endforeach
@else
    @foreach($approvedReasons as $approvedReason)
        <div class="col-auto me-2 mb-2">
            @php /** @var \App\Models\Schedule\Reason $approvedReason */ @endphp
            @if(old('reasons'))
                <input name="reasons[]"
                       type="checkbox"
                       value="{{ $approvedReason->id }}"
                       id="reason{{ $approvedReason->id }}"
                       class="btn-check"
                       @if(in_array($approvedReason->id, old('reasons'))) checked @endif>
            @else
                <input name="reasons[]"
                       type="checkbox"
                       value="{{ $approvedReason->id }}"
                       id="reason{{ $approvedReason->id }}"
                       @if($lesson->reasonIsAttached($approvedReason)) checked @endif
                       class="btn-check">
            @endif
            <label class="btn btn-light"
                   for="reason{{ $approvedReason->id }}"
                   data-bs-toggle="tooltip"
                   data-bs-placement="top"
                   data-bs-custom-class="color-tooltip"
                   data-bs-title="{{ $approvedReason->name }}">{{ $approvedReason->shortname }}</label>
        </div>
    @endforeach
@endempty
