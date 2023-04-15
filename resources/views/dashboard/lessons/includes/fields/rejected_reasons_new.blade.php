@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

@foreach($rejectedReasons as $rejectedReason)
    <div class="col-auto me-2 mb-2">
        @php /** @var \App\Models\Schedule\Reason $rejectedReason */ @endphp
        @if(old('reasons'))
            <input name="reasons[]"
                   type="checkbox"
                   value="{{ $rejectedReason->id }}"
                   id="reason{{ $rejectedReason->id }}"
                   class="btn-check"
                   @if(in_array($rejectedReason->id, old('reasons'))) checked @endif>
        @else
            <input name="reasons[]"
                   type="checkbox"
                   value="{{ $rejectedReason->id }}"
                   id="reason{{ $rejectedReason->id }}"
                   class="btn-check"
                   @if($lesson->reasonIsAttached($rejectedReason)) checked @endif>
        @endif
        <label class="btn btn-light"
               for="reason{{ $rejectedReason->id }}"
               data-bs-toggle="tooltip"
               data-bs-placement="top"
               data-bs-custom-class="color-tooltip"
               data-bs-title="{{ $rejectedReason->name }}">{{ $rejectedReason->shortname }}</label>
    </div>
@endforeach
