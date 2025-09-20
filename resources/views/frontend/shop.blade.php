@include('frontend.header')

<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
    <!-- Price Start -->
<h5 class="section-title position-relative text-uppercase mb-3">
    <span class="bg-secondary pr-3 ">Filter by price</span>
</h5>
<div class="bg-light p-3 mb-30">
    <form id="priceFilter">
        <div class="range-slider">
            <input type="range" min="0" max="10000" value="1000" id="minRange">
            <input type="range" min="0" max="10000" value="7000" id="maxRange">
        </div>
        <div class="d-flex justify-content-between mt-2">
            <span id="minPrice">KES 1000</span>
            <span id="maxPrice">KES 7000</span>
        </div>
        <button type="submit" class="btn btn-danger btn-sm mt-3 w-100">Apply</button>
    </form>
</div>
<!-- Price End -->
<!-- Price End -->

<script>
document.addEventListener("DOMContentLoaded", function() {
    const minRange = document.getElementById("minRange");
    const maxRange = document.getElementById("maxRange");
    const minPrice = document.getElementById("minPrice");
    const maxPrice = document.getElementById("maxPrice");

    function updateRange() {
        let minVal = parseInt(minRange.value);
        let maxVal = parseInt(maxRange.value);

        if (minVal > maxVal - 100) {
            minRange.value = maxVal - 100;
            minVal = parseInt(minRange.value);
        }
        if (maxVal < minVal + 100) {
            maxRange.value = minVal + 100;
            maxVal = parseInt(maxRange.value);
        }

        minPrice.textContent = "KES " + minVal;
        maxPrice.textContent = "KES " + maxVal;
    }

    minRange.addEventListener("input", updateRange);
    maxRange.addEventListener("input", updateRange);

    updateRange();
});
</script>
         <!-- Categories Start -->
<h5 class="section-title position-relative text-uppercase mb-3">
    <span class="bg-secondary pr-3">Filter by category</span>
</h5>
<div class="bg-light p-3 mb-30">
    <div class="dropdown">
        <button class="btn btn-outline-secondary btn-block dropdown-toggle" type="button" id="categoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Select Category
        </button>
        <div class="dropdown-menu w-100 p-3" aria-labelledby="categoryDropdown">
            <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="category-all" checked>
                <label class="custom-control-label" for="category-all">All Categories</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="category-1">
                <label class="custom-control-label" for="category-1">Prescription Medicines (POM)</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="category-2">
                <label class="custom-control-label" for="category-2">Over-The-Counter (OTC)</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="category-3">
                <label class="custom-control-label" for="category-3">Medical Devices</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="category-4">
                <label class="custom-control-label" for="category-4">Supplements</label>
            </div>
            <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="category-5">
                <label class="custom-control-label" for="category-5">Personal Care</label>
            </div>
            <!-- Add more as needed -->
        </div>
    </div>
</div>
<!-- Categories End -->

            <!-- Categories End -->
        </div>
        <!-- Shop Sidebar End -->

        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                            <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                    <a class="dropdown-item" href="#">Price: Low to High</a>
                                    <a class="dropdown-item" href="#">Price: High to Low</a>
                                </div>
                            </div>
                            <div class="btn-group ml-2">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">12</a>
                                    <a class="dropdown-item" href="#">24</a>
                                    <a class="dropdown-item" href="#">48</a>
                                    <a class="dropdown-item" href="#">All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Product Listing - Using your format with 4 products per row -->
<style>
    .product-card {
        border: none;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
        background: #fff;
        position: relative;
    }
    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    }

    /* Discount Badge */
    .discount-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #ff5722;
        color: #fff;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 3px 6px;
        border-radius: 3px;
    }

    .product-image-container {
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f9f9f9;
        padding: 8px;
    }
    .product-image {
        max-width: 100%;
        max-height: 100%;
        transition: transform 0.3s ease;
    }
    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .card-body {
        padding: 10px;
        text-align: left;
    }
    .product-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 4px;
        line-height: 1.3;
        min-height: 38px; /* keeps rows aligned */
    }

    /* Price Styles */
    .product-price {
        font-size: 1rem;
        font-weight: 700;
        color: #e53935;
        margin-bottom: 2px;
    }
    .product-old-price {
        font-size: 0.85rem;
        color: #999;
        text-decoration: line-through;
        margin-left: 6px;
    }
    .product-col {
    padding-left: 5px !important;
    padding-right: 5px !important;
    margin-bottom: 10px;
}
/* Range Slider Wrapper */
.range-slider {
    position: relative;
    width: 100%;
    height: 40px;
}

