@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

@foreach($rejectedReasons as $rejectedReason)
    <div class="form-check">
        @php /** @var \App\Models\Schedule\Reason $rejectedReason */ @endphp
        @if(old('reasons'))
            <input name="reasons[]"
                   type="checkbox"
                   value="{{ $rejectedReason->id }}"
                   id="reason{{ $rejectedReason->id }}"
                   class="form-check-input"
                   @if(in_array($rejectedReason->id, old('reasons'))) checked @endif>
        @else
            <input name="reasons[]"
                   type="checkbox"
                   value="{{ $rejectedReason->id }}"
                   id="reason{{ $rejectedReason->id }}"
                   class="form-check-input"
                   @if($lesson->reasonIsAttached($rejectedReason)) checked @endif>
        @endif
        <label class="form-check-label"
               for="reason{{ $rejectedReason->id }}">{{ $rejectedReason->name }}
        </label>
    </div>
@endforeach
