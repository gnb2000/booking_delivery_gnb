<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User, App\Models\Booking, App\Models\Books;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function book(){
        $bookings = Books::select('id','cols','rows','start_time','moto_available')
                        ->orderBy('cols')
                        ->get();

        //Hacer la consulta a la DB para obtener las reservas del usuario logueado para ponerlas en rojo, buscar el book_id
        $currentUser = Auth::user()->id;
        $user_bookings = Booking::select('book_id')
                        ->where('user',$currentUser)
                        ->get();


        return view('booking',compact('bookings','user_bookings'));
    }

    public function booking_form(Request $request){
        if (!empty($request->all())){

            //Cambiar formato de fecha al correcto porque aparece con una "coma"
            $correctDay = str_replace(",","/",$request->day);

            //Actualizo el valor de motos disponibles de la reserva seleccionada
            $currentBook = Books::find($request->id);
            $currentBook->moto_available = $currentBook->moto_available - 1;
            $currentBook->save();

            //Genera la nueva reserva
            $newBook = new Booking();
            $newBook->user = Auth::user()->id;
            $newBook->origin = $request->origin;
            $newBook->dest = $request->dest;

            $newBook->book_date = $correctDay;
            $newBook->book_id = $request->id;
            $newBook->save();
            
            
            return redirect()->route('book')->with("success","Book has been created successfully");
        } else {

            if ($request->action == 1){
                //Actualizo el valor de motos disponibles de la reserva seleccionada
                $currentBook = Books::find($request->id);
                $currentBook->moto_available = $currentBook->moto_available + 1;
                $currentBook->save();

                //Elimino la reserva
                $deleteBook = Booking::where('book_id',$request->id);
                $deleteBook->delete();

                return redirect()->route('book')->with("success","Book has been deleted successfully");
            } else {
                $date_information = array (
                    'id' => $request->id,
                    'day' => $request->day,
                );
                return view('booking-form',compact('date_information'));
            }

            
        }

    }

    public function booking_admin(){
        $myBookings = Booking::join('books','bookings.book_id','books.id')
                        -> select('bookings.id as id','user','origin','dest','book_date','books.start_time as start_time','bookings.book_id as book_id')
                        ->where('user',Auth::user()->id)
                        ->get();


        return view('booking_admin',compact('myBookings'));
    }

    public function booking_delete($id = 0){
        //Actualizo el valor de motos disponibles de la reserva seleccionada
        echo $id;
        $currentBook = Books::find($id);
        $currentBook->moto_available = $currentBook->moto_available + 1;
        $currentBook->save();

        //Elimino la reserva
        $deleteBook = Booking::where('book_id',$id);
        $deleteBook->delete();

        return redirect()->route('bookingAdmin')->with("success","Book has been deleted successfully");
    }

    public function users_admin(){

        $users = User::select('id','name','address','phone','email','isADM')->get();


        return view('users_admin',compact('users'));
    }

    public function user_delete($id = 0){
        $user_delete = User::find($id);
        $user_delete->delete();

        return redirect()->route('usersAdmin')->with("success","User has been deleted successfully");
    }

    public function user_register(Request $request){

        if (!empty($request->all())){
            $newUser = new User();
            $newUser->name = $request->name;
            $newUser->email = $request->email;
            $newUser->phone = $request->phone;
            $newUser->address = $request->address;
            $newUser->isADM = $request->role;
            $newUser->password = Hash::make($request->password);
            $newUser->save();
            return redirect()->route('usersAdmin')->with("success","User has been created successfully");

        } else {
            return view ('newUser');
        }
    }

    public function booking_edit(Request $request, $id = 0){

        if (!empty($request->all())){
            $updateBooking = Booking::find($id);
            $updateBooking->origin = $request->origin;
            $updateBooking->dest = $request->dest;
            $updateBooking->save();



            return redirect()->route('bookingAdmin')->with("success","Book has been modified successfully");
        } else {
            $booking = Booking::select('id','origin','dest')
                        ->where('id',$id)
                        ->first();
            
            return view('booking_edit',compact('booking'));
        }
        

        

    }
}
