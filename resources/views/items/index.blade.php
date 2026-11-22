@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">商品一覧</h2>
    <a href="{{ route('items.create') }}" class="btn btn-primary">+ 新規登録</a>
</div>

{{-- 検索・絞り込みフォーム --}}
<div class="card shadow-sm mb-3">
    <div class="card-body">
        <form action="{{ route('items.index') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label for="keyword" class="form-label small mb-1">商品名 / JANコード</label>
                <input type="text" name="keyword" id="keyword" class="form-control form-control-sm" value="{{ request('keyword') }}" placeholder="キーワード入力">
            </div>
            <div class="col-md-3">
                <label for="category_id" class="form-label small mb-1">カテゴリ</label>
                <select name="category_id" id="category_id" class="form-select form-select-sm">
                    <option value="">すべて</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="supplier_id" class="form-label small mb-1">仕入先</label>
                <select name="supplier_id" id="supplier_id" class="form-select form-select-sm">
                    <option value="">すべて</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-center justify-content-between">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="low_stock" id="low_stock" value="1" {{ request('low_stock') ? 'checked' : '' }}>
                    <label class="form-check-label small" for="low_stock">在庫少のみ</label>
                </div>
                <div>
                    <button type="submit" class="btn btn-sm btn-primary">検索</button>
                    <a href="{{ route('items.index') }}" class="btn btn-sm btn-outline-secondary">クリア</a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- 商品一覧テーブル --}}
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle text-nowrap">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>商品名</th>
                    <th>JANコード</th>
                    <th>カテゴリ</th>
                    <th>仕入先</th>
                    <th class="text-end">単価</th>
                    <th class="text-end">現在庫数</th>
                    <th class="text-end">発注点</th>
                    <th>状態</th>
                    <th style="width: 140px;">操作</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    @php
                        $isLowStock = $item->stock_quantity <= $item->reorder_point;
                    @endphp
                    <tr class="{{ $isLowStock ? 'table-warning' : '' }}">
                        <td>{{ $item->id }}</td>
                        <td>
                            <a href="{{ route('items.show', $item) }}" class="fw-bold text-decoration-none">
                                {{ $item->name }}
                            </a>
                        </td>
                        <td>{{ $item->jan_code ?? '-' }}</td>
                        <td>{{ $item->category->name ?? '-' }}</td>
                        <td>{{ $item->supplier->name ?? '-' }}</td>
                        <td class="text-end">{{ number_format($item->unit_price) }}円</td>
                        <td class="text-end fw-bold">{{ number_format($item->stock_quantity) }}</td>
                        <td class="text-end">{{ number_format($item->reorder_point) }}</td>
                        <td>
                            @if ($isLowStock)
                                <span class="badge bg-danger">要発注</span>
                            @else
                                <span class="badge bg-success">適正</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('items.show', $item) }}" class="btn btn-sm btn-outline-secondary">詳細</a>
                            <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-outline-primary">編集</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-4">該当する商品がありません。</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $items->links() }}
</div>
@endsection