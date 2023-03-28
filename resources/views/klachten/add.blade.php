@extends('layouts.appEmployee')

@section('content')
<h2 class="text-center">Klacht Toevoegen</h2>
<form action="{{ route('klacht.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="form-group col-md-8">
            <label for="klacht">Klacht</label>
            <input name="klacht" class="form-control" placeholder="Een klacht toevoegen" required autofocus="autofocus">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Toevoegen</button>
</form>
@endsection
