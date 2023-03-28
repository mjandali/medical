@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-5">Overzicht geschiedenis afspraken</h2>
    <div class="doctors-list">
        <a href="/home"><button class="btn btn-primary">Online Afspraak Maken</button></a>
        <table class="table table-striped mt-2">
            <tbody>
                @foreach ($afspraken as $afspraak)
                    <tr>
                        <td>{{ $afspraak->klacht->klacht }}</td>
                        <td>{{ $afspraak->day }}</td>
                        <td>{{ $afspraak->date }}</td>
                        <td>{{ $afspraak->doctor->name }}</td>
                        @if ($afspraak->status == 1)
                            <td>Afgehandeld</td>
                            <td></td>
                        @else
                        <td>Open</td>
                        <td class="d-flex float-right"><a href="/afspraak/edit/{{ $afspraak->id }}"><button class="btn btn-success">Afspraak wijzigen</button></a>
                            <form action="/afspraak/delete/{{ $afspraak->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger ml-2" type="submit" onclick="return confirm('Weet je het zeker?')">Afspraak Annuleren</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="empty"></div>
@endsection
