<?php
namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Http\Controllers\MpesaController;

class CheckoutController extends Controller
{
    public function index()
    {
        // Default checkout access
        $cartItems = Session::get('cart', []);
        $subtotal = 0;
        $shipping = 70;

        foreach($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        if($subtotal >= 3000) $shipping = 0;
        $total = $subtotal + $shipping;

        // Default empty values so Blade won’t throw errors
         $name = '';
         $phone = '';
         $email = '';
         $address = '';
         $amount = $total;

        return view('frontend.checkout', compact('cartItems', 'subtotal', 'shipping', 'total','name', 'phone', 'email', 'address', 'amount'));
    }

     // New method to receive delivery details from cart
         public function fetchCart(Request $request)
    {
         $cartItems = Session::get('cart', []);
         $subtotal = 0;

         foreach($cartItems as $item) {
        $subtotal += $item['price'] * $item['quantity'];
          }

        $shipping = $subtotal >= 3000 ? 0 : 70;
        $total = $subtotal + $shipping;

              // Delivery details from cart page
              $name    = $request->input('name');
              $phone   = $request->input('phone');
              $email   = $request->input('email');
              $address = $request->input('address');
              $amount  = $request->input('amount') ?? $total;

              return view('frontend.checkout', compact(
              'cartItems','subtotal','shipping','total',
              'name','phone','email','address','amount'
    ));
}


public function store(Request $request)
{
    $cartItems = Session::get('cart', []);
    if (empty($cartItems)) {
        return redirect()->route('view.cart')->with('error', 'Cart is empty.');
    }

    $subtotal = 0;
    foreach($cartItems as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    $shipping = $subtotal >= 3000 ? 0 : 70;
    $total = $subtotal + $shipping;
      
     // Generate unique order number
        $orderNumber = 'ORD-' . strtoupper(Str::random(6));
    // Create order
    $order = Order::create([
        'name'     => $request->input('name'),
        'phone'    => $request->input('phone'),
        'email'    => $request->input('email'),
        'address'  => $request->input('address'),
        'subtotal' => $subtotal,
        'shipping' => $shipping,
        'order_id' => $orderNumber,
        'total'    => $total,
        'items'    => json_encode($cartItems),
        'status'   => 'pending',
    ]);

    // Clear cart
    Session::forget('cart');

    return redirect()->route('shop', $order->id)
                     ->with('success', 'Order placed successfully!');
}

public function adminOrders()
{
    $orders = Order::latest()->get();
    return view('admin.orders.view', compact('orders'));
}

// Add this method to your CheckoutController
public function adminDashboard()
{
    $orders = Order::latest()->take(10)->get(); // Get recent orders for dashboard
    return view('admin.dashboard', compact('orders'));
}

}
