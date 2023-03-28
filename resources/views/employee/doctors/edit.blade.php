@extends('layouts.appEmployee')

@section('content')
<h2 class="text-center">Dokter Bewerken</h2>
<form action="/doctor/update/{{ $doctor->id }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="form-group col-md-6">
            <label for="name">Naam</label>
            <input name="name" class="form-control" value="{{ $doctor->name }}">
                {{-- @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->first_name . " " . $doctor->last_name }}"> {{ $doctor->first_name . " " . $doctor->last_name }}</option>
                @endforeach --}}
        </div>
        <div class="form-group col-md-6">
            <label for="free_day">Vrije Dag</label>
            <select name="free_day" class="form-control">
                <option value="{{ $doctor->free_day }}">{{ $doctor->free_day }}</option>
                @foreach ($dagen as $dag)
                    <option value="{{ $dag }}"> {{ $dag }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Bewerken</button>
</form>
@endsection
