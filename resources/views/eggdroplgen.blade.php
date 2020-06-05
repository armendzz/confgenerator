@extends('layouts/app')


@section('content')
    
<div class="card mt-2">
    <div class="card-header">UnrealIrcD Config</div>
    <div class="card-body">
        
        <form action="/eggdroplgen" method="POST">
            @csrf
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Network Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="name" placeholder="e.g. irc.name.com">
                </div>
              </div>
             
             <div class="mt-2" >
                 <button type="submit" class="btn btn-primary">Generate</button>
             </div>
        </form>
    
    </div>
</div>

@endsection