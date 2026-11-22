<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\SupplierRequest;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::withCount('items')->orderBy('id')->get();

        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(SupplierRequest $request)
    {
        Supplier::create($request->validated());

        return redirect()
            ->route('suppliers.index')
            ->with('success', '仕入先を登録しました。');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());

        return redirect()
            ->route('suppliers.index')
            ->with('success', '仕入先を更新しました。');
    }

    public function destroy(Supplier $supplier)
    {
        if ($supplier->items()->exists()) {
            return redirect()
                ->route('suppliers.index')
                ->with('error', '商品が紐づいている仕入先は削除できません。');
        }

        $supplier->delete();

        return redirect()
            ->route('suppliers.index')
            ->with('success', '仕入先を削除しました。');
    }
}