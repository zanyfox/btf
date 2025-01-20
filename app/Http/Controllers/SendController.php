<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;
use App\Models\Partner;

class SendController extends Controller {

  public function __invoke(Request $request) {
    
    $validator = Validator::make($request->all(), [
      'name' => 'required|min:2|max:100',
      'phone' => 'required'
    ]);

    if($validator->fails()) {
      return response()->json([
        'status' => 'fail',
        'message' => 'Validation errors',
        'errors' => $validator->errors()
      ]);
    }

    //$email = Auth::check() ? Auth::user()->email : $request->email;

    $name = $request->name;
    $surname = $request->surname;
    $city = $request->city;
    $company = $request->company;
    $phone = $request->phone;
    $email = $request->email;

    $partner = new Partner();
    $partner->fill([
      'company' => $company,
      'name' => $name,
      'surname' => $surname,
      'email' => $email,
      'phone' => $phone,
      'city' => $city,
      'order_by' => Partner::max('id') + 1,
      'status' => false
    ]);
    $partner->save();

    $appName = config('app.name');
    $content = "<h3>Новая заявка</h3>
      <p>С сайта $appName пришло новая заявка, от:<br>
      <p>
        Имя: <b>$name</b><br>
        Фамилия: <b>$surname</b><br>
        Телефон: <b>$phone</b><br>
        Email: <b>$email</b><br>
        Компания: <b>$company</b><br>
        Город: <b>$city</b>
      </p>";

    DB::insert('INSERT INTO messages (name, phone, email, content, status) VALUES(:name, :phone, :email, :content, :status)', [
      'name' => $name, 
      'phone' => $phone, 
      'email' => $email,
      'content' => $content,
      'status' => 'new'
    ]);


    $result = Mail::to('i.tader@btf39.su')->send(new FeedbackMail($name, $surname, $city, $company, $phone, $email));


    if(!$result) {
      return response()->json([
        'status' => 'fail',
        'message' => 'Email failed sent'
      ]);
    }

    return response()->json([
      'status' => 'success',
      'message' => 'Message successfully sent'
    ]);

  }

}
