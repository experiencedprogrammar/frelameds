@include('frontend.header')
<!-- Carousel Start -->
<section class="container-fluid mb-3">
    <div class="row px-xl-5">
        <!-- Main Carousel -->
        <div class="col-lg-8">
            <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#header-carousel" data-slide-to="1"></li>
                    <li data-target="#header-carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    @foreach([
                        'frontend/img/carosel-1.png',
                        'frontend/img/carousel-2.png',
                        'frontend/img/ad.jpg'
                    ] as $index => $carousel)
                    <div class="carousel-item position-relative {{ $index === 0 ? 'active' : '' }}" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="{{ asset($carousel) }}" style="object-fit: cover;" alt="Carousel {{ $index + 1 }}">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <p class="mx-md-5 px-5 animate__animated animate__bounceIn">
                                    Purchase a wide variety of medical products like Pregnancy test kits, HIV self-test kits, Medicines, and many more.
                                </p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Side Offers -->
        <div class="col-lg-4">
            @foreach([
                ['img' => 'frontend/img/ad1.jpg', 'title' => 'Services Offered', 'btn' => 'View'],
                ['img' => 'frontend/img/carousel-5.jpg', 'title' => 'Special Offer', 'subtitle' => 'Save 20%', 'btn' => 'Shop Now']
            ] as $offer)
            <article class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid" src="{{ asset($offer['img']) }}" alt="{{ $offer['title'] }}">
                <div class="offer-text">
                    @isset($offer['subtitle'])
                        <h6 class="text-white text-uppercase">{{ $offer['subtitle'] }}</h6>
                    @endisset
                    <h3 class="text-white mb-3">{{ $offer['title'] }}</h3>
                    <a href="#" class="btn btn-primary">{{ $offer['btn'] }}</a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
<!-- Carousel End -->

<!-- Featured Products Section -->
<section class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase text-center mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Featured Products</span>
    </h2>
    <div class="row px-xl-5">
        @foreach($products as $product)
        <article class="col-lg-2 col-md-3 col-sm-6 product-col">
            <div class="card product-card">
                <div class="product-image-container">
                    <img class="product-image" src="{{ asset($product->image_url) }}" alt="{{ $product->name }}">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="product-title">{{ $product->name }}</h5>
                    <p class="card-text mb-1" style="font-size: 0.85rem;">{{ $product->description }}</p>
                    <p>
                        <span class="product-price">KES {{ number_format($product->price, 0) }}</span>
                        @if(!empty($product->old_price))
                        <span class="product-old-price">KES {{ number_format($product->old_price, 0) }}</span>
                        @endif
                    </p>
                    <small class="{{ $product->stock < 20 ? 'text-danger' : ($product->stock <= 50 ? 'text-warning' : 'text-success') }}" style="font-size: 0.8rem;">
                        In Stock: {{ $product->stock }} units
                    </small>
                    <form action="{{ route('add.to.cart', $product->id) }}" method="POST" class="mt-auto add-to-cart-form">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger w-100">
                            <i class="fa fa-shopping-cart"></i> Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </article>
        @endforeach
    </div>
</section>

<!-- Categories Section -->
<section class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4 text-center">
        <span class="bg-secondary pr-3">Categories</span>
    </h2>
    <div class="row px-xl-5 pb-3">
        @foreach([
            ['img' => 'frontend/img/pom.png', 'title' => 'Prescription-Only-Medicines'],
            ['img' => 'frontend/img/otc logo.jpeg', 'title' => 'Over-The-Counter (OTC)'],
            ['img' => 'frontend/img/btc logo.jpeg', 'title' => 'Behind-The-Counter (BTC)'],
            ['img' => 'frontend/img/self.jpeg', 'title' => 'Personal Care & Wellness'],
            ['img' => 'frontend/img/first aid.jpeg', 'title' => 'First Aid Care'],
            ['img' => 'frontend/img/ad.jpeg', 'title' => 'Medical Devices & Aids'],
            ['img' => 'frontend/img/sup3.png', 'title' => 'Vitamins & Supplements'],
            ['img' => 'frontend/img/skin2.jpeg', 'title' => 'Skin Care Products'],
            ['img' => 'frontend/img/bm.jpeg', 'title' => 'Baby & Mother Care']
        ] as $cat)
        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
            <a class="text-decoration-none" href="#">
                <article class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="{{ asset($cat['img']) }}" alt="{{ $cat['title'] }}">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>{{ $cat['title'] }}</h6>
                        <small class="text-body">100 Products</small>
                    </div>
                </article>
            </a>
        </div>
        @endforeach
    </div>
</section>

<!-- Special Offers Section -->
<section class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        @foreach(['frontend/img/ad3.jpg','frontend/img/ad8.jpg'] as $offer)
        <div class="col-md-6">
            <article class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="{{ asset($offer) }}" alt="Special Offer">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="#" class="btn btn-primary">Shop Now</a>
                </div>
            </article>
        </div>
        @endforeach
    </div>
</section>

<!-- New Arrivals Section -->
<section class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase text-center mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">New Arrivals</span>
    </h2>
    <div class="row px-xl-5">
        @foreach($products as $product)
        <article class="col-lg-2 col-md-3 col-sm-6 product-col">
            <div class="card product-card">
                <div class="product-image-container">
                    <img class="product-image" src="{{ asset($product->image_url) }}" alt="{{ $product->name }}">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="product-title">{{ $product->name }}</h5>
                    <p class="card-text mb-1" style="font-size: 0.85rem;">{{ $product->description }}</p>
                    <p>
                        <span class="product-price">KES {{ number_format($product->price, 0) }}</span>
                        @if(!empty($product->old_price))
                        <span class="product-old-price">KES {{ number_format($product->old_price, 0) }}</span>
                        @endif
                    </p>
                    <small class="{{ $product->stock < 20 ? 'text-danger' : ($product->stock <= 50 ? 'text-warning' : 'text-success') }}" style="font-size: 0.8rem;">
                        In Stock: {{ $product->stock }} units
                    </small>
                    <form action="{{ route('add.to.cart', $product->id) }}" method="POST" class="mt-auto add-to-cart-form">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger w-100">
                            <i class="fa fa-shopping-cart"></i> Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </article>
        @endforeach
    </div>
</section>

<!-- Vendors Section -->
<section class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                @foreach(range(1,6) as $i)
                <div class="bg-light p-4">
                    <img src="{{ asset("frontend/img/vendor-$i.jpg") }}" alt="Vendor {{ $i }}">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Styles -->
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
    text-align: left;
    padding: 8px 10px;
}
.product-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 2px;
    line-height: 1.2;
    min-height: 38px;
}
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
</style>

@include('frontend.footer')

<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>

<!-- Add to Cart AJAX -->
<script>
$(document).ready(function() {
    $('.add-to-cart-form').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    alert('Product added to cart successfully!');
                    $('#cart-count').text(response.cartCount);
                } else {
                    alert('Error adding product to cart.');
                }
            },
            error: function() { alert('Error adding product to cart.'); }
        });
    });
});
</script>
