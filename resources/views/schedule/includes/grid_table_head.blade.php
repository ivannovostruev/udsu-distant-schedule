@php /** @var \App\Models\Schedule\Grid $grid */ @endphp

<thead>
    <tr>
        @foreach($grid->getHead() as $cell)
            <th class="text-center align-middle"
                @if($cell instanceof stdClass) style="min-width: 120px"@endif>
                {{ !empty($cell->name) ? 'Комната ' . $cell->name : '' }}
            </th>
        @endforeach
    </tr>
</thead>
