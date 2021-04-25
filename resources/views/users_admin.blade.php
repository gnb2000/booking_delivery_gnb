@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-12">
                <h2 class="text-center"> Admin your users </h2>
            </div>

            <div class="col-12 pt-3">
                <a class="btn btn-success" href="{{ url('/user_register') }} ">Create new user</a>
            </div>

            <div class="col-12 pt-4">
                <div class="table-responsive text-center">
                    <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Role</th>
                        <th scope="col">Actions</th>
    
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->phone }}</td>
                            @if ($user->isADM == 1)
                                <td>Admin</td>
                            @else
                                <td>Client</td>
                            @endif
                            <td><a class="btn btn-danger" href="{{ url("/users_admin/delete/$user->id") }}">Delete</a></td>
                            </tr>
                        @endforeach
                      
                    </tbody>
                  </table>
                </div>
            </div>
            
            
        </div>
    </div>
    
@endsection