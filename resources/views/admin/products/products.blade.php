<article class="products-table-alt">
    <header class="products-header-alt">
        <h2>Products</h2>
        <section class="header-actions-alt">
            <form action="{{ route('products.index') }}" method="GET" class="search-form-alt">
                <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}">
            </form>
            <a href="{{ route('products.create') }}" class="btn-alt btn-success-alt">
                <i class="fas fa-plus"></i> Add Product
            </a>
        </section>
    </header>

    <section class="table-container-alt">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price(KES)</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                            @else
                                <span class="no-image">No Image</span>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                        <td class="action-cell">
                            <a href="{{ route('products.show', $product->id) }}" class="btn-action btn-view">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                        <td class="action-cell">
                            <a href="{{ route('admin.products.edit') }}" class="btn-action btn-edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>
                        <td class="action-cell">
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" 
                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="no-records">No products found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</article>

 <style>
/* Font Import */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');

.products-table-alt {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 4px;
    padding: 10px;
    margin: 10px 0;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

/* Header */
.products-header-alt {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 6px;
    padding-bottom: 1px;
    border-bottom: 1px solid #e5e7eb;
}

.products-header-alt h2 {
    font-size: 1.4rem;
    font-weight: 600;
    color: #111827;
    margin: 0;
}

.header-actions-alt {
    display: flex;
    gap: 8px;
    align-items: center;
}

/* Search box */
.search-form-alt input {
    padding: 10px;
    border: 1px solid #d1d5db;
    border-radius: 2px;
    font-size: 0.9rem;
    font-family: 'Inter', sans-serif;
    width: 300px;
    transition: all 0.2s ease;
}

.search-form-alt input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
}

/* Add product button */
.btn-alt {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 14px;
    border-radius: 2px;
    font-size: 0.9rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
}

.btn-success-alt {
    background-color: #10b981;
    color: white;
}

.btn-success-alt:hover {
    background-color: #059669;
}

/* Table */
.table-container-alt {
    overflow-x: auto;
    border-radius: 4px;
    border: 1px solid #e5e7eb;
}

.styled-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.8rem;
    background: #fff;
}

/* Table Head */
.styled-table thead tr {
    background: #2563eb;
}

.styled-table thead th {
    color: #fff;
    text-transform: uppercase;
    font-weight: 600;
    padding: 12px 10px;
    text-align: left;
    letter-spacing: 0.3px;
    font-size: 0.8rem;
    border: none;
}

/* Table Body */
.styled-table td {
    padding: 10px;
    text-align: left;   /* default left alignment */
    vertical-align: middle;
    color: #374151;
    border-bottom: 1px solid #e5e7eb;
    border-right: 1px solid #e5e7eb;
}

.styled-table td:last-child {
    border-right: none;
}

/* Center only the action buttons */
.action-cell {
    text-align: center !important;
}

.inline-form {
    display: inline; /* keeps delete button aligned with others */
}

/* Rows */
.styled-table tbody tr:nth-child(even) {
    background: #f9fafb;
}

.styled-table tbody tr:hover {
    background: #f3f4f6;
}

/* Images */
.styled-table img {
    height: 40px;
    width: 40px;
    object-fit: cover;
    border-radius: 2px;
    border: 1px solid #e5e7eb;
}

.no-image {
    color: #9ca3af;
    font-style: italic;
    font-size: 0.8rem;
}

/* Action buttons */
.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 10px;
    border-radius: 2px;
    font-size: 0.8rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
}

.btn-view {
    background-color: #3b82f6;
    color: white;
}
.btn-view:hover { background-color: #2563eb; }

.btn-edit {
    background-color: #f59e0b;
    color: white;
}
.btn-edit:hover { background-color: #d97706; }

.btn-delete {
    background-color: #ef4444;
    color: white;
}
.btn-delete:hover { background-color: #dc2626; }

/* Empty records */
.no-records {
    text-align: center;
    padding: 20px;
    color: #6b7280;
    font-style: italic;
}

/* Responsive */
@media (max-width: 768px) {
    .products-header-alt {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .header-actions-alt {
        width: 100%;
        justify-content: space-between;
    }

    .search-form-alt input {
        width: 100%;
    }

    .btn-action {
        padding: 4px 8px;
        font-size: 0.75rem;
    }
}

</style>