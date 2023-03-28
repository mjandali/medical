@extends('layouts.appEmployee')

@section('content')
<h2 class="text-center">Dokter Toevoegen</h2>
<form action="{{ route('doctor.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label for="name">Naam</label>
            <input name="name" class="form-control" placeholder="Voornaam en Achternaam" required>
                {{-- @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->first_name . " " . $doctor->last_name }}"> {{ $doctor->first_name . " " . $doctor->last_name }}</option>
                @endforeach --}}
        </div>
        <div class="form-group col-md-6">
            <label for="free_day">Vrije Dag</label>
            <select name="free_day" class="form-control">
                <option value="onbekend">...</option>
                @foreach ($dagen as $dag)
                    <option value="{{ $dag }}"> {{ $dag }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Toevoegen</button>
</form>
@endsection
