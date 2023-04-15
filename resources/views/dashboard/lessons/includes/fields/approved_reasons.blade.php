@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

@empty($lesson->id)
    @foreach($approvedReasons as $approvedReason)
        <div class="form-check">
            @php /** @var \App\Models\Schedule\Reason $approvedReason */ @endphp
            @if(old('reasons'))
                <input name="reasons[]"
                       type="checkbox"
                       value="{{ $approvedReason->id }}"
                       id="reason{{ $approvedReason->id }}"
                       class="form-check-input"
                       @if(in_array($approvedReason->id, old('reasons'))) checked @endif>
            @else
                <input name="reasons[]"
                       type="checkbox"
                       value="{{ $approvedReason->id }}"
                       id="reason{{ $approvedReason->id }}"
                       class="form-check-input">
            @endif
            <label class="form-check-label"
                   for="reason{{ $approvedReason->id }}">{{ $approvedReason->name }}</label>
        </div>
    @endforeach
@else
    @foreach($approvedReasons as $approvedReason)
        <div class="form-check">
            @php /** @var \App\Models\Schedule\Reason $approvedReason */ @endphp
            @if(old('reasons'))
                <input name="reasons[]"
                       type="checkbox"
                       value="{{ $approvedReason->id }}"
                       id="reason{{ $approvedReason->id }}"
                       class="form-check-input"
                       @if(in_array($approvedReason->id, old('reasons'))) checked @endif>
            @else
                <input name="reasons[]"
                       type="checkbox"
                       value="{{ $approvedReason->id }}"
                       id="reason{{ $approvedReason->id }}"
                       @if($lesson->reasonIsAttached($approvedReason)) checked @endif
                       class="form-check-input">
            @endif
            <label class="form-check-label"
                   for="reason{{ $approvedReason->id }}">{{ $approvedReason->name }}</label>
        </div>
    @endforeach
@endempty
