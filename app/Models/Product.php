<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'price', 'stock', 'comment', 'company_id'];
    
    public function getList() {
        $query = DB::table('products')->get();
        return $query;
    }

    public function editProduct($data) {
        DB::table('products')->insert([
            'id' => $data->id,
            'img_path' => $data->img_path,
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'company_id' => $data->company_id,
            'comment' => $data->comment,
        ]);
    }

    public function detailProduct($data) {
        DB::table('products')->insert([
            'id' => $data->id,
            'img_path' => $data->img_path,
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'company_id' => $data->company_id,
            'comment' => $data->comment,
        ]);
    }

    public function registProduct($data, $imagePath) {
        DB::table('products')->insert([
            'img_path' => $imagePath,
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'company_id' => $data->company_id,
            'comment' => $data->comment,
        ]);
    }

    public function searchProduct($name, $company) {
        $query = self::query();

        if ($name) {
            $query->where('product_name', 'like', '%' . $name . '%');
        }
        if ($company) {
            $query->where('company_id', $company);
        }
        $products = $query->get();

        return $products;
    }

     public function company() {
         return $this->belongsTo(Company::class);
     }
}