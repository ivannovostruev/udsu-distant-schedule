<div class="col-auto me-2 mb-2">
    <input name="color_id"
           type="radio"
           value="default"
           id="color-id-none"
           class="btn-check">
    <label for="color-id-none"
           class="btn btn-outline-light text-black border-dark"
           data-bs-toggle="tooltip"
           data-bs-placement="top"
           data-bs-custom-class="color-tooltip"
           data-bs-title="Применить цвет по умолчанию">default</label>
</div>
@foreach($colors as $color)
    @php /** @var \App\Models\Schedule\Color $color */ @endphp
    <div class="col-auto me-2 mb-2">
        <input name="color_id"
               type="radio"
               value="{{ $color->id }}"
               id="color-id{{$color->id}}"
               class="btn-check"
               @if(old('color_id', $colorId) == $color->id) checked @endif>
        <label for="color-id{{ $color->id }}"
               class="btn {{ $color->getTextColorCssClass() }}"
               style="background-color:{{ $color->hex }};"
               data-bs-toggle="tooltip"
               data-bs-placement="top"
               data-bs-custom-class="color-tooltip"
               data-bs-title="{{ $color->description }}">{{ $color->hex }}</label>
    </div>
@endforeach
