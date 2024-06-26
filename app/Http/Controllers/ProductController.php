<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function list() {
        $products = Product::all();
        $companies = Company::all();
        return view('list', compact('products', 'companies'));
    }
    public function showRegistForm() {
        $companies = Company::all();
        return view('regist', compact('companies'));
    }


    public function showDetail($id) {
        $product = Product::find($id);
        $companies = Company::all();
        if (!$product) {
            abort(404);
        }
        $company = $product->company;
        return view('detail', compact('product', 'company'));
    }

    public function registSubmit(ProductRequest $request) {
        DB::beginTransaction();
        try {
            $image = $request->file('img_path');
            $imagePath = null;
            if ($image) {
                $file_name = $image->getClientOriginalName();
                $image->storeAs('public/images', $file_name);
                $imagePath = 'storage/images/' . $file_name;
            }
            
            $model = new Product();
            $model->registProduct($request, $imagePath);
    
            DB::commit();
            return redirect()->route('regist')->with('success', '商品を保存しました');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', '商品の保存中にエラーが発生しました');
        }
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
        $companies = Company::all();
        return view('edit', compact('product', 'companies'));
    }

    public function update(Request $request, $productId){
        DB::beginTransaction();
        try {
            $product = Product::find($productId);
                if (!$product) {
                    abort(404);
                }

            $image = $request->file('img_path');
            $imagePath = null;
            if ($image) {
                $file_name = $image->getClientOriginalName();
                $image->storeAs('public/images', $file_name);
                $imagePath = 'storage/images/' . $file_name;
                $product->img_path = $imagePath;
            }
            
            $product->update([
                'product_name' => $request->input('product_name'),
                'company_id' => $request->input('company_name'),
                'price' => $request->input('price'),
                'stock' => $request->input('stock'),
                'comment' => $request->input('comment'),
            ]);
            DB::commit();
        } 
        catch (\Exception $e) {
            DB::rollback();
        }
        $product = Product::find($productId);
        return redirect()->route('edit', $product->id);
    }

    public function search(Request $request)
    {
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $minStock = $request->input('minStock');
        $maxStock = $request->input('maxStock');

        $searchProductName = $request->input('searchProductName');
        $searchCompany = $request->input('searchCompany');
        $model = new Product();
        $products = $model->searchProduct($searchProductName, $searchCompany);
        $companies = Company::all();
        return view('list', compact('products', 'companies'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $product = Product::find($id);
            if (!$product) {
              abort(404);
            }
            $product->delete();
            DB::commit();
            return redirect()->route('list')->with('success', '削除が完了しました。');
        }
        catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', '削除中にエラーが発生しました。');
        }
    }
}