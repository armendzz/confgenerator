@extends('layouts/app')


@section('content')
    
<div class="card mt-2">
    <div class="card-header">UnrealIrcD Config</div>
    <div class="card-body">
        
        <form action="/anopegen" method="POST">
            @csrf
            <div class="form-group">
            <label for="name">Name</label>
             <input type="text" name="name">
            </div>
            <div class="form-group">
             <label for="name">info</label>
             <input type="text" name="info">
            </div>
             <div class="mt-2" >
                 <button type="submit" class="btn btn-primary">Generate</button>
             </div>
        </form>
    
    </div>
</div>

@endsection