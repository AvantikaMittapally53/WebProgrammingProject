@extends('layouts.app')

@section('content')
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} admin</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}









                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Email</th>
                                <th scope="col">Active</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)

                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}} </td>
                                <td>{{$user->is_active}} </td>

                                <td>
                                    <form action="admin/update" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$user->id}}" />

                                        <button type="submit" class="btn btn-primary btn-sm">

                                            @if($user->is_active =='false')
                                            approve
                                            @else
                                            un-approve
                                            @endif
                                        </button>
                                    </form>


                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection