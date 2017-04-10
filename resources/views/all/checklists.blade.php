@extends('layouts.app')


@section('content')
<div class="container">
    <h1>Master Checklists</h1>
    <ul class="list-group">
        @foreach($checklists as $checklist)

            <li class="list-group-item">
                {{$checklist->name}}
                <span class="pull-right"><a class="btn btn-sm btn-info" href="/checklist/{{$checklist->id}}">View</a></span>
            </li>

        @endforeach
    </ul>

</div>

@endsection