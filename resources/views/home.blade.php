@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center p-5">
            <a href="{{ url("/booking") }}" type="button" class="btn btn-success btn-lg">Booking</a>
        </div>
        <div class="col-12 text-center p-5">
            <a href="{{ url("/booking_admin") }}" class="btn btn-warning btn-lg">Bookings admin</a>
        </div>
        @if (Auth::user()->isADM == 1)
            <div class="col-12 text-center p-5">
                <a href="{{ url("/users_admin") }}" class="btn btn-danger btn-lg">Users admin</a>
            </div>            
        @endif
        
    </div>
</div>
@endsection
