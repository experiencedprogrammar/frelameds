<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    

public function index()
{
    $products = Product::latest()->paginate(20);
    return view('admin.products.products', compact('products'));  // 👈 any Blade file you want
}


    public function create()
    {
        return view('admin.products.add');
    }

    public function store(Request $request)
    {
        $data = $this->validateProduct($request);
        $data['slug'] = $this->generateUniqueSlug($data['name']);
        $data['image'] = $this->handleImageUpload($request);
        $data['is_active'] = $request->boolean('is_active');

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validateProduct($request, $product->id);
        $data['slug'] = $this->generateUniqueSlug($data['name'], $product->id);
        $data['image'] = $this->handleImageUpload($request, $product->image);
        $data['is_active'] = $request->boolean('is_active');

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }

    // 🔹 Helpers
   private function validateProduct(Request $request, $ignoreId = null)
{
    $rules = [
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'price'       => 'required|numeric|min:0',
        'category'    => 'required|string|max:255', 
        'stock'       => 'required|integer|min:0',
        'image'       => ($ignoreId ? 'nullable' : 'required') . '|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        'is_active'   => 'nullable'
    ];

    return $request->validate($rules);
}


    private function generateUniqueSlug($name, $ignoreId = null)
    {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;

        while (
            Product::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $i++;
        }

        return $slug;
    }

    private function handleImageUpload(Request $request, $oldImage = null)
    {
        if ($request->hasFile('image')) {
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
            return $request->file('image')->store('products', 'public');
        }
        return $oldImage;
    }
}
