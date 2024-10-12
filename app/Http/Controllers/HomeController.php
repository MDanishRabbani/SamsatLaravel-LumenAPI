<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
{
    $productCount = Product::count();
    $categoryCount = Category::count();

    return view('admin.dashboard', compact('productCount', 'categoryCount'));
}

    public function index()
    {
        $productCount = Product::count();
        $categoryCount = Category::count();
    
        return view('admin.dashboard', compact('productCount', 'categoryCount'));
    }

    public function adminIndexProducts()
    {
        $products = Product::with('category.parent')->get();
        return view('admin.products.products', compact('products'));
    }

    public function adminIndexCategories()
    {
        $categories = Category::with('parent')->orderBy('order_column')->get();
        return view('admin.categories.categories', compact('categories'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function createCategories()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image'
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Product::create([
            'category_id' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath
        ]);

        return redirect()->route('admin.products');
    }

    public function storeCategory(Request $request)
{
    $request->validate([
        'name' => 'required',
        'parent_id' => 'nullable|exists:categories,id',
    ]);

    Category::create([
        'name' => $request->name,
        'parent_id' => $request->parent_id,
    ]);

    return redirect()->route('admin.categories');
}


    public function edit(Product $product)
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // In your HomeController.php or relevant controller
public function editCategory($id)
{
    $category = Category::findOrFail($id);
    $categories = Category::whereNull('parent_id')->get(); // Get top-level categories for the parent dropdown

    return view('admin.categories.edit', compact('category', 'categories'));
}


public function update(Request $request, Product $product)
{
    $request->validate([
        'category' => 'required|exists:categories,id', // Ensure category exists in the categories table
        'name' => 'required',
        'description' => 'required',
        'price' => 'required', 
        'image' => 'nullable|image'
    ]);

    // Handle the image upload if present
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $product->update([
            'category_id' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath
        ]);
    } else {
        $product->update([
            'category_id' => $request->category, // Ensure category_id is updated even if image is not
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);
    }

    return redirect()->route('admin.products')->with('success', 'Product updated successfully');
}


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products');
    }

    public function destroyCategory(Category $category)
{
    // Optionally, you might want to handle cases where a category has child categories
    // For example, you could prevent deletion if it has children

    if ($category->children->count() > 0) {
        return redirect()->back()->with('error', 'Cannot delete a category with child categories.');
    }

    $category->delete();
    return redirect()->route('admin.categories')->with('success', 'Category deleted successfully.');
}

public function updateOrder(Request $request)
{
    $order = $request->input('order');
    
    foreach ($order as $index => $id) {
        Category::where('id', $id)->update(['order_column' => $index + 1]);
    }

    return response()->json(['success' => true]);
}

public function updateCategory(Request $request, Category $category)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'parent_id' => 'nullable|exists:categories,id',
    ]);

    $category->update([
        'name' => $request->input('name'),
        'parent_id' => $request->input('parent_id'),
    ]);

    return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
}



}
