<style>
  .edit-product-container {
    max-width: 100%;
    width: 90%;
    margin: 20px auto;
    background: #fff;
    border-radius: 6px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    font-family: 'Poppins', sans-serif;
    
  }

  .form-title {
    font-size: 1.3rem;
    color: #2c3e50;
    margin-bottom: 15px;
    font-weight: 600;
    text-align: left;
    border-bottom: 1px solid #f0f4f8;
    padding-bottom: 8px;
  }

  .form-row {
    display: flex;
    gap: 12px;
    margin-bottom: 12px;
  }

  .form-group {
    flex: 1;
    margin-bottom: 12px;
  }

  .input-label {
    display: block;
    font-weight: 500;
    color: #374151;
    margin-bottom: 5px;
    font-size: 0.85rem;
  }

  .text-input, .textarea-input, .select-input {
    width: 100%;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 8px 10px;
    font-size: 0.9rem;
    color: #1a202c;
    background: #f9fafb;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  .textarea-input {
    height: 80px;
    resize: none;
  }

  .text-input:focus, .textarea-input:focus, .select-input:focus {
    outline: none;
    border-color: #0088fe;
    background: #fff;
    box-shadow: 0 0 0 2px rgba(0, 136, 254, 0.1);
  }

  .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 15px;
    padding-top: 12px;
    border-top: 1px solid #f0f4f8;
  }

  .btn {
    padding: 8px 18px;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    font-weight: 500;
    font-size: 0.9rem;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .btn-primary {
    background: linear-gradient(to right, #0088fe, #0066cc);
    color: #fff;
  }

  .btn-primary:hover {
    background: linear-gradient(to right, #0066cc, #0052a3);
    transform: translateY(-1px);
  }

  .btn-secondary {
    background: #f1f5f9;
    color: #64748b;
    border: 1px solid #e2e8f0;
  }

  .btn-secondary:hover {
    background: #e2e8f0;
    transform: translateY(-1px);
  }
</style>

<div class="edit-product-container">
  <h2 class="form-title">Edit Product</h2>

  <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf

    {{-- show validation errors --}}
    @if($errors->any())
      <div class="alert alert-danger">
        <ul style="margin:0; padding-left: 18px;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif


    <!-- Product Name -->
    <div class="form-group">
      <label class="input-label" for="name">Product Name</label>
      <input class="text-input" id="name" type="text" name="name" required placeholder="Enter product name">
    </div>

    <!-- Description -->
    <div class="form-group">
      <label class="input-label" for="description">Description</label>
      <textarea class="textarea-input" id="description" name="description" required placeholder="Enter product description"></textarea>
    </div>

    <!-- Stock & Price -->
    <div class="form-row">
      <div class="form-group">
        <label class="input-label" for="stock">Stock</label>
        <input class="text-input" id="stock" type="number" name="stock" required min="0" placeholder="Available stock">
      </div>

      <div class="form-group">
        <label class="input-label" for="price">Price</label>
        <input class="text-input" id="price" type="number" name="price" step="0.01" required placeholder="Enter price">
      </div>
    </div>

    <!-- Category -->
    <div class="form-group">
      <label class="input-label" for="category">Category</label>
      <select class="select-input" id="category" name="category" required>
        <option value="">-- Select Category --</option>
        <option value="electronics">Electronics</option>
        <option value="fashion">Fashion</option>
        <option value="home">Home & Living</option>
        <option value="health">Health & Beauty</option>
        <option value="sports">Sports</option>
      </select>
    </div>

    <!-- Image -->
    <div class="form-group">
      <label class="input-label" for="image">Product Image</label>
      <input class="text-input" id="image" type="file" name="image" accept="image/*" required>
    </div>
    <div class="form-group">
  <label class="input-label" for="is_active">
    <input type="checkbox" id="is_active" name="is_active" value="1" checked>
    Active / Visible
  </label>
</div>


    <!-- Actions -->
    <div class="form-actions">
      <button type="button" class="btn btn-secondary" id="cancel-btn">
        <i class="fas fa-times"></i> Cancel
      </button>
      <button type="submit" class="btn btn-primary">
        <i class="fas fa-plus"></i> edit Product
      </button>
    </div>
  </form>
</div>

<script>
  document.getElementById('cancel-btn').editEventListener('click', function() {
    if (confirm('Cancel editing this product?')) {
      window.location.href = "{{ route('products.index') }}";
    }
  });
</script>
