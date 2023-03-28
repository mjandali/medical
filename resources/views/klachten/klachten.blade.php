@extends('layouts.appEmployee')

@section('content')
<h2 class="text-center mb-5">Klachten Lijst</h2>
<div class="doctors-list">
    <a href="/klacht/create"><button class="btn btn-primary">Klacht Toevoegen</button></a>
    <table class="table table-striped mt-2">
        <tbody>
            @foreach ($klachten as $klacht)
                <tr>
                    <td>{{ $klacht->klacht }}</td>
                    <td style="float: right" class="d-flex">
                        <a href="klacht/edit/{{ $klacht->id }}"><button class="btn btn-success">Edit</button></a>
                        <span class="pr-2"></span>
                        <form action="klacht/delete/{{ $klacht->id }}" method="POST">
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
