@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>商品情報詳細画面</h1>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td>{{ $product->id }}</td>
                </tr>
                <tr>
                    <th>商品画像</th>
                    <td><img src="{{ asset($product->img_path) }}" alt="商品画像" width="100"></td>
                </tr>
                <tr>
                    <th>商品名</th>
                    <td>{{ $product->product_name }}</td>
                </tr>
                <tr>
                    <th>メーカー名</th>
                    <td>{{ optional($product->company)->company_name }}</td>
                </tr>
                <tr>
                    <th>価格</th>
                    <td>{{ $product->price }}</td>
                </tr>
                <tr>
                    <th>在庫数</th>
                    <td>{{ $product->stock }}</td>
                </tr>
                <tr>
                    <th>コメント</th>
                    <td>{{ $product->comment }}</td>
                </tr>
                
            </table>
            <form action="{{ route('edit', $product->id) }}" method="get" style="display:inline;">
                <button type="submit" class="btn btn-primary">編集</button>
            </form>
            <form action="{{ url('/list') }}" method="get" style="display:inline;">
                <button type="submit" class="btn btn-secondary">戻る</button>
            </form>
        </div>
    </div>
</div>
@endsection