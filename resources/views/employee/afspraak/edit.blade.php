@extends('layouts.appEmployee')

@section('content')
<div class="container">
    <div class="employee-contact">
        <div class="row">
            <div class="col-md-12">
                <h3>Afspraak Wijzigen</h3>
                <form action="/employee/afspraak/update/{{ $afspraak->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <select name="klacht" class="form-control" required>
                            <option value="{{ $afspraak->klacht_id }}">{{ $afspraak->klacht->klacht }}</option>
                            @foreach ($klachten as $klacht)
                                <option value="{{ $klacht->id }}">{{ $klacht->klacht }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <input type="date" name="date" id="date" class="form-control" onchange="selectedDay()" value="{{ $afspraak->date }}" required>
                        <input type="hidden" name="day" id="day" class="form-control" value="{{ $afspraak->day }}">
                      </div>

                      <div class="form-group col-md-6 tijd">
                        <select name="period" id="from-h" class="form-control" required>
                            <option value="{{ $afspraak->period }}">{{ $afspraak->period }}</option>
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
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">Dr. {{ $doctor->name . " (afwezig op " . $doctor->free_day . ")" }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="status" class="form-control" required>
                                <option value="0">Afspraak Toestand</option>
                                <option value="1">Afgehandeld</option>
                                <option value="0">Open</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Wijzigen</button>
                    <span class="terug bg-success"><a href="/employee/afspraaken">Terug</a></span>
                </form>
            </div>
        </div>
    </div>
    <div class="empty">
</div>
@endsection
