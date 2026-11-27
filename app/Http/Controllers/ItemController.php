<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with(['category', 'supplier']);

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('item_code', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->input('supplier_id'));
        }

        if ($request->boolean('low_stock')) {
            $query->whereColumn('stock', '<=', 'reorder_point');
        }

        $items = $query->orderBy('id')->paginate(10)->withQueryString();
        $categories = Category::orderBy('id')->get();
        $suppliers = Supplier::orderBy('id')->get();

        return view('items.index', compact('items', 'categories', 'suppliers'));
    }

    public function create()
    {
        $categories = Category::orderBy('id')->get();
        $suppliers = Supplier::orderBy('id')->get();

        return view('items.create', compact('categories', 'suppliers'));
    }

    public function store(ItemRequest $request)
    {
        Item::create($request->validated());

        return redirect()
            ->route('items.index')
            ->with('success', '商品を登録しました。');
    }

    public function show(Item $item)
    {
        $item->load(['category', 'supplier', 'stockMovements.user']);
        $movements = $item->stockMovements()->with('user')->latest()->take(10)->get();

        return view('items.show', compact('item', 'movements'));
    }

    public function edit(Item $item)
    {
        $categories = Category::orderBy('id')->get();
        $suppliers = Supplier::orderBy('id')->get();

        return view('items.edit', compact('item', 'categories', 'suppliers'));
    }

    public function update(ItemRequest $request, Item $item)
    {
        $item->update($request->validated());

        return redirect()
            ->route('items.show', $item)
            ->with('success', '商品情報を更新しました。');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()
            ->route('items.index')
            ->with('success', '商品を削除しました。');
    }
}