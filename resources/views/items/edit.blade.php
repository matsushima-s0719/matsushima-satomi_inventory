@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h2 class="h5 mb-0">商品編集</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('items.update', $item) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">商品名 <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $item->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jan_code" class="form-label">JANコード</label>
                        <input type="text" name="jan_code" id="jan_code" class="form-control @error('jan_code') is-invalid @enderror" value="{{ old('jan_code', $item->jan_code) }}">
                        @error('jan_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label">カテゴリ <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="supplier_id" class="form-label">仕入先 <span class="text-danger">*</span></label>
                            <select name="supplier_id" id="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror">
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id', $item->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="unit_price" class="form-label">単価（円） <span class="text-danger">*</span></label>
                            <input type="number" name="unit_price" id="unit_price" class="form-control @error('unit_price') is-invalid @enderror" value="{{ old('unit_price', $item->unit_price) }}" min="0">
                            @error('unit_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">現在庫数（変更不可）</label>
                            <input type="text" class="form-control bg-light" value="{{ $item->stock_quantity }}" disabled>
                            <div class="form-text">在庫数は入出庫登録から変更します。</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="reorder_point" class="form-label">発注点 <span class="text-danger">*</span></label>
                            <input type="number" name="reorder_point" id="reorder_point" class="form-control @error('reorder_point') is-invalid @enderror" value="{{ old('reorder_point', $item->reorder_point) }}" min="0">
                            @error('reorder_point')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">商品説明</label>
                        <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $item->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('items.show', $item) }}" class="btn btn-secondary">戻る</a>
                        <button type="submit" class="btn btn-primary">更新する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection