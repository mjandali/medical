@extends('layouts.appEmployee')

@section('content')
<h2 class="text-center mb-5">Dokters Lijst</h2>
<div class="doctors-list">
    <a href="/doctor/create"><button class="btn btn-primary">Dokter Toevoegen</button></a>
    <table class="table table-striped mt-2">
        <tbody>
            @foreach ($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->name }}</td>
                    <td>{{ $doctor->free_day }}</td>
                    <td style="float: right" class="d-flex">
                        <a href="doctor/edit/{{ $doctor->id }}"><button class="btn btn-success">Edit</button></a>
                        <span class="pr-2"></span>
                        <form action="doctor/delete/{{ $doctor->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit"
                            onclick="return confirm('Weet je het zeker?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
</div>
@endsection
