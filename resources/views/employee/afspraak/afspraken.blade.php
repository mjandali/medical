@extends('layouts.appEmployee')

@section('content')
<div class="container employee">
    <h2 class="text-center pt-3 mb-3">Afspraken van Vandaag</h2>
        @if ($vandaag->count() > 0)
        <a href="{{ route('employee.afspraak.create') }}"><button class="btn btn-primary">Afspraak Maken</button></a>
        <table class="table table-striped mt-2">
            <tbody>
                @foreach ($vandaag as $vandag)
                    <tr>
                        <td>{{ $vandag->klacht->klacht }}</td>
                        <td>{{ $vandag->user->first_name }} {{ $vandag->user->last_name }}</td>
                        <td>{{ $vandag->day }}</td>
                        <td>{{ $vandag->date }}</td>
                        <td>{{ $vandag->period }}</td>
                        <td>{{ $vandag->doctor->name }}</td>
                        @if ($vandag->status == 1)
                            <td>Afgehandeld</td>
                            <td></td>
                        @else
                        <td>Open</td>
                        <td class="d-flex float-right"><a href="/employee/afspraak/edit/{{ $vandag->id }}"><button class="btn btn-success">wijzigen</button></a>
                            <form action="/afspraak/delete/{{ $vandag->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger ml-2" type="submit" onclick="return confirm('Weet je het zeker?')">afziggen</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <div class="text-center">Geen afspraken gevonden</div>
        @endif


    <h2 class="text-center m-5">Alle Afspraken</h2>
    <div class="doctors-list">
        <a href="{{ route('employee.afspraak.create') }}"><button class="btn btn-primary">Afspraak Maken</button></a>
        <table class="table table-striped mt-2">
            <tbody>
                @foreach ($afspraken as $afspraak)
                    <tr>
                        <td>{{ $afspraak->klacht->klacht }}</td>
                        <td>{{ $afspraak->user->first_name }} {{ $afspraak->user->last_name }}</td>
                        <td>{{ $afspraak->day }}</td>
                        <td>{{ $afspraak->date }}</td>
                        <td>{{ $afspraak->period }}</td>
                        <td>{{ $afspraak->doctor->name }}</td>
                        @if ($afspraak->status == 1)
                            <td>Afgehandeld</td>
                            <td></td>
                        @else
                        <td>Open</td>
                        <td class="d-flex float-right"><a href="/employee/afspraak/edit/{{ $afspraak->id }}"><button class="btn btn-success">wijzigen</button></a>
                            <form action="/afspraak/delete/{{ $afspraak->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger ml-2" type="submit" onclick="return confirm('Weet je het zeker?')">Afziggen</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
