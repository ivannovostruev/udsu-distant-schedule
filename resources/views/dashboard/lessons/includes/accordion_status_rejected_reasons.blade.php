<div id="accordionStatusRejectedReasons" class="accordion mt-3 mb-3">
    <div class="accordion-item">
        <h2 id="headingStatusRejectedReasons" class="accordion-header">
            <button type="button"
                    class="accordion-button collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseStatusRejectedReasons"
                    aria-expanded="false"
                    aria-controls="collapseStatusRejectedReasons">Причины отклонения</button>
        </h2>
        <div id="collapseStatusRejectedReasons"
             class="accordion-collapse collapse"
             aria-labelledby="headingStatusRejectedReasons"
             data-bs-parent="#accordionStatusRejectedReasons">
            <div class="accordion-body">
                <div class="row mb-3 reasons g-0">
                    @include('dashboard.lessons.includes.fields.rejected_reasons_new')
                </div>
            </div>
        </div>
    </div>
</div>
