@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-12">
                <h2 class="text-center"> Admin your booking </h2>
            </div>

            <div class="col-12 pt-4">
                <div class="table-responsive text-center">
                    <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Origin</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Time</th>
                        <th scope="col">Actions</th>
    
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($myBookings as $currentBooking)
                      <tr>
                        <td>{{ $currentBooking->id}}</td>
                        <td>{{ $currentBooking->origin}}</td>
                        <td>{{ $currentBooking->dest}}</td>
                        <td>{{$currentBooking->book_date." ".$currentBooking->start_time}}</td>
                        <td>
                          <a class="btn btn-warning" href="{{ url("/booking_admin/edit/$currentBooking->id") }}">Modify</a>
                          <a class="btn btn-danger" href="{{ url("/booking_admin/delete/$currentBooking->book_id") }}">Delete</a>

                        </td>


                      </tr>
                          
                      @endforeach
                      
                    </tbody>
                  </table>
                </div>
            </div>
            
            
        </div>
    </div>
    
@endsection