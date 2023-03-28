@extends('layouts.appEmployee')

@section('content')
<div class="container">
    <h2 class="text-center m-5">Patienten Per Klacht</h2>
    <div class="doctors-list">
        @if ($first)
        <table class="table table-striped mt-2">
            <thead>
                <tr>
                    <td>Klacht</td>
                    <td>Naam</td>
                    <td>Gebuurtedatum</td>
                    <td>Huisarts</td>
                    <td>Datum</td>
                    <td>Afgehandeld</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $klachtid = '';
                    $count = 0;
                    $totaal = 0;
                ?>
                @foreach ($afspraken as $afspraak)
                    <?php
                        $count = $count + 1;
                        $totaal = $totaal + 1;
                    ?>
                    @if ($klachtid != $afspraak->klacht->id)
                        <?php
                        $klachtid = $afspraak->klacht->id;
                        $new = true;
                        ?>

                        @if ($klachtid != $first)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><span class="font-weight-bold">Subtotaal</span></td>
                            <td>{{ $count -1 }}</td>
                        </tr>
                        <?php
                            $count = 1;
                        ?>
                        @endif

                        <tr>
                            <td>
                                {{ $afspraak->klacht->klacht }}
                            </td>
                            <td>{{ $afspraak->user->first_name }} {{ $afspraak->user->last_name }}</td>
                            <td>{{ $afspraak->user->birthday }}</td>
                            <td>{{ $afspraak->doctor->name }}</td>
                            <td>{{ $afspraak->date }}</td>
                                @if ($afspraak->status == 1)
                                    <td>Ja</td>
                                @else
                                    <td>Nee</td>
                                @endif
                        </tr>
                        <?php
                            $new = false;
                        ?>
                    @else
                        <tr>
                            <td></td>
                            <td>{{ $afspraak->klacht->klacht }}</td>
                            <td>{{ $afspraak->user->birthday }}</td>
                            <td>{{ $afspraak->doctor->name }}</td>
                            <td>{{ $afspraak->date }}</td>
                                @if ($afspraak->status == 1)
                                    <td>Ja</td>
                                @else
                                    <td>Nee</td>
                                @endif
                        </tr>


                    @endif
                @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><span class="font-weight-bold">Subtotaal</span></td>
                        <td>{{ $count }}</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><span class="font-weight-bold">TOTAAL</span></td>
                        <td>{{ $totaal }}</td>
                    </tr>
            </tbody>
        </table>
        @else
        <div>
            Er valt niets te laten zien
        </div>
        @endif
    </div>
</div>
<div class="empty"></div>
@endsection
