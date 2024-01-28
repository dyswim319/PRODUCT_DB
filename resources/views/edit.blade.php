@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>商品情報編集画面</h1>
            <form action="{{ route('update', $product->id) }}" method="post">
                @csrf
                @method('PUT')

                <style>
                    .required:after {
                      content: ' *';
                      color: red;
                    }
                </style>

                <div class="form-group">
                    <label for="product_id">ID</label>
                    <span class="form-control-static">{{ $product->id }}</span>
                </div>

                <div class="form-group">
                    <label for="product_name" class="required">商品名</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}">
                </div>

                <div class="form-group">
                    <label for="manufacturer" class="required">メーカー</label>
                    <select class="form-control" id="manufacturer" name="manufacturer">
                        <option value="1" {{ $product->manufacturer_id == 1 ? 'selected' : '' }}>メーカー1</option>
                        <option value="2" {{ $product->manufacturer_id == 2 ? 'selected' : '' }}>メーカー2</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price" class="required">価格</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
                </div>

                <div class="form-group">
                    <label for="stock" class="required">在庫数</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}">
                </div>

                <div class="form-group">
                    <label for="comment">コメント</label>
                     <textarea class="form-control" id="comment" name="comment">{{ $product->comment }}</textarea>
                </div>

                <div class="form-group">
                    <label for="img_path">商品画像</label>
                    <input type="file" class="form-control" id="img_path" name="img_path" placeholder="Img_path" value="{{ old('img_path') }}">
                    @if($errors->has('img_path'))
                        <p>{{ $errors->first('img_path') }}</p>
                    @endif
                </div>


                <button type="submit" class="btn btn-primary">更新</button>
                <form action="{{ url()->previous() }}" method="get" style="display:inline;">
                    <button type="submit" class="btn btn-secondary">戻る</button>
                </form>
            </form>
        </div>
    </div>
</div>
@endsection