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
    public function list()
    {
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
        if (!$product) {
            abort(404);
        }
        return view('detail', ['product' => $product]);
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
            
            $product = new Product();
            $product->product_name = $request->input('product_name');
            $product->company_id = $request->input('company_name');
            $product->price = $request->input('price');
            $product->stock = $request->input('stock');
            $product->comment = $request->input('comment');
            $product->img_path = $imagePath;
            $product->save();
    
            DB::commit();
            return redirect()->route('regist')->with('success', '商品を保存しました');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', '商品の保存中にエラーが発生しました');
        }
    }

    public function detailSubmit(ProductRequest $request) {
        DB::beginTransaction();
        try {
            $model = new Product();
            $model->detailProduct($request);
            $image = $request->file('img_path');
            $imagePath = null;
            if ($image) {
                $file_name = $image->getClientOriginalName();
                $image->storeAs('public/images', $file_name);
                $imagePath = 'storage/images/' . $file_name;
            }
            $product->img_path = $imagePath;
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        return redirect(route('detail'));
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
            }
            $product->img_path = $imagePath;


            $product->update([
                'product_name' => $request->input('product_name'),
                'company_id' => $request->input('company_name'),
                'price' => $request->input('price'),
                'stock' => $request->input('stock'),
                'comment' => $request->input('comment'),
                'img_path' => $imagePath,
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