@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <nav class="navbar navbar-light bg-light">
                        <div class="d-flex align-items-center"> 
                            <div class="p-2">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
</div>
<div class="p-2  flex-grow-1">

                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection