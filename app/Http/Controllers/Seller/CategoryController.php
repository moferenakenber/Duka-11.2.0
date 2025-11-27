<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Admin\Controller;
use App\Models\ItemCategory;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the main item categories.
     * Corresponds to the route: seller.categories.index
     */
   /**
     * Display a listing of main item categories in a sidebar,
     * and show the subcategories of the selected parent in the main area.
     * Corresponds to the route: seller.categories.index
     */
    public function index(Request $request)
    {
        // 1. Get all top-level categories for the sidebar
        $mainCategories = ItemCategory::whereNull('parent_id')
                                  ->orderBy('category_name')
                                  ->get();

        $selectedCategory = null;
        $subcategories = collect();

        // 2. Determine which category is currently selected via URL parameter 'category_id'
        $selectedId = $request->query('category_id');

        // Fallback: If no category is selected, select the first one found (if any)
        if (is_null($selectedId) && $mainCategories->isNotEmpty()) {
            $selectedId = $mainCategories->first()->id;
        }

        if ($selectedId) {
            $selectedCategory = ItemCategory::with('children')->find($selectedId);
            if ($selectedCategory) {
                $subcategories = $selectedCategory->children()->orderBy('category_name')->get();
            }
        }

        return view('seller.categories.index', compact('mainCategories', 'selectedCategory', 'subcategories'));
    }

    /**
     * Display the specified category, showing its subcategories (children).
     * Corresponds to the route: seller.categories.show
     */
    public function show(ItemCategory $category)
    {
        // Get the immediate subcategories (children) of the main category
        $subcategories = $category->children()->orderBy('category_name')->get();

        // Passes the main category and its children (subcategories) to the show view.
        return view('seller.categories.show', compact('category', 'subcategories'));
    }

    // The remaining resource methods (create, store, edit, update, destroy)
    // are typically not needed for a Seller role who only views categories.
    // They are left commented out or empty if the Seller should not modify the structure.

    public function create()
    {
        // Return view for creating a new category if needed
    }

    public function store(Request $request)
    {
        // Logic to save a new category if allowed
    }

    public function edit(ItemCategory $category)
    {
        // Return view for editing a category if needed
    }

    public function update(Request $request, ItemCategory $category)
    {
        // Logic to update an existing category if allowed
    }

    public function destroy(ItemCategory $category)
    {
        // Logic to delete a category if allowed
    }
}