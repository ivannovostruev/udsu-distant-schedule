@php /** @var \App\Models\Schedule\Cells\LessonCell $cell */ @endphp

<td class="lesson-cell"
    @if($cell->getBackgroundColor())
    style="background-color:{{ $cell->getBackgroundColor() }};"
    @endif>
    @if($cell->isShouldRecord())
        <i class="bi bi-record-fill record" title="Запись"></i>
    @endif
    @if($cell->linkTypeIsIndividual())
        <i class="bi bi-exclamation-octagon-fill link-type-individual"
           title="Индивидуальная ссылка"></i>
    @endif
    <a href="{{ route('dashboard.lessons.show', $cell->data->id) }}"
       @if($cell->getCssClasses()) class="{{ $cell->getCssClasses() }}" @endif>{{ $cell->getName() }}</a>
    @can('lesson-edit', $cell->getData())
        @include('schedule.includes.fast_edit_lesson_button', ['lessonId'=> $cell->getId()])
    @endcan
</td>
