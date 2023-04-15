@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

@isset($grid)
    <div id="grid-layout" class="mt-4">
        {{--<p class="mb-2 fs-5 text-center">Макет сетки</p>--}}
        <table class="table table-bordered border-dark">
            <thead>
            <tr>
                @foreach($grid->getHead() as $cell)
                    <th class="text-center align-middle">{{ $cell->id ?? '' }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @php
                $count = 1;
            @endphp
            @foreach($grid->getBody() as $row)
                <tr @if($count === $lesson->timeslot_id) class="marked" @endif>
                    @php
                        $roomCount = 0;
                    @endphp
                    @foreach($row as $cell)
                        @php /** @var \App\Models\Schedule\Cells\Cell $cell */ @endphp
                        @if($cell->typeIsTimeslot())
                            @php /** @var \App\Models\Schedule\Cells\TimeslotCell $cell */ @endphp
                            <td class="align-middle text-center fw-bold">{{ $cell->getId() }}</td>
                        @elseif($cell->typeIsLesson())
                            @php /** @var \App\Models\Schedule\Cells\LessonCell $cell */ @endphp
                            @if($roomCount == $lesson->room_id && $count === $lesson->timeslot_id)
                                <td class="cell occupied current-lesson"
                                    data-room-id="{{ $roomCount }}"><i class="bi bi-check-circle"></i></td>
                            @else
                                <td class="cell occupied" data-room-id="{{ $roomCount }}"></td>
                            @endif
                        @elseif($cell->typeIsEmpty() || $cell->typeIsRoom())
                            <td class="cell" data-room-id="{{ $roomCount }}"></td>
                        @endif
                        @php
                            $roomCount++;
                        @endphp
                    @endforeach
                </tr>
                @php
                    $count++;
                @endphp
            @endforeach
            </tbody>
        </table>
    </div>
@endisset