/* Hide default sliders */
.range-slider input[type=range] {
    position: absolute;
    left: 0;
    bottom: 0;
    pointer-events: none;
    -webkit-appearance: none;
    width: 100%;
    background: none;
}

/* Custom track */
.range-slider input[type=range]::-webkit-slider-runnable-track {
    height: 6px;
    background: #ddd;
    border-radius: 3px;
}
.range-slider input[type=range]::-moz-range-track {
    height: 6px;
    background: #ddd;
    border-radius: 3px;
}

/* Custom handle (rectangular cursor-like) */
.range-slider input[type=range]::-webkit-slider-thumb {
    pointer-events: all;
    -webkit-appearance: none;
    height: 18px;
    width: 12px;
    background: #dc3545; /* Bootstrap red */
    border-radius: 3px;
    cursor: ew-resize;
    margin-top: -6px;
}
.range-slider input[type=range]::-moz-range-thumb {
    pointer-events: all;
    height: 20px;
    width: 6px;
    background: #dc3545;
    border-radius: 3px;
    cursor: ew-resize;
    border: none;
}
</style>

@foreach($products as $product)
<div class="col-lg-3 col-md-4 col-sm-6 product-col">
    <div class="card product-card">
        <!-- Discount Badge -->
        <div class="discount-badge">
            45%
        </div>

        <!-- Product Image -->
        <div class="product-image-container">
            <img class="product-image" src="{{ $product->image_url }}" alt="{{ $product->name }}">
        </div>

        <div class="card-body">
            <h5 class="product-title">{{ $product->name }}</h5>
            
            <!-- Prices -->
            <p>
                <span class="product-price">KES {{ number_format($product->price, 0) }}</span>
                <span class="product-old-price">KES {{ number_format($product->old_price, 0) }}</span>
            </p>

            <!-- Add to Cart -->
            <form action="{{ route('add.to.cart', $product->id) }}" method="POST" class="add-to-cart-form">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger w-100">
                    <i class="fa fa-shopping-cart"></i> Add to Cart
                </button>
            </form>
        </div>
    </div>
</div>
@endforeach


                <div class="col-12 mt-3">
                    <nav>
                        {{ $products->links() }}
                    </nav>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

@include('frontend.footer')

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Add to Cart AJAX Script with notification -->
<script>
    // Function to show notification
    function showNotification() {
        const notification = document.getElementById('cart-notification');
        notification.classList.add('show');
        
        // Auto hide after 5 seconds
        setTimeout(function() {
            hideNotification();
        }, 5000);
    }
    
    // Function to hide notification
    function hideNotification() {
        const notification = document.getElementById('cart-notification');
        notification.classList.remove('show');
    }
    
    $(document).ready(function() {
        // Add to cart functionality
        $('.add-to-cart-form').on('submit', function(e) {
            e.preventDefault();
            
            const form = $(this);
            const url = form.attr('action');
            
            $.ajax({
                url: url,
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                if (response.success) {
                // Replace alert with showNotification
                showNotification();
        
                 // Update cart count in the header
                 $('#cart-count').text(response.cartCount);
                } else {
                alert('Error adding product to cart.');
           } 
        }
                
            });
        });
        
        // Equalize card heights
        function equalizeCardHeights() {
            let maxHeight = 0;
            $('.product-card').each(function() {
                const height = $(this).height();
                if (height > maxHeight) {
                    maxHeight = height;
                }
            });
            
            $('.product-card').height(maxHeight);
        }
        
        // Run on page load and after AJAX operations
        setTimeout(equalizeCardHeights, 300);
    });
</script>

<!-- Template Javascript -->
<script src="{{ asset('frontend/js/main.js') }}"></script>