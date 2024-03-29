@extends('layouts.app')

@section('title', '投稿画面')

@section('content')
    <div class="container">
        <div class="row">
            <h1>商品新規登録画面</h1>
            <form action="{{ route('submit') }}" method="post" enctype="multipart/form-data">
                @csrf

                <style>
                    .required:after {
                      content: ' *';
                      color: red;
                    }
                  </style>

                <div class="form-group">
                    <label for="product_name" class="required">商品名</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name') }}">
                    @if($errors->has('product_name'))
                        <p>{{ $errors->first('product_name') }}</p>
                    @endif
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

                <div class="form-group">
                    <label for="price" class="required">価格</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}">
                    @if($errors->has('price'))
                        <p>{{ $errors->first('price') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="stock" class="required">在庫数</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}">
                    @if($errors->has('stock'))
                        <p>{{ $errors->first('stock') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="comment">コメント</label>
                    <textarea class="form-control" id="comment" name="comment">{{ old('comment') }}</textarea>
                    @if($errors->has('comment'))
                        <p>{{ $errors->first('comment') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="img_path">商品画像</label>
                    <input type="file" class="form-control" id="img_path" name="img_path" placeholder="Img_path" value="{{ old('img_path') }}">
                    @if($errors->has('img_path'))
                        <p>{{ $errors->first('img_path') }}</p>
                    @endif
                </div>
                    <button type="submit" class="btn btn-default">新規登録</button>
            </form>
            <form action="{{ url('/list') }}" method="get" style="display:inline;">
                <button type="submit" class="btn btn-secondary">戻る</button>
            </form>
        </div>
    </div>
@endsection