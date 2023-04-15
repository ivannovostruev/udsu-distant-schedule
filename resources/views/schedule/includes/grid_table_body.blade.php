@php /** @var \App\Models\Schedule\Grid $grid */ @endphp

<tbody>
    @foreach($grid->getBody() as $row)
        <tr>
            @php
                $timeslot = 0;
            @endphp
            @foreach($row as $cell)
                @php /** @var \App\Models\Schedule\Cells\Cell $cell */ @endphp
                @if($cell->typeIsTimeslot())
                    @php /** @var \App\Models\Schedule\Cells\TimeslotCell $cell */ @endphp
                    <td class="align-middle text-center">
                        {{ $cell->getName() }}<br>{{ $cell->getInterval() }}
                    </td>
                    @php
                    $timeslot = $cell->getId();
                    @endphp
                @elseif($cell->typeIsLesson())
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
                @elseif($cell->typeIsEmpty() || $cell->typeIsRoom())
                    <td>
                        @include('schedule.includes.fast_create_lesson_button', [
                            'routeName'  => 'dashboard.lessons.fastCreate',
                            'date'       => $date,
                            'roomId'     => $cell->getId(),
                            'timeslotId' => $timeslot,
                        ])
                    </td>
                @endif
            @endforeach
        </tr>
    @endforeach
</tbody>
