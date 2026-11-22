@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">商品詳細</h2>
    <div>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">一覧へ戻る</a>
        <a href="{{ route('items.edit', $item) }}" class="btn btn-primary">編集</a>
        <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('この商品を削除しますか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除</button>
        </form>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <table class="table table-bordered mb-0">
            <tbody>
                <tr>
                    <th class="table-light" style="width: 200px;">商品ID</th>
                    <td>{{ $item->id }}</td>
                </tr>
                <tr>
                    <th class="table-light">商品名</th>
                    <td class="fw-bold">{{ $item->name }}</td>
                </tr>
                <tr>
                    <th class="table-light">JANコード</th>
                    <td>{{ $item->jan_code ?? '-' }}</td>
                </tr>
                <tr>
                    <th class="table-light">カテゴリ</th>
                    <td>{{ $item->category->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th class="table-light">仕入先</th>
                    <td>{{ $item->supplier->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th class="table-light">単価</th>
                    <td>{{ number_format($item->unit_price) }}円</td>
                </tr>
                <tr>
                    <th class="table-light">現在庫数</th>
                    <td>
                        <span class="fs-5 fw-bold">{{ number_format($item->stock_quantity) }}</span>
                        @if ($item->stock_quantity <= $item->reorder_point)
                            <span class="badge bg-danger ms-2">発注点以下（要発注）</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="table-light">発注点</th>
                    <td>{{ number_format($item->reorder_point) }}</td>
                </tr>
                <tr>
                    <th class="table-light">商品説明</th>
                    <td>{!! nl2br(e($item->description ?? '-')) !!}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

{{-- 直近の入出庫履歴 --}}
<div class="d-flex justify-content-between align-items-center mb-2">
    <h3 class="h5 mb-0">直近の入出庫履歴</h3>
    {{-- 次のステップで入出庫登録画面へ繋ぎます --}}
    <a href="#" class="btn btn-sm btn-success">+ 入出庫を登録</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-sm table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>日時</th>
                    <th>種別</th>
                    <th class="text-end">数量</th>
                    <th>担当者</th>
                    <th>備考</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($movements as $movement)
                    <tr>
                        <td>{{ $movement->created_at->format('Y/m/d H:i') }}</td>
                        <td>
                            @if ($movement->type === 'in')
                                <span class="badge bg-primary">入庫</span>
                            @else
                                <span class="badge bg-warning text-dark">出庫</span>
                            @endif
                        </td>
                        <td class="text-end">{{ number_format($movement->quantity) }}</td>
                        <td>{{ $movement->user->name ?? '-' }}</td>
                        <td>{{ $movement->note ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">入出庫履歴はまだありません。</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection