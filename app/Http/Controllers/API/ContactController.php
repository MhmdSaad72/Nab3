<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

  /*=============================
    Store contact us information
  ===============================*/
  public function contact_us(Request $request)
  {
     $validator = Validator::make($request->all(), [
         'name'=>'required|max:30',
         'object'=>'required',
         'phone'=>'required|regex:/(01)[0-9]{9}/' ,
         'email' => 'required|email'
     ]);

       if ($validator->fails()) {
           return response()->json([
             'message' => $validator->errors(),
             'code' => 400
           ] , 400);
       }
       $requestData = $request->all();
       $contact = Contact::create($requestData);

       return response()->json([
         'message' => 'Contact created successfully',
         'code' => 201
       ] , 201);
  }
}
