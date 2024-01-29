<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function showList() {
        $model = new Product();
        $products = $model->getList();

        return view('list', ['products' => $products]);
    }

    public function showRegistForm() {
        return view('regist');
    }

    public function registSubmit(ProductRequest $request) {

        DB::beginTransaction();
    
        try {
            $model = new Product();
            $model->registProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        return redirect(route('regist.form'));
    }

    public function showDetailForm() {
        return view('detail');
    }

    public function detailSubmit(ProductRequest $request) {

        DB::beginTransaction();
    
        try {
            $model = new Product();
            $model->detailProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

        return redirect(route('detail'));
    }

    public function showDetail($id) {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        return view('detail', ['product' => $product]);
    }


    public function regist() {
        return view('regist');
    }

    public function showProductDetails($productId) {
        $product = Product::find($productId);

        if (!$product) {
            abort(404);
        }    

        return view('edit', compact('product'));
    }


    public function show($productId)
    {
        $product = Product::find($productId);
        return view('detail', compact('product'));
    }


    public function edit($productId)
    {
        $product = Product::find($productId);
        return view('edit', compact('product'));
    }


    public function update(Request $request, $productId)
    {
        $product = Product::find($productId);
        $product->update($request->all());

        return redirect()->route('edit', $product->id);
    }

    public function list()
    {
        $products = Product::all();
        $companies = Company::all();
        return view('list', compact('products', 'companies'));
    }

    public function search(Request $request)
    {
        $searchProductName = $request->input('searchProductName');
        $searchCompany = $request->input('searchCompany');

        $query = Product::query();

        if ($searchProductName) {
            $query->where('product_name', 'like', '%' . $searchProductName . '%');
        }

        if ($searchCompany) {
            $query->where('company_id', $searchCompany);
        }

        $products = $query->get();
        $companies = Company::all();

        return view('list', compact('products', 'companies'));
    }

}