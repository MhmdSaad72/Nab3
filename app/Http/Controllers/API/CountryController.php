<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;

use App\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
  /*==========================
    Display all companies
  ============================*/
  public function allCountries(Request $request)
  {
        $validator = Validator::make($request->all(), [
          'lang' => 'required',
         ]);

       if ($validator->fails()) {
           return response()->json([
             'message' => $validator->errors(),
             'code' => 400
           ] , 400);
        }

        $perPage = $request->per_page ;
        $lang = $request->lang ;

        if ($lang == 'ar') {
            if (!$perPage || $perPage == 0) {
                $countries = Country::select('id' , 'arabic_title as title')->get();
            }else {
                $countries = Country::select('id' , 'arabic_title as title')->paginate($perPage);
            }
        }elseif ($lang == 'en') {
            if (!$perPage || $perPage == 0) {
                $countries = Country::select('id' , 'title')->get();
            }else {
                $countries = Country::select('id' , 'title')->paginate($perPage);
            }
        }else {
          return response()->json([
            'message' => 'invalid lang , available (ar / en)',
            'code' => 400,
          ] , 400);
        }


        if ($countries->count() == 0) {
          return response()->json(['message' => 'no country found' , 'code' => 404] , 404);
        }

        return response()->json([
          'countries' => $countries ,
          'code' => 200,
        ] , 200);
  }
}
