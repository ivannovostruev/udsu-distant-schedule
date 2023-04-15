<div id="colorsLegendModal"
     class="modal fade"
     tabindex="-1"
     aria-labelledby="colorsLegendModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="colorsLegendModalLabel">Легенда цветов</h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    @foreach($defaultColors as $colorHex => $colorDescription)
                        <tr>
                            <td style="background-color:{{ $colorHex }};width:10%;"></td>
                            <td>{{ $colorDescription }}</td>
                        </tr>
                    @endforeach
                    @foreach($colors as $color)
                        @php /** @var \App\Models\Schedule\Color $color */ @endphp
                        <tr>
                            <td style="background-color:{{ $color->hex }};width:10%;"></td>
                            <td>{{ $color->description }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
