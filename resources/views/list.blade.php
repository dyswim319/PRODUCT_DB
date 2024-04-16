@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>商品情報一覧画面</h1>
            <form action="{{ route('search') }}" method="get">
                <div class="form-group">
                    <label for="searchProductName">商品名</label>
                    <input type="text" class="form-control" id="searchProductName" name="searchProductName" value="{{ old('searchProductName') }}" placeholder="商品名を入力">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="minPrice">最低価格</label>
                        <input type="number" class="form-control" id="minPrice" name="minPrice" value="{{ old('minPrice') }}" placeholder="最低価格">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="maxPrice">最高価格</label>
                        <input type="number" class="form-control" id="maxPrice" name="maxPrice" value="{{ old('maxPrice') }}" placeholder="最高価格">
                    </div>
                </div>
            
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="minStock">最低在庫数</label>
                        <input type="number" class="form-control" id="minStock" name="minStock" value="{{ old('minStock') }}" placeholder="最低在庫数">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="maxStock">最高在庫数</label>
                        <input type="number" class="form-control" id="maxStock" name="maxStock" value="{{ old('maxStock') }}" placeholder="最高在庫数">
                    </div>
                </div>

                <div class="form-group">
                    <label for="company_name">メーカー名</label>
                    <select class="form-control" id="company_name" name="company_name">
                        <option value="">すべてのメーカー</option>
                        @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">検索</button>
            </form>
            <table class="table">
                <thead>
                   <tr>
                     <th class="sortable" data-column="id">ID</th>
                     <th class="sortable" data-column="img_path">商品画像</th>
                     <th class="sortable" data-column="product_name">商品名</th>
                     <th class="sortable" data-column="price">価格</th>
                     <th class="sortable" data-column="stock">在庫数</th>
                     <th class="sortable" data-column="company_name">メーカー名</th>
                     <th>
                        <form action="{{ route('regist.form') }}" method="get" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">新規登録</button>
                        </form>
                     </th>
                   </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                       <td>{{ $product->id }}</td>
                       <td><img src="{{ asset($product->img_path) }}" alt="商品画像" width="100"></td>
                       <td>{{ $product->product_name }}</td>
                       <td>{{ $product->price }}</td>
                       <td>{{ $product->stock }}</td>
                       <td>
                            @if ($product->company)
                            {{ $product->company->company_name }}
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('detail', $product->id) }}" method="get" style="display:inline;">
                                <button type="submit" class="btn btn-primary">詳細</button>
                            </form>
                        
                            <form id="deleteForm_{{ $product->id }}" action="{{ route('delete', $product->id) }}" method="post" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $product->id }})">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(productId) {
        if (confirm("この商品を削除しますか？")) {
            document.getElementById('deleteForm_' + productId).submit();
        }
    }
</script>

@endsection
