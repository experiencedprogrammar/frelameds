<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FrelaPay</title>
  <!-- CSRF Token Meta Tag -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    /* ... (Your existing styles here) ... */
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f0fff4, #dff9f2, #c8f7e8);
      min-height: 100vh;
      display: flex;
      align-items: flex-start;
      justify-content: center;
      padding: 40px 20px;
      margin: 0;
      font-size: 0.8rem;
    }
    .checkout-container {
      max-width: 450px;
      width: 100%;
    }
    .order-summary {
      background: #fff;
      border-radius: 4px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      padding: 10px;
      margin-bottom: 5px;
      font-size: 0.6rem;
    }
    .order-summary h6 {
      font-weight: 550;
      margin-bottom: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: #2c3e50;
      font-size: 0.8rem;
    }
    .order-summary table {
      width: 100%;
      margin-bottom: 0;
    }
    .order-summary table thead th {
      font-size: 0.7rem;
      border: none;
      padding: 3px 5px;
      color: #2FC56D;
      font-weight: 550;
      text-transform: uppercase;
    }
    .order-summary table tbody td {
      font-size: 0.8rem;
      border: none;
      padding: 3px 5px;
      color: #0C5460;
    }
    .order-summary table tbody tr:nth-child(odd) {
      background-color: #f9f9f9;
   }
     .order-summary table tbody tr:nth-child(even) {
       background-color:   #e8f5e9; 
   }
     .order-summary table tbody tr:hover {
     background-color:#D1ECF1;
   }
    .checkout-form {
      background: #fff;
      border-radius: 3px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      overflow: hidden;
      margin-bottom: 6px;
    }
    .checkout-header {
      background: #fff;
      padding: 14px 32px 6px 30px;
      font-weight: 410;
      font-size: 0.8rem;
      color: #2c3e50;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .checkout-header img {
      position:static;
      height: 30px; 
    }
    .header-logo {
      height: 30px;
      opacity: 1;
      transition: opacity 0.3s ease;
    }
    .header-logo:hover {
      opacity: 1;
      cursor: pointer;
    }
    .checkout-body {
      padding:8px 16px 16px;
      background: #fff;
      font-size: 0.9rem;
    }
    .gradient-input {
      width: 100%;
      border: none;
      border-radius: 3px;
      padding: 0.7rem 0.85rem;
      font-size: 0.9rem;
      background: linear-gradient(90deg, #e0f7fa, #f1f8e9);
      color: #2c3e50;
      box-shadow: inset 0 2px 5px rgba(0,0,0,0.05);
    }
    .gradient-input:focus {
      outline: none;
      box-shadow: 0 0 0 2px rgba(47, 197, 109, 0.4);
    }
    .total-box {
      background:  linear-gradient(90deg, #3a7bd5, #00d2ff);
      color: #fff;
      font-weight: 500;
      border-radius: 2px;
      padding: 14px 15px;
      margin-top: 10px;
      box-shadow: 0 3px 8px rgba(58, 123, 213, 0.3);
      font-size: 1rem;
      min-height: 100%; 
    }
    .total-box h5 {
      font-size: 1rem;
      margin-bottom: 16px;
      font-weight: 600;
    }
    .total-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .submit-btn {
      background: linear-gradient(to right, #2FC56D, #28a955);
      border: none;
      padding: 0.7rem 1.2rem;
      border-radius: 3px;
      font-size: 1rem;
      font-weight: 600;
      width: 100%;
      color: white;
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(47, 197, 109, 0.3);
      margin-top: 5px;
      margin-bottom: 8px;
    }
    .submit-btn:hover {
      background: linear-gradient(to right, #28a955, #2FC56D);
      transform: translateY(-2px);
    }
    .checkout-footer {
      padding: 6px 18px;
      background: #fff;
      text-align: left;
      padding-top: 1px;  
    }
    .payment-banner img {
      width: 100%;
      height: 30px;
      object-fit: contain;
      opacity: 1;
    }
    .coming-soon {
      font-size: 0.7rem;
      color: #6c757d;
      text-align: center;  
      margin-bottom:3px;
    }
    .spacer-text {
      font-size: 0.8rem;
      margin: 10px 0;
      text-align:left;
      color: #444;
    }
    .hidden-row {
      display: none;
    }
    .status-message {
      text-align: center;
      padding: 10px;
      font-weight: bold;
      margin-top: 10px;
      border-radius: 3px;
    }
    .status-message.success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    .status-message.error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
  </style>
</head>
<body>
<div class="page-wrapper">
    <div class="checkout-container">
    <!-- Order Summary -->
    <div class="order-summary">
      <h6>Order Summary <a href="#" class="view-all" id="view-all-toggle">View All</a></h6>
      <table class="table table-sm">
        <thead>
          <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price(KES)</th>
            <th>Subtotal(KES)</th>
          </tr>
        </thead>
        <tbody>
             @foreach($cartItems as $item)
            <tr class="hidden-row">
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>{{ number_format($item['price'], 2) }}</td>
            <td>{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
          </tr>
           @endforeach
        </tbody>
      </table>
    </div>

    <!-- Checkout Form -->
    <div class="checkout-form">
      <!-- Header -->
      <div class="checkout-header">
        Mobile Money
        <img src="/frontend/img/mpesa2.png" alt="Logo" class="header-logo">
      </div>

      <!-- Body -->
      <div class="checkout-body">
      <form id="payment-form" action="{{ route('pay') }}" method="POST">
         @csrf
          <input type="tel" class="gradient-input" id="checkout-phone-input" name="phone" value="{{ old('phone', $phone ?? '') }}" required>
          <div class="total-box">
            <h5>Payment Summary</h5>
            <div class="total-row">
              <span>Total Amount:</span>
              <span>KES {{ number_format($amount ?? $total, 2) }}</span>
            </div>
          </div>
           <!-- Hidden inputs (for payment API) -->
           <input type="hidden" name="amount" value="{{ $amount ?? $total }}">
           <input type="hidden" name="name" value="{{ $name }}">
           <input type="hidden" name="email" value="{{ $email }}">
           <input type="hidden" name="address" value="{{ $address }}">
           <button type="submit" class="submit-btn">
           <i class=" fas fa-money-check mr-2"></i>Pay Now
           </button>
        </form>
        <!-- Container for status messages -->
        <div id="payment-status"></div>
      </div>
      
      <!-- Footer with banner image -->
      <div class="checkout-footer">
         <div class="coming-soon">Other payment methods coming soon...</div>
        <div class="payment-banner">
          <img src="/frontend/img/payments.png" alt="Payment Methods">
        </div>
      </div>
    </div>
    <!-- Spacer text -->
    <div class="spacer-text">By tapping "PAY NOW" I accept Frelamed's Payment, General Terms and Conditions, and Privacy and Cookie Notice</div>
  </div>
</div>

<script>
    // View all toggle
    document.getElementById('view-all-toggle').addEventListener('click', function(e) {
      e.preventDefault();
      const hiddenRows = document.querySelectorAll('.order-summary .hidden-row');
      const viewAllText = document.getElementById('view-all-toggle');
      hiddenRows.forEach(row => {
          if (row.style.display === 'none' || row.style.display === '') {
              row.style.display = 'table-row';
              viewAllText.textContent = 'View Less';
          } else {
              row.style.display = 'none';
              viewAllText.textContent = 'View All';
          }
      });
    });

    // Handle the payment form submission
    document.getElementById('payment-form').addEventListener('submit', function(event) {
        // Prevent the default form submission that reloads the page
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);
        const statusDiv = document.getElementById('payment-status');
        const submitBtn = document.querySelector('.submit-btn');

        // Show a "processing" message and disable the button
        statusDiv.innerHTML = '<p class="status-message">Processing your request...</p>';
        submitBtn.disabled = true;

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                // If the server response is not okay, throw an error
                return response.json().then(error => {
                    throw new Error(error.message || 'Server error occurred.');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                statusDiv.innerHTML = `<p class="status-message success">
                    ${data.message}
                    You will be redirected to the home page in 5 seconds.
                </p>`;

                let countdown = 5;
                const countdownInterval = setInterval(() => {
                    countdown--;
                    if (countdown > 0) {
                        statusDiv.innerHTML = `<p class="status-message success">
                            ${data.message}
                            Redirecting in ${countdown} seconds...
                        </p>`;
                    } else {
                        clearInterval(countdownInterval);
                        window.location.href = "{{ route('home') }}";
                    }
                }, 1000); // 1000 milliseconds = 1 second
            } else {
                // Handle payment request failure from Mpesa API
                statusDiv.innerHTML = `<p class="status-message error">Error: ${data.message}</p>`;
                submitBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            statusDiv.innerHTML = `<p class="status-message error">An unexpected error occurred: ${error.message}</p>`;
            submitBtn.disabled = false;
        });
    });
</script>
</body>
</html>
