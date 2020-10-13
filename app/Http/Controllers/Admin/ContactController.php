<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
  /*===================================
      Display a listing of contacts
   ====================================*/
  public function index(Request $request)
  {
      $keyword = $request->get('search');
      $perPage = 10;

      if (!empty($keyword)) {
          $contacts = Contact::where('name', 'LIKE', "%$keyword%")
              ->orWhere('email', 'LIKE', "%$keyword%")
              ->orWhere('phone', 'LIKE', "%$keyword%")
              ->orWhere('object', 'LIKE', "%$keyword%")
              ->latest()->paginate($perPage);
      } else {
          $contacts = Contact::latest()->paginate($perPage);
      }

      return view('admin.contact.index', compact('contacts'));
  }

  /*=========================================
   Show the specified contact from storage
  ===========================================*/
  public function show($id)
  {
    $contact = Contact::findOrFail($id);
    return view('admin.contact.show' , compact('contact'));
  }


  /*=========================================
   Remove the specified contact from storage
  ===========================================*/
  public function destroy($id)
  {
    Contact::destroy($id);
    return redirect('admin/contacts')->with('flash_message', 'Contact deleted!');
  }
}
