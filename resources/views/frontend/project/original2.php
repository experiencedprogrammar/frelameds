<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yatta Catering - Payment Portal</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
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

        .payment-header {
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
            border-radius: 8px;
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
            border-radius: 8px;
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

        @media (max-width: 480px) {
            .payment-card {
                width: 90%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="payment-card">
        <div class="payment-header">
            <h5>Lipa na Mpesa</h5>
        </div>

        <div class="mpesa-logo">
            <img src="./images/mpesa.png" alt="M-Pesa">
        </div>

        <form action="./stk_initiate.php" method="POST" class="payment-form" id="paymentForm">
            <div class="mb-3">
                <label for="amount" class="form-label">Amount (KES)</label>
                <input type="number" class="form-input" name="amount" min="1" placeholder="Enter Amount" required>
                <div class="invalid-feedback" id="amountError">
                    Amount must be at least 1 KES.
                </div>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input
                    type="tel"
                    class="form-input"
                    name="phone"
                    id="phone"
                    placeholder="254 XXX XXX XXX"
                    pattern="254[0-9]{9}"
                    title="Phone number must start with 254 and be 12 digits long"
                    required>
                <div class="invalid-feedback" id="phoneError">
                    Please enter a valid phone number in the format 254 XXX XXX XXX.
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" name="submit" class="submit-btn text-white">
                    Confirm Payment
                </button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Validation
        document.getElementById("paymentForm").addEventListener("submit", function (e) {
            const amountInput = document.querySelector("input[name='amount']");
            const amountError = document.getElementById("amountError");

            if (Number(amountInput.value) < 1) {
                e.preventDefault();
                amountInput.classList.add("is-invalid");
                amountError.style.display = "block";
                return;
            } else {
                amountInput.classList.remove("is-invalid");
                amountError.style.display = "none";
            }

            const phoneInput = document.getElementById("phone");
            const phoneError = document.getElementById("phoneError");
            const phonePattern = /^254\d{9}$/;

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