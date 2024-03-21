<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function list() {
        $companies = Company::all();
        return view('list', compact('companies'));
    }

    public function detail() {
        $companies = Company::all();
        return view('detail', compact('companies'));
    }

    public function regist() {
        $companies = Company::all();
        return view('regist');
    }

    public function store(Request $request) {
        Company::create($request->all());
        return redirect()->route('list');
    }
}
