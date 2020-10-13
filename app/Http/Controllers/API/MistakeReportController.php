<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;

use App\MistakeReport;
use App\Company;
use Illuminate\Http\Request;
use App\Mail\ReviewMail;
use Illuminate\Support\Facades\Mail;

class MistakeReportController extends Controller
{

  /*==================================
    Store mistake reports information
  ====================================*/
  public function mistake_report(Request $request)
  {
     $validator = Validator::make($request->all(), [
         'name'=>'required|max:30',
         'object'=>'required',
         'phone'=>'required|regex:/(01)[0-9]{9}/' ,
         'email' => 'required|email',
         'company_id' => 'required',
     ]);

       if ($validator->fails()) {
           return response()->json([
             'message' => $validator->errors(),
             'code' => 400
           ] , 400);
       }
       $company = Company::find($request->company_id);
       if (!$company) {
         return response()->json([
           'message' => 'company not found',
           'code' => 404,
         ] , 404);
       }
       $requestData = $request->all();
       $mistake = MistakeReport::create($requestData);
       Mail::to($mistake->email)->send(new ReviewMail($company));

       return response()->json([
         'message' => 'Report created successfully',
         'code' => 201
       ] , 201);
  }
}
