<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
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
            $country = Country::where('title', 'LIKE', "%$keyword%")
                ->orWhere('arabic_title', 'LIKE', "%$keyword%")
                ->orWhere('img_url', 'LIKE', "%$keyword%")
                ->orWhere('alt', 'LIKE', "%$keyword%")
                ->orWhere('imageTitle', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $country = Country::latest()->paginate($perPage);
        }

        return view('admin.country.index', compact('country'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.country.create');
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
          'title' => 'required|min:2|max:20',
          'arabic_title' => 'required|min:2|max:20',
          'img_url' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg',
          'alt' => 'required|min:2|max:50',
          'imageTitle' => 'required|min:2|max:20',
        ]);
        $requestData = $request->all();
        $requestData['img_url'] = $request->file('img_url')
        ->store('uploads', 'public');

        Country::create($requestData);

        return redirect('admin/country')->with('flash_message', 'Country added!');
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
        $country = Country::findOrFail($id);

        return view('admin.country.show', compact('country'));
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
        $country = Country::findOrFail($id);

        return view('admin.country.edit', compact('country'));
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
          'title' => 'required|min:2|max:20',
          'arabic_title' => 'required|min:2|max:20',
          'img_url' => 'file|image|mimes:jpeg,png,jpg,gif,svg',
          'alt' => 'required|min:2|max:50',
          'imageTitle' => 'required|min:2|max:20',
    		]);
        $requestData = $request->all();
        if ($request->hasFile('img_url')) {
            $requestData['img_url'] = $request->file('img_url')
                                              ->store('uploads', 'public');
        }

        $country = Country::findOrFail($id);
        $country->update($requestData);

        return redirect('admin/country')->with('flash_message', 'Country updated!');
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
        Country::destroy($id);

        return redirect('admin/country')->with('flash_message', 'Country deleted!');
    }
}
