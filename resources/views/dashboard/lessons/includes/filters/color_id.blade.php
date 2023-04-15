<div id="accordionColors" class="accordion mt-3 mb-3">
    <div class="accordion-item">
        <h2 id="headingColors" class="accordion-header">
            <button type="button"
                    class="accordion-button collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseColors"
                    aria-expanded="false"
                    aria-controls="collapseColors">Цвет ячейки</button>
        </h2>
        <div id="collapseColors"
             class="accordion-collapse collapse"
             aria-labelledby="headingColors"
             data-bs-parent="#accordionColors">
            <div class="accordion-body">
                <div class="row mb-3 colors g-0">
                    @foreach($colors as $color)
                        @php /** @var \App\Models\Schedule\Color $color */ @endphp
                        <div class="col-auto me-2 mb-2">
                            <input type="radio"
                                   name="color_id"
                                   value="{{ $color->id }}"
                                   id="color-id{{$color->id}}"
                                   class="btn-check"
                                   @if(old('color_id') == $color->id) checked @endif>
                            <label for="color-id{{$color->id}}"
                                   class="btn {{ $color->getTextColorCssClass()}}"
                                   style="background-color:{{ $color->hex }};">{{ $color->hex }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
