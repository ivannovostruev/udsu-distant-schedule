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
                    @include('dashboard.lessons.includes.fields.color')
                </div>
            </div>
        </div>
    </div>
</div>
