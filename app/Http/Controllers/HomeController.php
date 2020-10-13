<?php

namespace App\Http\Controllers;

use App\Company;
use App\Category;
use App\Degree;
use App\Country;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companies = Company::all()->count();
        $categories = Category::all()->count();
        $degrees = Degree::all()->count();
        $countries = Country::all()->count();
        return view('home' , compact('companies' , 'categories' , 'degrees' , 'countries'));
    }
}
