@extends('layouts.appEmployee')

@section('content')
<div class="container">
    <h2 class="text-center m-5">Afspraken Per Patient</h2>
    <div class="doctors-list">
        <a href="{{ route('employee.afspraak.create') }}"><button class="btn btn-primary">Afspraak Maken</button></a>
        <table class="table table-striped mt-2">
            <tbody>
                {{ $userid = '' }}

                @foreach ($afspraken as $afspraak)
                    <tr>
                        @if ($userid != $afspraak->user->id)
                        <td>
                            {{ $afspraak->user->first_name }} {{ $afspraak->user->last_name }}
                            <?php
                            $userid = $afspraak->user->id
                            ?>
                        </td>
                        @else
                            <td></td>
                        @endif
                        <td>{{ $afspraak->klacht->klacht }}</td>
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
<div class="empty"></div>
@endsection
