<div id="accordionStatusApprovedReasons" class="accordion mt-3 mb-3">
    <div class="accordion-item">
        <h2 id="headingStatusApprovedReasons" class="accordion-header">
            <button type="button"
                    class="accordion-button collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseStatusApprovedReasons"
                    aria-expanded="false"
                    aria-controls="collapseStatusApprovedReasons">Причины утверждения</button>
        </h2>
        <div id="collapseStatusApprovedReasons"
             class="accordion-collapse collapse"
             aria-labelledby="headingStatusApprovedReasons"
             data-bs-parent="#accordionStatusApprovedReasons">
            <div class="accordion-body">
                <div class="row mb-3 reasons g-0">
                    @include('dashboard.lessons.includes.fields.approved_reasons_new')
                </div>
            </div>
        </div>
    </div>
</div>
