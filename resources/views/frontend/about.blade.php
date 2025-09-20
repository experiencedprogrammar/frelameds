<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4a6bdf;
            --secondary: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --light: #f8f9fa;
            --dark: #343a40;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --border-radius: 5px;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
            /* Add these text color variables */
            --text-primary: #333333;      /* Main text color */
            --text-secondary: #666666;    /* Secondary text color */
            --text-light: #999999;        /* Light text color */
            --text-success: #28a745;      /* Success text color */
            --text-danger: #dc3545;       /* Error/danger text color */

        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #495057;
            color: var(--text-primary);
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
        }

        .page-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
        }

        .header h1 {
            font-size: 2.5rem;
            color: var(--dark);
            margin-bottom: 10px;
            font-weight: 700;
        }

        .header p {
            color: var(--gray);
            font-size: 1.1rem;
        }

        .cart-container {
            display: flex;
            gap: 25px;
            margin-bottom: 40px;
        }

        /* Left column (Cart items) */
        .cart-items {
            flex: 3;
            background: #fff;
            padding: 25px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .cart-items h2 {
            margin-bottom: 20px;
            color: var(--dark);
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cart-items h2 i {
            color: var(--primary);
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .cart-table thead {
            background: var(--light);
        }

        .cart-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--dark);
            border-bottom: 2px solid var(--light-gray);
        }

        .cart-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--light-gray);
            vertical-align: middle;
        }

        .cart-table tr:last-child td {
            border-bottom: none;
        }

        .cart-table tr:hover {
            background-color: #fafbff;
        }

        .product-cell {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 1px;
            border: 1px solid var(--light-gray);
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .product-info h3 {
            font-size: 1.1rem;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .product-info p {
            font-size: 0.9rem;
            max-width: 300px;
            color: var(--text-secondary);
        }

        .price {
            font-weight: 600;
            color: var(--dark);
        }

        .quantity {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            border-radius: 5%;
            border: 1px solid var(--light-gray);
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .quantity-btn:hover {
            background: var(--light);
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            padding: 5px;
            border: 1px solid var(--light-gray);
            border-radius: 1px;
        }

        .subtotal {
            font-weight: 700;
            color: var(--primary);
            
        }

        .clear-btn {
            background: var(--danger);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            box-shadow: 0 4px 6px rgba(220, 53, 69, 0.2);
        }

        .clear-btn:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(220, 53, 69, 0.3);
        }

        /* Right column (Checkout) */
        .checkout {
            flex: 1;
            background: #fff;
            padding: 25px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            align-self: flex-start;
            position: sticky;
            top: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group label i {
            color: var(--primary);
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--light-gray);
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(74, 107, 223, 0.1);
        }

        .amount-group {
            background: var(--light);
            padding: 15px;
            border-radius: var(--border-radius);
            margin: 20px 0;
        }

        .amount-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .amount-row:last-child {
            margin-bottom: 0;
            border-top: 1px solid var(--light-gray);
            padding-top: 10px;
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--primary);
        }
        .checkout-button {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 20px;
        }

        .checkout-btn {
            padding: 14px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: var(--transition);
        }

        .continue-btn {
            background: var(--secondary);
            color: white;
            box-shadow: 0 4px 6px rgba(108, 117, 125, 0.2);
        }

        .continue-btn:hover {
            background: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(108, 117, 125, 0.3);
        }

        .checkout-btn-primary {
            background: var(--success);
            color: white;
            box-shadow: 0 4px 6px rgba(40, 167, 69, 0.2);
        }

        .checkout-btn-primary:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(40, 167, 69, 0.3);
        }

        .empty-cart {
            text-align: center;
            padding: 40px 20px;
            color: var(--gray);
        }

        .empty-cart i {
            font-size: 4rem;
            color: var(--light-gray);
            margin-bottom: 15px;
        }

        .empty-cart h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: var(--dark);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .cart-container {
                flex-direction: column;
            }
            
            .checkout {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .cart-table thead {
                display: none;
            }
            
            .cart-table tr {
                display: block;
                margin-bottom: 15px;
                padding: 15px;
                border: 1px solid var(--light-gray);
                border-radius: var(--border-radius);
            }
            
            .cart-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 15px;
                border-bottom: 1px solid var(--light-gray);
            }
            
            .cart-table td:last-child {
                border-bottom: none;
            }
            
            .cart-table td::before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--dark);
            }
            
            .product-cell {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .cart-table tr {
            animation: fadeIn 0.5s ease-out;
        }

        .cart-table tr:nth-child(2) { animation-delay: 0.1s; }
        .cart-table tr:nth-child(3) { animation-delay: 0.2s; }
        .cart-table tr:nth-child(4) { animation-delay: 0.3s; }

        /* Status messages */
        .alert {
            padding: 15px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-info {
            background: #e8f4ff;
            color: #0c5460;
            border-left: 4px solid var(--primary);
        }
        
        .update-form {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        /* NEW STYLES FOR THE REQUESTED CHANGES */
        
        /* Delete button style - rectangular instead of circular */
        .delete-btn {
            background: var(--danger);
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: var(--transition);
        }
        
        .delete-btn:hover {
            background: #c82333;
            transform: translateY(-2px);
        }
        
        /* Green horizontal line */
        .cart-divider {
            height: 2px;
            background-color: var(--success);
            margin: 20px 0;
            width: 100%;
        }
        
        /* Total row styling */
        .total-row {
            font-weight: 700;
            background-color: #f8fff9;
        }
        
        .total-row td {
            border-top: 2px solid var(--success);
            padding: 15px;
        }
        
        /* Keep table header visible even when cart is empty */
        .cart-table.always-visible thead {
            display: table-header-group;
        }
        
        .cart-table.always-visible {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="page-container">
        <div class="cart-container">
            <!-- Left column -->
            <div class="cart-items">
                <h2><i class="fas fa-shopping-cart"></i> Cart Items</h2>

                <table class="cart-table always-visible">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session('cart') && count(session('cart')) > 0)
                            @foreach(session('cart') as $id => $item)
                                <tr>
                                    <td data-label="Product">
                                        <div class="product-cell">
                                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="product-img">
                                            <div class="product-info">
                                                <h3>{{ $item['name'] }}</h3>
                                                <p>{{ $item['description'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Price" class="price">KES {{ number_format($item['price'], 2) }}</td>
                                    <td data-label="Quantity">
                                        <div class="quantity">
                                            <button type="button" class="quantity-btn decrease" data-id="{{ $id }}">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" name="quantity" class="quantity-input" value="{{ $item['quantity'] }}" min="1" data-id="{{ $id }}" data-price="{{ $item['price'] }}">
                                            <button type="button" class="quantity-btn increase" data-id="{{ $id }}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td data-label="Subtotal" class="subtotal" id="subtotal-{{ $id }}">KES {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    <td data-label="Action">
                                        <form action="{{ route('remove.from.cart', $id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="delete-btn">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                            <!-- Green horizontal line -->
                            <tr class="total-row">
                                <td colspan="3" style="text-align: right; font-weight: bold;">Total:</td>
                                <td class="subtotal" id="cart-items-total">KES {{ number_format(collect(session('cart'))->sum(fn($item) => $item['price'] * $item['quantity']), 2) }}</td>
                                <td></td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="5">
                                    <div class="empty-cart">
                                        <i class="fas fa-shopping-cart"></i>
                                        <h3>Your cart is empty</h3>
                                        <p>Looks like you haven't added any items to your cart yet.</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                @if(session('cart') && count(session('cart')) > 0)
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="clear-btn"><i class="fas fa-trash"></i> Clear Cart</button>
                    </form>
                @endif
                
            </div>

            <!-- Right column -->
            <div class="checkout">
                <div class="col-lg-4 d-flex align-items-center">
                <a href="" class="text-decoration-none d-flex align-items-center">
                <img src="frontend/img/chekout logo.png" alt="Logo" style="height:50px; width:auto; margin-right:8px;">
                </a>
                </div>
                <!---<img src="frontend/img/checkout logo.png" alt="Logo" style="height:45px; width:auto; margin-right:8px;">----->
                
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <div>Enter your delivery deatails bellow to complete your Order</div>
                </div>
                
                <form action="{{ url('/checkout') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <span style="position: absolute; margin: 12px 0 0 15px; color: #4a6bdf;"><i class="fas fa-user"></i></span>
                        <input type="text" name="name" class="form-control" placeholder="Enter Full Name" required style="padding-left: 45px;">
                    </div>

                    <div class="form-group">
                        <span style="position: absolute; margin: 12px 0 0 15px; color: #4a6bdf;"><i class="fas fa-phone"></i></span>
                        <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" required style="padding-left: 45px;">
                    </div>

                    <div class="form-group">
                        <span style="position: absolute; margin: 12px 0 0 15px; color: #4a6bdf;"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email" style="padding-left: 45px;">
                    </div>

                    <div class="form-group">
                        <span style="position: absolute; margin: 12px 0 0 15px; color: #4a6bdf;"><i class="fas fa-map-marker-alt"></i></span>
                        <input type="text" name="address" class="form-control" placeholder="Enter Delivery Address" required style="padding-left: 45px;">
                    </div>

                    <div class="amount-group">
                        <div class="amount-row">
                            <span>Subtotal:</span>
                            <span id="cart-subtotal">KES {{ session('cart') ? number_format(collect(session('cart'))->sum(fn($item) => $item['price'] * $item['quantity']), 2) : '0.00' }}</span>
                        </div>
                        <div class="amount-row">
                            <span>Shipping:</span>
                            <span>KES 50.00</span>
                        </div>
                        <div class="amount-row">
                            <span>Total:</span>
                            <span id="cart-total">KES {{ session('cart') ? number_format((collect(session('cart'))->sum(fn($item) => $item['price'] * $item['quantity']) * 1.00) + 50, 2) : '0.00' }}</span>
                        </div>
                    </div>
                    <input type="hidden" id="amount" name="amount" value="{{ session('cart') ? collect(session('cart'))->sum(fn($item) => $item['price'] * $item['quantity']) : 0 }}">                    
                    <div class="checkout-button">
                            <button type="submit" class="checkout-btn checkout-btn-primary">
                            <i class="fas fa-credit-card"></i>Checkout
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Function to update cart totals
        function updateCartTotals() {
            let subtotal = 0;
            
            // Calculate new subtotal
            document.querySelectorAll('.quantity-input').forEach(input => {
                const id = input.getAttribute('data-id');
                const price = parseFloat(input.getAttribute('data-price'));
                const quantity = parseInt(input.value);
                const itemSubtotal = price * quantity;
                
                // Update item subtotal
                document.getElementById(`subtotal-${id}`).textContent = `KES ${itemSubtotal.toFixed(2)}`;
                
                // Add to total
                subtotal += itemSubtotal;
            });
            
            // Update cart subtotal
            document.getElementById('cart-subtotal').textContent = `KES ${subtotal.toFixed(2)}`;
            
            // Update cart items total
            if (document.getElementById('cart-items-total')) {
                document.getElementById('cart-items-total').textContent = `KES ${subtotal.toFixed(2)}`;
            }
            
            // Calculate and update total (including tax and shipping)
            const total = (subtotal * 1.00) + 50;
            document.getElementById('cart-total').textContent = `KES ${total.toFixed(2)}`;
            
            // Update hidden amount field
            document.getElementById('amount').value = subtotal;
        }

        // Quantity buttons functionality
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                const input = document.querySelector(`.quantity-input[data-id="${productId}"]`);
                
                if (this.classList.contains('decrease')) {
                    input.value = Math.max(1, parseInt(input.value) - 1);
                } else if (this.classList.contains('increase')) {
                    input.value = parseInt(input.value) + 1;
                }
                
                // Update cart totals immediately
                updateCartTotals();
                
                // Submit the form to update server-side cart
                updateCartOnServer(productId, input.value);
            });
        });

        // Input validation for quantity and update on direct input
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function() {
                if (this.value < 1) this.value = 1;
                
                // Update cart totals
                updateCartTotals();
                
                // Submit the form to update server-side cart
                const productId = this.getAttribute('data-id');
                updateCartOnServer(productId, this.value);
            });
        });

        // Function to update cart on server via AJAX
        function updateCartOnServer(productId, quantity) {
            // Create a form data object
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('quantity', quantity);
            
            // Send AJAX request to update cart
            fetch(`/update-cart/${productId}`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Cart updated successfully');
                } else {
                    console.error('Error updating cart');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        // Initialize cart totals on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartTotals();
        });
    </script>
</body>
</html>