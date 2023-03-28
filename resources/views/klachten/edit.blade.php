@extends('layouts.appEmployee')

@section('content')
<h2 class="text-center">Klacht Bewerken</h2>
<form action="/klacht/update/{{ $klacht->id }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="form-group col-md-8">
            <label for="klacht">Klacht</label>
            <input name="klacht" class="form-control" value="{{ $klacht->klacht }}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Bewerken</button>
</form>
@endsection
