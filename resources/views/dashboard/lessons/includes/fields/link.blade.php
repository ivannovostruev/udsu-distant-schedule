@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<label for="link" class="form-label">Индивидуальная ссылка</label>
<textarea name="link"
          id="link"
          rows="2"
          class="form-control" disabled>{{ old('link', $link) }}</textarea>
