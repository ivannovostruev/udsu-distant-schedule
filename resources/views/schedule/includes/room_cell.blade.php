@php /** @var \App\Models\Schedule\Cells\Cell $cell */ @endphp

<td>
    @include('schedule.includes.fast_create_lesson_button', [
        'routeName'  => 'dashboard.lessons.fastCreate',
        'date'       => $date,
        'roomId'     => $cell->getId(),
        'timeslotId' => $timeslot,
    ])
</td>
