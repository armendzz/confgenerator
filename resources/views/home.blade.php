@extends('layouts/app')


@section('content')
    
<div class="card mt-2">
    <div class="card-header">UnrealIrcD Config</div>
    <div class="card-body">
        
       <div class="row col-sm">
        <a href="/unrealgen" class="btn btn-primary col-sm ml-2 mr-2">UnrealIrcd Conf</a>
        <a href="/anopegen" class="btn btn-primary col-sm ml-2 mr-2">Anope Conf</a>
        <a href="/eggdroplgen" class="btn btn-primary col-sm ml-2 mr-2">Eggdrop Conf</a>
       </div>
    
    </div>
</div>

@endsection