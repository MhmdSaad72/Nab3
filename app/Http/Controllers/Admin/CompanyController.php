<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Company;
use App\Country;
use App\Category;
use App\Degree;
use Illuminate\Http\Request;
use App\Mail\ConfirmationMail;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $company = Company::where('companyName', 'LIKE', "%$keyword%")
                ->orWhere('telephone', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $company = Company::latest()->paginate($perPage);
        }

        return view('admin.company.index', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $countries = Country::all();
        $categories = Category::all();
        $degrees = Degree::all();
        return view('admin.company.create' , compact('countries' , 'categories' , 'degrees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
    			'companyName' => 'required|min:2|max:30',
    			'telephone' => 'required|regex:/^([0-9\s\+\(\)]*)$/|min:11|max:100|unique:companies,telephone,NULL,id,deleted_at,NULL',
    			'telephone2' => 'nullable|regex:/^([0-9\s\+\(\)]*)$/|min:11|max:100|unique:companies,telephone2,NULL,id,deleted_at,NULL',
    			'telephone3' => 'nullable|regex:/^([0-9\s\+\(\)]*)$/|min:11|max:100|unique:companies,telephone3,NULL,id,deleted_at,NULL',
    			'fax' => 'nullable|max:20',
    			'zip' => 'nullable|max:20',
    			'postBox' => 'nullable|max:20',
    			'city' => 'required|min:3|max:20',
    			'location' => 'required|min:3|max:150',
    			'street' => 'required|min:3|max:60',
    			'url' => 'nullable|max:255|url',
    			'career' => 'required|min:2|max:20',
    			'email' => 'required|email|max:255|unique:companies,email,NULL,id,deleted_at,NULL',
    			'logo_path' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg||max:255',
    			'bio' => 'nullable|max:255',
    			// 'pageView' => 'required',
    			'fb' => 'nullable|max:255|url',
    			'linkedin' => 'nullable|max:255|url',
    			'twitter' => 'nullable|max:255|url',
    			'insta' => 'nullable|max:255|url',
    			// 'status' => 'nullable|max:100',
    			// 'featured' => 'nullable|max:100',
    			'country_id' => 'required',
    			'category_id' => 'required',
    			'degree_id' => 'required',
    		]);
        $requestData = $request->all();
        $requestData['status'] = 1 ;


        if ($request->hasFile('logo_path')) {
            $requestData['logo_path'] = $request->file('logo_path')
                                            ->store('uploads', 'public');
        }

        Company::create($requestData);

        return redirect('admin/company')->with('flash_message', 'Company added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);

        return view('admin.company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $countries = Country::all();
        $categories = Category::all();
        $degrees = Degree::all();

        return view('admin.company.edit', compact('company' , 'countries' , 'categories' , 'degrees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
    			'companyName' => 'required|min:2|max:30',
    			'telephone' => 'required|regex:/^([0-9\s\+\(\)]*)$/|max:100|unique:companies,telephone,' . $id . ',id,deleted_at,NULL',
    			'telephone2' => 'nullable|regex:/^([0-9\s\+\(\)]*)$/|max:100|unique:companies,telephone2,' . $id . ',id,deleted_at,NULL',
    			'telephone3' => 'nullable|regex:/^([0-9\s\+\(\)]*)$/|max:100|unique:companies,telephone3,' . $id . ',id,deleted_at,NULL',
    			'fax' => 'nullable|max:20',
    			'zip' => 'nullable|max:20',
    			'postBox' => 'nullable|max:20',
    			'city' => 'required|min:3|max:20',
    			'location' => 'required|min:3|max:150',
    			'street' => 'required|min:3|max:60',
    			'url' => 'nullable|max:255|url',
    			'career' => 'required|min:2|max:20',
    			'email' => 'required|email|max:255|unique:companies,email,' . $id . ',id,deleted_at,NULL',
    			'logo_path' => 'file|image|mimes:jpeg,png,jpg,gif,svg||max:255',
    			'bio' => 'nullable|max:255',
    			// 'pageView' => 'required',
    			'fb' => 'nullable|max:255|url',
    			'linkedin' => 'nullable|max:255|url',
    			'twitter' => 'nullable|max:255|url',
    			'insta' => 'nullable|max:255|url',
    			'status' => 'nullable|max:100',
    			'featured' => 'nullable|max:100',
    			'country_id' => 'required',
    			'category_id' => 'required',
    			'degree_id' => 'required',
        ]);
        $requestData = $request->all();

        if ($request->hasFile('logo_path')) {
            $requestData['logo_path'] = $request->file('logo_path')
                                            ->store('uploads', 'public');
        }

        $company = Company::findOrFail($id);
        $company->update($requestData);

        return redirect('admin/company')->with('flash_message', 'Company updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Company::destroy($id);

        return redirect('admin/company')->with('flash_message', 'Company deleted!');
    }


    /*=======================================
      function for approved company by admin
    =========================================*/
    public function approved(Request $request, $id)
    {
      $company = Company::findOrFail($id);
      $company->update(['status' => 1]);
      Mail::to($company->email)->send(new ConfirmationMail($company));
      return redirect('admin/company')->with('flash_message', 'Company approved!');
    }
}
