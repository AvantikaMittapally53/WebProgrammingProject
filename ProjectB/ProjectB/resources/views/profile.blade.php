@extends('layouts.app')

@section('content')
<div class="container">
       

        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($message = Session::get('success'))
                      <div class="alert alert-success">
                   <p>{{$message}}</p>
                      </div>
                   @endif
                    <form action="/user/update" method="POST">
                    @csrf
                       <div class="form-group">
                           <label for="name"><strong>Name:</strong></label>
                           <input type="text" class="form-control" id ="name" name="name" value="{{Auth::user()->name}}">
                       </div><br />
                        <div class="form-group">
                           <label for="email"><strong>Email:</strong></label>
                           <input type="text" class="form-control" id ="email" value="{{Auth::user()->email}}" name="email">
                       </div><br />
                       <div class="form-group">
                           <label for="phone"><strong>Phone:</strong></label>
                           <input type="text" class="form-control" id ="phone" value="{{Auth::user()->phone}}" name="phone">
                       </div>
                       <br />
                   
                        <button class="btn btn-primary" type="submit">Update Profile</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
