@extends('layouts.app')


@section('content')
    <div class="container">
        {{Form::open(['method'=>'POST', 'url'=>'/checklist'])}}
        <div class="form-group">
            {{Form::label('name', 'Checklist Name')}}
            {{Form::text('name','',['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::text('items[1][name]','',['class'=>'form-control','placeholder'=>'Enter Checklist Item'])}}
        </div>
        {{Form::submit('Create Checklist',['class'=>'center'])}}
        {{Form::close()}}

    </div>

@endsection