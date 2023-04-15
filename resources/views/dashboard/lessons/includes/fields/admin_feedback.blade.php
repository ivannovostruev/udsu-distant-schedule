@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<label for="admin-feedback" class="form-label">Обратная связь с методистом</label>
<textarea name="admin_feedback"
          id="admin-feedback"
          rows="2"
          class="form-control">{{ old('admin_feedback', $adminFeedback) }}</textarea>
