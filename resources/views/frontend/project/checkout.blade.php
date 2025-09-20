<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
     
   <style>
        :root {
            --primary-green: #3CAD33;
            --secondary-green: #e6f3ee;
            --accent-blue: #2f5c9e;
        }

        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .payment-card {
            width: 320px;
            border-radius: 5px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 320px;
            border: none;
            position: relative;
        }
        .payment-header{
            background-color: var(--primary-green);
            padding: 1rem;
            color: white;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .payment-header h5 {
            font-weight: 600;
            font-size: 1rem;
            margin: 0;
        }

        .mpesa-logo {
            text-align: center;
            padding: 0;
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: visible;
        }

        .mpesa-logo img {
            width: 200px;
            height: auto;
            max-height: 70px;
            object-fit: contain;
            margin: 0 auto;
        }

        .payment-form {
            padding: 1.2rem;
            background: white;
            border-radius: 0 0 5px 5px;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
            font-size: 0.85rem;
            margin-bottom: 0.2rem;
            display: block;
        }

        .form-input {
            border: 1.5px solid #dee2e6;
            border-radius: 3px;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            width: 100%;
            margin-top: 0.4rem;
            transition: border-color 0.2s ease;
        }

        .form-input:focus {
            border-color: var(--primary-green);
            outline: none;
            box-shadow: 0 0 0 2px rgba(60, 173, 51, 0.2);
        }

        .submit-btn {
            background: var(--primary-green);
            padding: 0.7rem 1.5rem;
            border-radius: 3px;
            font-size: 0.95rem;
            font-weight: 500;
            width: 100%;
            transition: all 0.2s ease;
            border: none;
            letter-spacing: 0.5px;
        }

        .submit-btn:hover {
            background: #2e9c25;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .invalid-feedback {
            display: none;
            color: red;
            font-size: 0.85rem;
        }

        /* Remove number input arrows */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield; /* Firefox */
        }

        @media (max-width: 480px) {
            .payment-card {
                width: 90%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
   @if(session()->has('message'))
    <div class="alert alert-{{ session('message_type') }} alert-dismissible fade show" 
         style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 1000; min-width: 300px;">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = '{{ route("checkout") }}';
        }, 10000);
    </script>
@endif

    <div class="payment-card">
        <div class="payment-header">
            <h5>Lipa na Mpesa</h5>
        </div>

        <div class="mpesa-logo">
            <img src="{{ asset('frontend/img/mpesa.png') }}" alt="M-Pesa">
        </div>

        <form action="{{ url('stk_initiate') }}" method="POST" class="payment-form" id="paymentForm">
            @csrf

            <!-- Phone input first -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-input"
                    name="phone"
                    id="phone"
                    placeholder="254712345678"
                    pattern="[0-9]{12}"
                    title="Phone number must be 12 digits (e.g., 254712345678)"
                    maxlength="12"
                    required
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12);">
                <div class="invalid-feedback" id="phoneError">
                    Please enter a valid phone number with exactly 12 digits (e.g., 254712345678).
                </div>
            </div>

            <!-- Amount input (readonly, fetched from cart) -->
           
            <div class="mb-3">
              <label for="amount" class="form-label">Total Amount (KES)</label>
              <input type="number" class="form-input"name="amount"  id="amount" 
              value="{{ isset($cartTotal) ? number_format($cartTotal, 2, '.', '') : '0.00' }}" readonly 
              style="pointer-events: none; -moz-appearance: textfield; color: #2e7d32; font-size: 1.1rem; font-weight: 700; background-color: #e6f9f0; " />
            </div>


            <div class="d-grid">
                <button type="submit" name="submit" class="submit-btn text-white">
                    Complete Payment
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Only phone number validation
        document.getElementById("paymentForm").addEventListener("submit", function (e) {
            const phoneInput = document.getElementById("phone");
            const phoneError = document.getElementById("phoneError");
            const phonePattern = /^[0-9]{12}$/;

            if (!phonePattern.test(phoneInput.value)) {
                e.preventDefault();
                phoneInput.classList.add("is-invalid");
                phoneError.style.display = "block";
            } else {
                phoneInput.classList.remove("is-invalid");
                phoneError.style.display = "none";
            }
        });
    </script>
</body>
</html>