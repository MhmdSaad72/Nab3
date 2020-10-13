<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Degree;
use Illuminate\Http\Request;

class DegreeController extends Controller
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
            $degree = Degree::where('title', 'LIKE', "%$keyword%")
                ->orWhere('arabic_title', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $degree = Degree::latest()->paginate($perPage);
        }

        return view('admin.degree.index', compact('degree'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.degree.create');
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
    			'title' => 'required|min:2|max:20|regex:/^[a-zA-Z]/u|unique:degrees,title,NULL,id,deleted_at,NULL',
    			'arabic_title' => 'required|min:2|regex:/^[ء-ي]/u|max:20|unique:degrees,arabic_title,NULL,id,deleted_at,NULL'
    		]);
        $requestData = $request->all();

        Degree::create($requestData);

        return redirect('admin/degree')->with('flash_message', 'Degree added!');
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
        $degree = Degree::findOrFail($id);

        return view('admin.degree.show', compact('degree'));
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
        $degree = Degree::findOrFail($id);

        return view('admin.degree.edit', compact('degree'));
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
    			'title' => 'required|min:2|max:20|regex:/^[a-zA-Z]+$/u|unique:degrees,title,' . $id . ',id,deleted_at,NULL',
    			'arabic_title' => 'required|min:2|max:20|regex:/^[ء-ي]/u|unique:degrees,arabic_title,' . $id . ',id,deleted_at,NULL'
    		]);
        $requestData = $request->all();

        $degree = Degree::findOrFail($id);
        $degree->update($requestData);

        return redirect('admin/degree')->with('flash_message', 'Degree updated!');
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
        Degree::destroy($id);

        return redirect('admin/degree')->with('flash_message', 'Degree deleted!');
    }
}
