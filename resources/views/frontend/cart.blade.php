@include('frontend.header')
<!-- Navbar -->
<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        @if(empty($cartItems))
        <!-- Empty cart message -->
        <div class="col-12 text-center py-5">
            <div class="empty-cart-message">
                <i class="fas fa-shopping-cart fa-4x mb-4" style="color: #ddd;"></i>
                <h3 class="mb-3">Your cart is empty</h3>
                <h6 class="text-muted mb-4">Seems you haven't added any items to your cart yet</h6>
                <a href="" class="btn btn-info btn-lg">
                    <i class="fa fa-shopping-bag mr-2"></i>Start Shopping
                </a>
            </div>
        </div>
        @else
        <!-- Cart with Items -->
        <div class="col-lg-9 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0 cart-table always-visible">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-left">Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle" id="cart-items">
                    @foreach($cartItems as $id => $item)
                    <tr id="product-{{ $id }}">
                        <td class="align-middle text-left">
                            <div class="product-info d-flex align-items-center">
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="product-image mr-3" style="width: 50px; height: 50px; object-fit: cover;">
                                <div class="text-left">
                                    <div class="font-weight-bold">{{ $item['name'] }}</div>
                                    <small class="text-muted">{{ $item['description'] }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle product-price" data-price="{{ $item['price'] }}">KES:{{ number_format($item['price'], 2) }}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-info btn-minus" data-id="{{ $id }}">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center product-quantity" value="{{ $item['quantity'] }}" data-id="{{ $id }}" data-price="{{ $item['price'] }}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-info btn-plus" data-id="{{ $id }}">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle product-total" id="subtotal-{{ $id }}">KES:{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        <td class="align-middle">
                            <form action="{{ route('remove.from.cart', $id) }}" method="POST" class="d-inline remove-item-form">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-times"></i> remove
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="3" class="text-right font-weight-bold">Total:</td>
                        <td class="align-middle product-total" id="cart-items-total">KES:{{ number_format($subtotal, 2) }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div class="clear-cart-btn d-flex justify-content-between mt-3">
                <a href="" class="btn btn-sm btn-info">
                    <i class="fa fa-shopping-bag mr-2"></i>Continue Shopping
                </a>
                <form action="{{ route('clear.cart') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i> Clear Cart
                    </button>
                </form>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="bg-light p-30 mb-5 cart-summary-fixed" style="padding: 12px !important;">
               
                <div class="alert alert-info d-flex align-items-center p-2">
                    <i class="fas fa-info-circle me-2"></i>
                    <small>Enter your delivery details below to complete your Order</small>
                </div>
                
                <!-- Delivery Details Form -->
                <form action="{{ route('checkout.fetchCart') }}" method="POST">
                    @csrf
                    <div class="form-group mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:35px; text-align:center; background-color:#e8f5e9; border:1px solid #c8e6c9;">
                                    <i class="fas fa-user" style="color:#2e7d32; font-size:14px;"></i>
                                </span>
                            </div>
                            <input type="text" name="name" class="form-control form-control-sm" placeholder="Full Name" required>
                        </div>
                    </div>
                    
                    <div class="form-group mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:35px; text-align:center; background-color:#e8f5e9; border:1px solid #c8e6c9;">
                                    <i class="fas fa-phone" style="color:#2e7d32; font-size:14px;"></i>
                                </span>
                            </div>
                            <input type="tel" name="phone" inputmode="numeric" pattern="[0-9]{10,12}" maxlength="12" class="form-control form-control-sm" placeholder="Active Phone Number"> 
                        </div>
                    </div>
                    
                    <div class="form-group mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:35px; text-align:center; background-color:#e8f5e9; border:1px solid #c8e6c9;">
                                    <i class="fas fa-envelope" style="color:#2e7d32; font-size:14px;"></i>
                                </span>
                            </div>
                            <input type="email" name="email" class="form-control form-control-sm" placeholder="Active Email">
                        </div>
                    </div>
                    
                    <div class="form-group mb-2">
                        <div class="input-group input-group-sm">
                            <textarea name="address" class="form-control form-control-sm" style="min-height:60px; max-height:110px; resize:vertical;" placeholder="Delivery Address(Your Location)" rows="3" required></textarea>
                        </div>
                    </div>
                    
                    <div class="border-bottom pb-2" style="background-color: #e8f5e9; padding: 10px; border-radius: 2px;">
                        <div class="d-flex justify-content-between mb-2">
                            <h6 style="color: #2e7d32; font-weight: 600; font-size: 0.9rem;">Subtotal</h6>
                            <h6 id="cart-subtotal" style="color: #1b5e20; font-weight: 700; font-size: 0.9rem;">KES:{{ number_format($subtotal, 2) }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium" style="color: #2e7d32; font-weight: 600; font-size: 0.9rem;">Shipping</h6>
                            <h6 class="font-weight-medium" id="shipping" style="color: #1b5e20; font-weight: 700; font-size: 0.9rem;">KES:{{ number_format($shipping, 2) }}</h6>
                        </div>
                    </div>
                    <div class="pt-2" style="background-color: #c8e6c9; padding: 10px; border-radius: 2px; margin-top: 8px;">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 style="color: #1b5e20; font-weight: 700; font-size: 1rem;">Total</h5>
                            <h5 id="cart-total" style="color: #0d47a1; font-weight: 800; font-size: 1rem;">KES:{{ number_format($total, 2) }}</h5>
                        </div>
                        <input type="hidden" id="amount" name="amount" value="{{ $total }}">

                        <button type="submit" class="btn btn-block btn-success font-weight-bold my-2 py-1">
                          <i class="fas fa-check-circle mr-1"></i>  Checkout
                         </button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Cart End -->

@include('frontend.footer')

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>

<script>
    $(document).ready(function() {
        // Increment
        $(document).on('click', '.btn-plus', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const input = $(`input.product-quantity[data-id="${id}"]`);
            let value = parseInt(input.val()) || 1;
            input.val(value + 1);
            updateCartTotals();
            updateCartOnServer(id, value + 1);
        });

        // Decrement
        $(document).on('click', '.btn-minus', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const input = $(`input.product-quantity[data-id="${id}"]`);
            let value = parseInt(input.val()) || 1;
            if (value > 1) {
                input.val(value - 1);
                updateCartTotals();
                updateCartOnServer(id, value - 1);
            }
        });

        // Update totals
        function updateCartTotals() {
            let subtotal = 0;
            let itemCount = 0;
            $('tr[id^="product-"]').each(function() {
                const price = parseFloat($(this).find('.product-price').data('price'));
                const quantity = parseInt($(this).find('.product-quantity').val());
                const total = price * quantity;
                const id = $(this).find('.product-quantity').data('id');
                $(`#subtotal-${id}`).text('KES:' + total.toFixed(2));
                subtotal += total;
                itemCount += quantity;
            });
            $('#cart-subtotal').text('KES:' + subtotal.toFixed(2));
            $('#cart-items-total').text('KES:' + subtotal.toFixed(2));
            const shipping = subtotal >= 3000 ? 0 : 70;
            $('#shipping').text('KES:' + shipping.toFixed(2));
            const total = subtotal + shipping;
            $('#cart-total').text('KES:' + total.toFixed(2));
            $('#cart-count').text(itemCount);
            $('#amount').val(total);
        }

        function updateCartOnServer(productId, quantity) {
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('quantity', quantity);
            fetch(`/update-cart/${productId}`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) console.error('Error updating cart');
            })
            .catch(error => console.error('Error:', error));
        }

        $('.product-quantity').change(function() {
            let value = parseInt($(this).val());
            if (isNaN(value) || value < 1) {
                $(this).val(1);
                value = 1;
            }
            const id = $(this).data('id');
            updateCartTotals();
            updateCartOnServer(id, value);
        });

        $('.remove-item-form').on('submit', function() { return true; });
        $('form[action="{{ route('clear.cart') }}"]').on('submit', function() { return true; });

        updateCartTotals();
    });
</script>
