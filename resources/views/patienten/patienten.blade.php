@extends('layouts.appEmployee')

@section('content')
<div class="container">
    <h2 class="text-center mb-5">Patienten Lijst</h2>
    <div class="doctors-list">
        <a href="{{ route('patient.create') }}"><button class="btn btn-primary">Account Aanmaken</button></a>
        <table class="table table-striped mt-2">
            <tbody>
                @foreach ($patienten as $patient)
                    <tr>
                        <td>{{ $patient->first_name }} {{ $patient->last_name }}</td>
                        <td>{{ $patient->birthday }}</td>
                        <td>{{ $patient->email }}</td>
                        <td>{{ $patient->phone_number }}</td>
                        <td class="d-flex float-right"><a href="/patient/edit/{{ $patient->id }}"><button class="btn btn-success">wijzigen</button></a>
                            <form action="/patient/delete/{{ $patient->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger ml-2" type="submit" onclick="return confirm('Weet je het zeker?')">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
<div class="empty"></div>
@endsection
