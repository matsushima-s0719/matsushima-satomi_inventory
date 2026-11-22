<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('items')->orderBy('id')->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'カテゴリを登録しました。');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'カテゴリを更新しました。');
    }

    public function destroy(Category $category)
    {
        if ($category->items()->exists()) {
            return redirect()
                ->route('categories.index')
                ->with('error', '商品が紐づいているカテゴリは削除できません。');
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'カテゴリを削除しました。');
    }
}