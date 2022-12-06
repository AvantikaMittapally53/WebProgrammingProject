@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card" style="height:25rem;">
            <div class="card-header">{{ __('ETD Search Engine') }}</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <nav class="navbar navbar-light bg-light form-inline">
                        <form class="form-inline" method="GET" action="/search">
                            @csrf
                            <div class="d-flex align-items-center"> 	
                            <div class="p-2">	
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="q">	
</div>	
<div class="p-2  flex-grow-1">	
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>	
</div>
                        </form>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
