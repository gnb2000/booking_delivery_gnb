@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            
            
            <div class="col-12">
                <h2 class="text-center"> Book your motorbike </h2>
            </div>
            <div class="col-12">
                <h3><span class="badge badge-warning">Only 8 motorbike available each 30 minutes</span></h3>
            </div>
            <div class="col-12">
                <h3><span class="badge badge-danger">Services until 20:00 PM</span></h3>
            </div>
            <div class="col-12 pt-4">
                <div class="table-responsive text-center">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col"></th>
                                @php
                                    $dia = date('m/d');
                                    for ($i=0;$i<7;$i++){
                                        echo "<th scope=\"col\">$dia</th>";
                                        $nuevoDia = strtotime('+1 day',strtotime($dia));
                                        $dia = date('m/d',$nuevoDia);
                                    };
                                @endphp
                              </tr>
                        </thead>
                        <tbody>
                            @php
                                $cont = 0;
                                $isUserBooking = 0; // 0 = User doesn't has this booking 
                                
                                foreach ($bookings as $book) {
                                    foreach ($user_bookings as $user_book) {
                                        if ($book->id == $user_book->book_id){
                                            $isUserBooking = 1;
                                            break;
                                        }
                                    }
                                    $today = date('m/d'); //Today
                                    $clickDay = strtotime('+'.$cont.' day',strtotime($today)); //Book day
                                    $today = date('m,d',$clickDay);
                                    $url = url("/booking-form/$book->id/$today/$isUserBooking");

                                    

                                    if ($cont == 0) {
                                        echo "<tr>";
                                        echo "<td>$book->start_time </td>";
                                        if ( $book->moto_available <= 0 ) {
                                            echo "<td>
                                                <a class=\"btn btn-danger\" disabled > Unavailable </a>
                                            </td>";
                                        } else if ($isUserBooking == 0){
                                            echo "<td>
                                            <a class=\"btn btn-success\" id=\"$book->id\" type=\"button\" href=\"$url\">Booking</a>
                                            </td>";
                                        } else {
                                            echo "<td>
                                            <a class=\"btn btn-danger\" id=\"$book->id\" type=\"button\" href=\"$url\">Cancel Booking</a>
                                            </td>";
                                        }

                                        
                                        if ($cont == 0) { //Primer posicion de la fila
                                            $cont +=1;    
                                        }
                                        
                                                                    
                                    } else {
                                        if ( $book->moto_available <= 0 ) {
                                            echo "<td>
                                            <a class=\"btn btn-danger\" disabled > Unavailable</a>
                                            </td>";
                                        } else if ($isUserBooking == 0){
                                            echo "<td>
                                            <a class=\"btn btn-success\" id=\"$book->id\" type=\"button\" href=\"$url\">Booking</a>
                                            </td>";
                                        } else {
                                            echo "<td>
                                            <a class=\"btn btn-danger\" id=\"$book->id\" type=\"button\" href=\"$url\">Cancel Booking</a>
                                            </td>";
                                        }

                    
                                        if ($cont+1 > 6) {
                                            echo "</tr>";
                                            $cont = 0;
                                        } else {
                                            $cont+=1;
                                        }
                                    }
                                    
                                    
                                    $isUserBooking = 0;
                                }
                            @endphp
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
@endsection

