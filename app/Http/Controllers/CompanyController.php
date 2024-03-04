<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('list', compact('companies'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('regist');
    }

    public function store(Request $request)
    {
        Company::create($request->all());
        return redirect()->route('list');
    }
}
