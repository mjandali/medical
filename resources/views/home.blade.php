@extends('layouts.app')

@section('content')
<div class="container">
    <div class="img-cover"></div>

    @if (Session::get('message'))
        <div class="alert alert-success session-message">
            {{ Session::get('message') }}
        </div>
    @endif

    @if (Session::get('err'))
    <div class="alert alert-danger session-message">
        {{ Session::get('err') }}
    </div>
    @endif


    <div class="home-title text-center">
        <h1>Carring Your Life</h1>
        <p>Leading the Way in Medical Excellence</p>
    </div>

    <div class="contact">
        <div class="row">
            <div class="col-md-5 contact-left">
                <h3>Contact</h3>
                <h2 class="phone-number">+31 321 123 456 7</h2>
                <p class="adres"><span class="font-weight-bold">Adres: </span>Pieter Steynstraat 239<br/>8022TH Zwolle</p>
                <div class="openings"><span class="font-weight-bold">Openingstijden: </span>medical is geopend op werkdagen van 8.00 tot 17.00 uur.
                </div>
                <p class="email"><span class="font-weight-bold">E-mail: </span>medical.info@gmail.com</p>
            </div>
            <div class="col-md-7">
            <h3>Online Afspraak Maken</h3>
            @if(Auth::check())
                @if (!$checkUser)
                <form action="afspraak/store" method="POST">
                    @csrf
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
                            <option value="">Tijd</option>
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

                    <button type="submit" class="btn btn-primary">Verzenden</button>
                </form>
                @else
                    @if ($checkUser->status == true)
                        <h3>Online Afspraak Maken</h3>
                        <form action="afspraak/store" method="POST">
                            @csrf
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
                                    <option value="">Tijd</option>
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

                            <button type="submit" class="btn btn-primary">Verzenden</button>
                            <span class="mijn-afspraken bg-success"><a href="{{ route('afspraken') }}">Mijn Afspraken</a></span>
                        </form>
                    @endif
                    <h3>U heeft een afspraak</h3>
                    <div class="existing-appointment">
                        <p>{{ $checkUser->day }}</p>
                        <p>Datum: {{ $checkUser->date }}</p>
                        <p>Om: {{ $checkUser->period }} uur</p>
                        <p>Met Dr. {{ $withDr->name }}</p>
                        <div class="d-flex"><a href="/afspraak/edit/{{ $checkUser->id }}"><button class="btn btn-info">Afspraak wijzigen</button></a><span class="pr-2"></span>
                            <form action="/afspraak/delete/{{ $checkUser->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Weet je het zeker?')">Afspraak Annuleren</button>
                            </form>
                            <span class="mijn-afspraken bg-success"><a href="{{ route('afspraken') }}">Mijn Afspraken</a></span>
                        </div>
                    </div>
                @endif
            @else
                <a href="/login"><button class="btn btn-primary">Login</button></a>
            @endif
            </div>
        </div>
    </div>

    <div class="news">
        <h2>Nieuws van de Huisartsenpraktijk</h2>
        <h3>CORONA VACCINATIE</h3>
        <p>Hugo de Jonge heeft besloten tijdelijk te stoppen met het Astra Zenica vaccin bij mensen onder 60 jaar.</p>
        <p>Op dit moment hebben wij de uitnodigingen de deur al uit.</p>
        <p>Ook patienten in een bepaalde risicogroep jonger dan 60 jaar zijn uitgenodigd.</p>
        <p>Voor deze groep willen we u vragen te wachten tot het besluit voor deze groepen is genomen.</p>
        <p>A.s. donderdag 8 april hopen we daar meer over te horen.</p>
        <p>We hopen dat ook voor deze groepen de vaccinaties op 13 en 15 april gewoon door kunnen gaan.</p>
        <p>We willen u vragen hierover op dinsdag of woensdag niet met de praktijk te bellen, maar even het antwoord van het RIVM af te wachten.</p>
        <p>Wij wachten het besluit van het RIVM af en zullen u via onze website informeren.</p>

        <h3>UPDATE: CORONA 08-01-2021</h3>
        <p>Er zijn veel vragen over het coronavaccin. Helaas hebben wij nog geen concrete informatie voor u, behalve die op de website van het RIVM staat.</p>
        <p>Indien u Corona heeft doorgemaakt is het zinvol om het vaccin wél te nemen, zodat uw voldoende antistoffen opbouwt.</p>
        <p>Gebruikt u medicatie, heeft u een specifieke ziekte, ben u zwanger, geeft u borstvoeding of heeft u over het algemeen vragen over de vaccinatie en wilt uw weten of dit problemen geeft dan verwijzen wij u naar de website van het RIVM of GGD. Het is nog niet bekend welk vaccin er voor welke patiënten en op welk moment beschikbaar komt. Om u een gericht advies te kunnen geven hebben wij deze informatie nodig voordat wij u hierover kunnen adviseren.</p>
        <p>Voor meer informatie verwijzen wij u dus naar de website van het RIVM en de GGD:
        <br>https://www.rivm.nl/coronavirus-covid-19/vaccins/-en-antwoorden-coronavaccin
        <br>https://www.ggdijsselland.nl/publiek/mijn-gezondheid/infectieziekten/corona/coronavaccinatie/</p>
    </div>
</div>

<div class="empty">

</div>
@endsection
