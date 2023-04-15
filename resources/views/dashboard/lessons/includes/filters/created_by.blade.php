<label for="created_by" class="form-label">Кем создано</label>
<select name="created_by"
        id="created_by"
        class="form-select">
    <option value="" disabled selected>не выбран</option>
    @foreach($creators as $creator)
        @php /** @var \App\Models\User $creator */ @endphp
        <option value="{{ $creator->id }}"
                @if(old('created_by') == $creator->id) selected @endif>{{ $creator->name }}</option>
    @endforeach
</select>
