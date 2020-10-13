<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  /*================================
    Display a listing of categories
  ==================================*/
  public function allCategories(Request $request)
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
              $categories = Category::select('id' , 'arabic_title as title')->get();
          }else {
              $categories = Category::select('id' , 'arabic_title as title')->paginate($perPage);
          }
      }elseif ($lang == 'en') {
          if (!$perPage || $perPage == 0) {
            $categories = Category::select('id' , 'title')->get();
          }else {
            $categories = Category::select('id' , 'title')->paginate($perPage);
          }
      }else {
        return response()->json([
          'message' => 'invalid lang , available (ar / en)',
          'code' => 400,
        ] , 400);
      }



      if ($categories->count() == 0) {
        return response()->json(['message' => 'no category found' , 'code' => 404] , 404);
      }

      return response()->json([
        'categories' => $categories ,
        'code' => 200,
      ] , 200);
  }
}
