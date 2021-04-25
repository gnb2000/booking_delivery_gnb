@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">Booking form</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ url('/booking-form') }}">
                            @csrf
                        
    
                            <div class="form-group row">
                                <label for="origin" class="col-md-4 col-form-label text-md-right">Origin address</label>
    
                                <div class="col-md-6">
                                    <input id="origin" type="text" class="form-control" name="origin" autocomplete="origin" autofocus>
    
                                    
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="dest" class="col-md-4 col-form-label text-md-right">Destination address</label>
    
                                <div class="col-md-6">
                                    <input id="dest" class="form-control" name="dest" value="" autocomplete="dest">
                                </div>
                            </div>

                            @php
                                $id = $date_information['id'];
                                $day = $date_information['day'];
                            @endphp

                            
                            <input id="id" name="id" type="hidden" value="{{$id}}">
                            <input id="day" name="day" type="hidden" value="{{$day}}">


    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button href="{{ url("/booking") }} " class="btn btn-danger">
                                        Return
                                    </button>
                                    <button type="submit" href="{{ url("booking") }}" class="btn btn-primary">
                                        Book
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection