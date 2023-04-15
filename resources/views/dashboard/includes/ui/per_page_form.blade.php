<form method="GET"
      action="{{ route($routeName) }}"
      id="per-page-form">
    <select name="per_page"
            id="per-page"
            class="form-select"
            aria-label="Record-per-page selector">
        @foreach($perPageSelector->getOptions() as $option)
            <option value="{{ $option }}" @if($option === $perPage) selected @endif>{{ $option }}</option>
        @endforeach
    </select>
</form>
