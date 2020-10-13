<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\MistakeReport;
use App\Company;
use Illuminate\Http\Request;
use App\Mail\ApprovedMail;
use App\Mail\CancelledMail;
use Illuminate\Support\Facades\Mail;

class MistakeReportController extends Controller
{
  /*===================================
      Display a listing of contacts
   ====================================*/
  public function index(Request $request)
  {
      $keyword = $request->get('search');
      $perPage = 10;

      if (!empty($keyword)) {
          $mistakes = MistakeReport::where('name', 'LIKE', "%$keyword%")
              ->orWhere('email', 'LIKE', "%$keyword%")
              ->orWhere('phone', 'LIKE', "%$keyword%")
              ->orWhere('object', 'LIKE', "%$keyword%")
              ->orWhereHas('company', function ($query) use ($keyword) {
                 $query->where('companyName', 'LIKE', "%$keyword%");})
              ->latest()->paginate($perPage);
      } else {
          $mistakes = MistakeReport::latest()->paginate($perPage);
      }

      $companies_id = Company::pluck('id')->toArray() ;

      return view('admin.mistakes.index', compact('mistakes' , 'companies_id'));
  }

  /*=========================================
   Remove the specified report from storage
  ===========================================*/
  public function show($id)
  {
    $mistake = MistakeReport::findOrFail($id);
    return view('admin.mistakes.show' , compact('mistake'));
  }


  /*=========================================
   Cancel the specified report from storage
  ===========================================*/
  public function cancel(Request $request , $id)
  {
    $mistake = MistakeReport::findOrFail($id);
    $mistake->update(['cancel' => 1]);
    Mail::to($mistake->email)->send(new CancelledMail($mistake));
    return redirect('admin/mistakes')->with('flash_message', 'Report cancelled!');
  }

  /*=======================================
    function for approved company by admin
  =========================================*/
  public function approved(Request $request, $id)
  {
    $mistake = MistakeReport::findOrFail($id);
    $company = Company::where('id' , $mistake->company_id)->first();
    $mistake->update(['status' => 1]);
    Mail::to($mistake->email)->send(new ApprovedMail($company));
    return redirect('admin/mistakes')->with('flash_message', 'Mistake approved!');
  }
}
