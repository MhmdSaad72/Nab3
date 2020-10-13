<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;

use App\Company;
use App\Country;
use App\Category;
use App\Degree;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\CompanyMail;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
   /*================================
     Display a listing of  companies
   ==================================*/
   public function allCompanies(Request $request)
   {
       $perPage = $request->per_page ;
       $category_id = $request->category_id ;

       if (!$perPage || $perPage == 0) {
         // condition for category id
         if ($category_id) {
           $companies = Company::select('id' , 'companyName')->where('status' , 1)->where('category_id' , $category_id)->get();
         }else {
           $companies = Company::select('id' , 'companyName')->where('status' , 1)->get();
         }

       }else {
         // condition for category id
         if ($category_id) {
           $companies = Company::select('id' , 'companyName')->where('status' , 1)->where('category_id' , $category_id)->paginate($perPage);
         }else {
           $companies = Company::select('id' , 'companyName')->where('status' , 1)->paginate($perPage);
         }

       }

       if ($companies->count() == 0) {
         return response()->json(['message' => 'no company found' , 'code' => 404] , 404);
       }

       return response()->json([
         'companies' => $companies ,
         'code' => 200,
       ] , 200);
   }

   /*==================================
     Show all details for one company
   ====================================*/
   public function company(Request $request)
   {
       $validator = Validator::make($request->all(), [
          'id' => 'required',
        ]);

      if ($validator->fails()) {
          return response()->json([
            'message' => $validator->errors(),
            'code' => 400
          ] , 400);
       }

       $company_id = $request->id ;

      // company related to request id
       $company = Company::where('id' , $company_id)->where('status' , 1)->first();
       if (!$company) {
         return response()->json([
           'message' => 'company not found',
           'code' => 404 ,
         ] , 404);
       }
       $page_view = $company->pageView ? $company->pageView + 1 : 1 ;
       $company->update(['pageView' => $page_view]);
       // assign complete path to logo_path
       $company->logo_path = $company->logo_path ? asset('storage/' . $company->logo_path) : NULL;
       $company->makeHidden(['created_at' , 'updated_at' , 'deleted_at' , 'latest_search']);
       return response()->json([
         'company' => $company ,
         'code' => 200 ,
       ] , 200);

   }

   /*=========================================
     Display companies related to search word
   ===========================================*/
   public function search(Request $request)
   {
       $validator = Validator::make($request->all(), [
          'word' => 'required',
        ]);

      if ($validator->fails()) {
          return response()->json([
            'message' => $validator->errors(),
            'code' => 400
          ] , 400);
       }

       $keyword = $request->word ;
       $perPage = $request->per_page ;
       if (!$perPage || $perPage == 0) {
         $companies = Company::where('status', 1)
             ->where(function($query) use ($keyword){
                 $query->where('companyName', 'LIKE', "%$keyword%")
                       ->orWhere('telephone', 'LIKE', "%$keyword%")
                       ->orWhere('email', 'LIKE', "%$keyword%")
                       ->orWhere('telephone2', 'LIKE', "%$keyword%")
                       ->orWhere('telephone3', 'LIKE', "%$keyword%")
                       ->orWhere('fax', 'LIKE', "%$keyword%")
                       ->orWhere('zip', 'LIKE', "%$keyword%")
                       ->orWhere('postBox', 'LIKE', "%$keyword%")
                       ->orWhere('city', 'LIKE', "%$keyword%")
                       ->orWhere('location', 'LIKE', "%$keyword%")
                       ->orWhere('street', 'LIKE', "%$keyword%")
                       ->orWhere('url', 'LIKE', "%$keyword%")
                       ->orWhere('career', 'LIKE', "%$keyword%")
                       ->orWhere('bio', 'LIKE', "%$keyword%")
                       // ->orWhere('pageView', 'LIKE', "%$keyword%")
                       ->orWhere('fb', 'LIKE', "%$keyword%")
                       ->orWhere('linkedin', 'LIKE', "%$keyword%")
                       ->orWhere('twitter', 'LIKE', "%$keyword%")
                       ->orWhere('insta', 'LIKE', "%$keyword%")
                       ->orWhereHas('country', function ($query) use ($keyword) {
                          $query->where('title', 'LIKE', "%$keyword%");})
                       ->orWhereHas('category', function ($query) use ($keyword) {
                          $query->where('title', 'LIKE', "%$keyword%");})
                       ->orWhereHas('degree', function ($query) use ($keyword) {
                          $query->where('title', 'LIKE', "%$keyword%");});
                        })
                    ->select('id','companyName' , 'logo_path' , 'url' , 'email' , 'telephone' , 'category_id' , 'career' , 'fax' , 'city' , 'country_id' , 'fb' , 'insta' , 'twitter' , 'linkedin')
                    ->get();
       }else {
         $companies = Company::where('status' , 1)
           ->where(function($query) use ($keyword){
             $query->where('companyName', 'LIKE', "%$keyword%")
               ->orWhere('telephone', 'LIKE', "%$keyword%")
               ->orWhere('email', 'LIKE', "%$keyword%")
               ->orWhere('telephone2', 'LIKE', "%$keyword%")
               ->orWhere('telephone3', 'LIKE', "%$keyword%")
               ->orWhere('fax', 'LIKE', "%$keyword%")
               ->orWhere('zip', 'LIKE', "%$keyword%")
               ->orWhere('postBox', 'LIKE', "%$keyword%")
               ->orWhere('city', 'LIKE', "%$keyword%")
               ->orWhere('location', 'LIKE', "%$keyword%")
               ->orWhere('street', 'LIKE', "%$keyword%")
               ->orWhere('url', 'LIKE', "%$keyword%")
               ->orWhere('career', 'LIKE', "%$keyword%")
               ->orWhere('bio', 'LIKE', "%$keyword%")
               // ->orWhere('pageView', 'LIKE', "%$keyword%")
               ->orWhere('fb', 'LIKE', "%$keyword%")
               ->orWhere('linkedin', 'LIKE', "%$keyword%")
               ->orWhere('twitter', 'LIKE', "%$keyword%")
               ->orWhere('insta', 'LIKE', "%$keyword%")
               ->orWhereHas('country', function ($query) use ($keyword) {
                  $query->where('title', 'LIKE', "%$keyword%");})
               ->orWhereHas('category', function ($query) use ($keyword) {
                  $query->where('title', 'LIKE', "%$keyword%");})
               ->orWhereHas('degree', function ($query) use ($keyword) {
                  $query->where('title', 'LIKE', "%$keyword%");});
                })
             ->select('id','companyName' , 'logo_path' , 'url' , 'email' , 'telephone' , 'category_id' , 'career' , 'fax' , 'city' , 'country_id' , 'fb' , 'insta' , 'twitter' , 'linkedin')
             ->paginate($perPage);
       }

       if ($companies->count() == 0) {
         return response()->json([
           'message' => 'No result found',
           'code' => 204
         ] , 400);
       }

       foreach ($companies as $key => $value) {
         $value->update(['latest_search' => Carbon::now()]);
         $value->logo_path = $value->logo_path ? asset('storage/' . $value->logo_path) : NULL;
         $value->makeHidden(['created_at' , 'updated_at' , 'deleted_at' , 'id' , 'latest_search']);
       }

       return response()->json([
         'companies' => $companies ,
         'code' => 200,
       ] , 200);
   }


   /*=============================================
     Display companies related to advanced serach
   ===============================================*/
   public function advanced_search(Request $request)
   {
       $validator = Validator::make($request->all(), [
          'word' => 'required',
        ]);

      if ($validator->fails()) {
          return response()->json([
            'message' => $validator->errors(),
            'code' => 400
          ] , 400);
       }

       $keyword = $request->word ;
       $country_id = $request->country_id;
       $category_id = $request->category_id ;



       if (!$country_id && !$category_id) {
           return response()->json([
             'message' => 'please select country id or category id at least',
             'code' => 400,
           ] , 400);
       }else {

         if ($country_id && !$category_id) {
           $country = Country::find($country_id);
           if (!$country) { return response()->json(['message' => 'country not found','code' => 404 ,] , 404);}

           $companies = Company::where('country_id' , $country_id)
               ->where('status' , 1)
               ->where(function($query) use ($keyword){
                   $query->where('companyName', 'LIKE', "%$keyword%")
                   ->orWhere('telephone', 'LIKE', "%$keyword%")
                   ->orWhere('email', 'LIKE', "%$keyword%")
                   ->orWhere('telephone2', 'LIKE', "%$keyword%")
                   ->orWhere('telephone3', 'LIKE', "%$keyword%")
                   ->orWhere('fax', 'LIKE', "%$keyword%")
                   ->orWhere('zip', 'LIKE', "%$keyword%")
                   ->orWhere('postBox', 'LIKE', "%$keyword%")
                   ->orWhere('city', 'LIKE', "%$keyword%")
                   ->orWhere('location', 'LIKE', "%$keyword%")
                   ->orWhere('street', 'LIKE', "%$keyword%")
                   ->orWhere('url', 'LIKE', "%$keyword%")
                   ->orWhere('career', 'LIKE', "%$keyword%")
                   ->orWhere('bio', 'LIKE', "%$keyword%")
                   // ->orWhere('pageView', 'LIKE', "%$keyword%")
                   ->orWhere('fb', 'LIKE', "%$keyword%")
                   ->orWhere('linkedin', 'LIKE', "%$keyword%")
                   ->orWhere('twitter', 'LIKE', "%$keyword%")
                   ->orWhere('insta', 'LIKE', "%$keyword%")
                   ->orWhereHas('country', function ($query) use ($keyword) {
                      $query->where('title', 'LIKE', "%$keyword%");})
                   ->orWhereHas('category', function ($query) use ($keyword) {
                      $query->where('title', 'LIKE', "%$keyword%");})
                   ->orWhereHas('degree', function ($query) use ($keyword) {
                      $query->where('title', 'LIKE', "%$keyword%");})
                  ;})
                  ->select('id','companyName' , 'logo_path' , 'url' , 'email' , 'telephone' , 'category_id' , 'career' , 'fax' , 'city' , 'country_id' , 'fb' , 'insta' , 'twitter' , 'linkedin')
                  ->get();
         }elseif (!$country_id && $category_id) {
           $category = Category::find($category_id);
           if (!$category) { return response()->json(['message' => 'category not found','code' => 404 ,] , 404);}

           $companies = Company::where('category_id' , $category_id)
           ->where('status' , 1)
           ->where(function($query) use ($keyword){
               $query->where('companyName', 'LIKE', "%$keyword%")
               ->orWhere('telephone', 'LIKE', "%$keyword%")
               ->orWhere('email', 'LIKE', "%$keyword%")
               ->orWhere('telephone2', 'LIKE', "%$keyword%")
               ->orWhere('telephone3', 'LIKE', "%$keyword%")
               ->orWhere('fax', 'LIKE', "%$keyword%")
               ->orWhere('zip', 'LIKE', "%$keyword%")
               ->orWhere('postBox', 'LIKE', "%$keyword%")
               ->orWhere('city', 'LIKE', "%$keyword%")
               ->orWhere('location', 'LIKE', "%$keyword%")
               ->orWhere('street', 'LIKE', "%$keyword%")
               ->orWhere('url', 'LIKE', "%$keyword%")
               ->orWhere('career', 'LIKE', "%$keyword%")
               ->orWhere('bio', 'LIKE', "%$keyword%")
               // ->orWhere('pageView', 'LIKE', "%$keyword%")
               ->orWhere('fb', 'LIKE', "%$keyword%")
               ->orWhere('linkedin', 'LIKE', "%$keyword%")
               ->orWhere('twitter', 'LIKE', "%$keyword%")
               ->orWhere('insta', 'LIKE', "%$keyword%")
               ->orWhereHas('country', function ($query) use ($keyword) {
                  $query->where('title', 'LIKE', "%$keyword%");})
               ->orWhereHas('category', function ($query) use ($keyword) {
                  $query->where('title', 'LIKE', "%$keyword%");})
               ->orWhereHas('degree', function ($query) use ($keyword) {
                  $query->where('title', 'LIKE', "%$keyword%");})
               ;})
               ->select('id','companyName' , 'logo_path' , 'url' , 'email' , 'telephone' , 'category_id' , 'career' , 'fax' , 'city' , 'country_id' , 'fb' , 'insta' , 'twitter' , 'linkedin')
               ->get();
         }else {
           $category = Category::find($category_id);
           if (!$category) { return response()->json(['message' => 'category not found','code' => 404 ,] , 404);}
           $country = Country::find($country_id);
           if (!$country) { return response()->json(['message' => 'country not found','code' => 404 ,] , 404);}

           $companies = Company::where('country_id' , $country_id)
               ->where('category_id' , $category_id)
               ->where('status' , 1)
               ->where(function($query) use ($keyword){
                 $query->where('companyName', 'LIKE', "%$keyword%")
                 ->orWhere('telephone', 'LIKE', "%$keyword%")
                 ->orWhere('email', 'LIKE', "%$keyword%")
                 ->orWhere('telephone2', 'LIKE', "%$keyword%")
                 ->orWhere('telephone3', 'LIKE', "%$keyword%")
                 ->orWhere('fax', 'LIKE', "%$keyword%")
                 ->orWhere('zip', 'LIKE', "%$keyword%")
                 ->orWhere('postBox', 'LIKE', "%$keyword%")
                 ->orWhere('city', 'LIKE', "%$keyword%")
                 ->orWhere('location', 'LIKE', "%$keyword%")
                 ->orWhere('street', 'LIKE', "%$keyword%")
                 ->orWhere('url', 'LIKE', "%$keyword%")
                 ->orWhere('career', 'LIKE', "%$keyword%")
                 ->orWhere('bio', 'LIKE', "%$keyword%")
                 // ->orWhere('pageView', 'LIKE', "%$keyword%")
                 ->orWhere('fb', 'LIKE', "%$keyword%")
                 ->orWhere('linkedin', 'LIKE', "%$keyword%")
                 ->orWhere('twitter', 'LIKE', "%$keyword%")
                 ->orWhere('insta', 'LIKE', "%$keyword%")
                 ->orWhereHas('country', function ($query) use ($keyword) {
                    $query->where('title', 'LIKE', "%$keyword%");})
                 ->orWhereHas('category', function ($query) use ($keyword) {
                    $query->where('title', 'LIKE', "%$keyword%");})
                 ->orWhereHas('degree', function ($query) use ($keyword) {
                    $query->where('title', 'LIKE', "%$keyword%");})
               ;})
               ->select('id', 'companyName' , 'logo_path' , 'url' , 'email' , 'telephone' , 'category_id' , 'career' , 'fax' , 'city' , 'country_id' , 'fb' , 'insta' , 'twitter' , 'linkedin')
               ->get();
         }

         if ($companies->count() == 0) {
           return response()->json([
             'message' => 'no result found',
             'code' => 204
           ] , 400);
         }

         foreach ($companies as $key => $value) {
           $value->update(['latest_search' => Carbon::now()]);
           $value->logo_path = $value->logo_path ? asset('storage/' . $value->logo_path) : NULL;
           $value->makeHidden(['created_at' , 'updated_at' , 'deleted_at' , 'id' , 'latest_search']);
         }

         return response()->json([
           'companies' => $companies,
           'code' => 200,
           ] , 200);
       }
   }

   /*====================
     Create new company
   ======================*/
   public function createCompany(Request $request)
   {
       $validator = Validator::make($request->all(), [
         'companyName' => 'required|min:2|max:30',
         'telephone' => 'required|regex:/^([0-9\s\+\(\)]*)$/|min:11|max:100|unique:companies,telephone,NULL,id,deleted_at,NULL',
         'telephone2' => 'nullable|regex:/^([0-9\s\+\(\)]*)$/|min:11|max:100|unique:companies,telephone2,NULL,id,deleted_at,NULL',
         'telephone3' => 'nullable|regex:/^([0-9\s\+\(\)]*)$/|min:11|max:100|unique:companies,telephone3,NULL,id,deleted_at,NULL',
         'fax' => 'nullable|max:100',
         'zip' => 'nullable|max:100',
         'postBox' => 'nullable|max:100',
         'city' => 'required|min:3|max:20',
         'location' => 'required|min:3|max:150',
         'street' => 'required|min:3|max:60',
         'url' => 'nullable|max:255|url',
         'career' => 'required|min:2|max:20',
         'email' => 'required|email|max:255|unique:companies,email,NULL,id,deleted_at,NULL',
         'logo_path' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:255',
         'fb' => 'nullable|max:255|url',
         'bio' => 'nullable|max:255',
         // 'pageView' => 'required',
         'linkedin' => 'nullable|max:255|url',
         'twitter' => 'nullable|max:255|url',
         'insta' => 'nullable|max:255|url',
         'country_id' => 'required|integer',
         'category_id' => 'required|integer',
         'degree_id' => 'required|integer',
        ]);


      if ($validator->fails()) {
          return response()->json([
            'message' => $validator->errors(),
            'code' => 400
          ] , 400);
       }

       $requestData = $request->all();
       $country = Country::find($requestData['country_id']);
       $category = Category::find($requestData['category_id']);
       $degree = Degree::find($requestData['degree_id']);

       if (!$country) {
         return response()->json([
           'message' => 'no country found for this id',
           'code' => 404,
         ] , 404);
       }
       if (!$category) {
         return response()->json([
           'message' => 'no category found for this id',
           'code' => 404,
         ] , 404);
       }
       if (!$degree) {
         return response()->json([
           'message' => 'no degree found for this id',
           'code' => 404,
         ] , 404);
       }


       $company = Company::create($requestData);
       Mail::to($company->email)->send(new CompanyMail($company));

       return response()->json([
         'message' => 'Company created successfully',
         'code' => 201
       ] , 201);


   }

   /*===========================================
     Display latest search result for companies
   =============================================*/
   public function latestSearch(Request $request)
   {
       $perPage = $request->per_page ;

       if (!$perPage || $perPage == 0) {
         $companies = Company::select('id' , 'companyName')->where('status',1)->whereNotNull('latest_search')->take(10)->orderBy('latest_search' , 'desc')->get();
       }else {
         $companies = Company::select('id' , 'companyName')->where('status',1)->whereNotNull('latest_search')->orderBy('latest_search' , 'desc')->paginate($perPage);
       }

       if ($companies->count() == 0) {
         return response()->json(['message' => 'no company found' , 'code' => 404] , 404);
       }

       return response()->json([
         'companies' => $companies ,
         'code' => 200,
       ] , 200);
   }

   /*====================================
       Display all featured companies
   ======================================*/
   public function featuredCompanies(Request $request)
   {
     $perPage = $request->per_page ;

     if (!$perPage || $perPage == 0) {
       $companies = Company::select('id' , 'companyName')->where('status',1)->where('featured', 1)->get();
     }else {
       $companies = Company::select('id' , 'companyName')->where('status',1)->where('featured', 1)->paginate($perPage);
     }

     if ($companies->count() == 0) {
       return response()->json(['message' => 'no company found' , 'code' => 404] , 404);
     }

     return response()->json([
       'companies' => $companies ,
       'code' => 200,
     ] , 200);
   }

}
