@php /** @var \App\Models\Schedule\Cells\TimeslotCell $cell */ @endphp

<td class="align-middle text-center">
    {{ $cell->getName() }}<br>{{ $cell->getInterval() }}
</td>
