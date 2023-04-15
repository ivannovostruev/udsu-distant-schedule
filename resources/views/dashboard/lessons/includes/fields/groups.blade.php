@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<label for="groups" class="form-label">Академические группы</label>
<select name="groups[]"
        id="groups"
        class="form-select"
        size="1"
        multiple>
    @foreach($groups as $group)
        @php /** @var \App\Models\Schedule\Group $group */ @endphp
        @if(old('groups'))
            <option value="{{ $group->id }}"
                    @if(in_array($group->id, old('groups'))) selected @endif>{{ $group->name }}
            </option>
        @elseif(!empty($lesson->id))
            <option value="{{ $group->id }}"
                    @if($lesson->groupIsAttached($group)) selected @endif>{{ $group->name }}
            </option>
        @else
            <option value="{{ $group->id }}">{{ $group->name }}</option>
        @endif
    @endforeach
</select>
