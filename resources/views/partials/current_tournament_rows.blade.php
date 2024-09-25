@foreach ($current_tournaments as $tournament)
    <tr class="item">
        <td>
            <a href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}">
                {{ $tournament->tournamentName }}
            </a>
        </td>
        <td>
            <a href="{{ route('academyDetail', ['id' => $tournament->academy_id]) }}">
                {{ $tournament->name }}
            </a>
        </td>
        <td>{{ $tournament->category }}</td>
        <td>{{ $tournament->subCategory }}</td>
        <!-- <td>{{ $tournament->surface }}</td> -->
        <td>{{ $tournament->city }}</td>
        <!-- <td>{{ $tournament->stay }}</td> -->
        <td>{{ date('d/m/Y', strtotime($tournament->fromDate)) }}</td>
        <!-- <td>{{ $tournament->toDate ? date('d/m/Y', strtotime($tournament->toDate)) : null }}</td> -->
        <td>{{ $tournament->lastDate ? date('d/m/Y', strtotime($tournament->lastDate)) : null }}</td>
        <td>
            @if ($tournament->factsheet)
                <a href="{{ $tournament->factsheet }}" target="_blank" class="theme-btn factsheet-btn">
                    Factsheet
                </a>
            @endif
        </td>
    </tr>
@endforeach
