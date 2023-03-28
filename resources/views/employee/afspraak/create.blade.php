@extends('layouts.appEmployee')

@section('content')
<div class="container">
    <div class="employee-contact">
        <div class="row">
            <div class="col-md-12">
                <h3>Afspraak Maken</h3>
                <form action="/employee/afspraak/store" method="POST">
                    @csrf
                    <div class="form-group">
                        <select name="user" class="form-control" required>
                            <option value="">Patient</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="klacht" class="form-control" required>
                            <option value="">Klacht</option>
                            @foreach ($klachten as $klacht)
                                <option value="{{ $klacht->id }}">{{ $klacht->klacht }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <input type="date" name="date" id="date" class="form-control" onchange="selectedDay()" required>
                        <input type="hidden" name="day" id="day" class="form-control" value="">
                      </div>

                      <div class="form-group col-md-6 tijd">
                        <select name="period" id="from-h" class="form-control" required>
                            <option value="">Periode</option>
                            <option value="09:00">09 : 00</option>
                            <option value="09:30">09 : 30</option>
                            <option value="10:00">10 : 00</option>
                            <option value="10:30">10 : 30</option>
                            <option value="11:00">11 : 00</option>
                            <option value="11:30">11 : 30</option>
                            <option value="12:00">12 : 00</option>
                        </select>
                       </div>
                    </div>

                    <div class="form-group">
                        <select name="doctor" class="form-control" required>
                            <option value="">Arts</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">Dr. {{ $doctor->name . " (afwezig op " . $doctor->free_day . ")" }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Verzenden</button>
                    <span class="terug bg-secondary"><a href="/employee/afspraaken">Terug</a></span>
                </form>
            </div>
        </div>
    </div>
    <div class="empty">
</div>
@endsection
