<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminCategoryRequest;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount(['missions', 'missions as active_missions_count' => fn ($query) => $query->where('status', 'in_progress')])->latest()->get();
        $stats = [
            'total' => $categories->count(),
            'active' => $categories->filter(fn ($category) => $category->missions_count > 0)->count(),
            'missions' => $categories->sum('missions_count'),
        ];

        return view('admin.categories.index', compact('categories', 'stats'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(AdminCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(AdminCategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->missions()->exists()) {
            return back()->with('error', 'This category cannot be deleted while missions use it.');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}