<form method="GET"
      action="{{ route('schedule') }}"
      id="date-picker">
    <div class="row g-0 ms-3 me-3">
        <label for="date" class="col-auto form-label"></label>
        <div class="col-auto">
            <input type="date"
                   name="date"
                   value="{{ $date }}"
                   id="date"
                   class="form-control border-dark">
        </div>
    </div>
</form>
