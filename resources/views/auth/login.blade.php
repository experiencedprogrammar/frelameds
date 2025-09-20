<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Frela-Med Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Nunito','Segoe UI',Tahoma,Geneva,Verdana,sans-serif; }

    body {
      background-color: #f8fafc;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 0.5rem;
    }

    .container {
      background: white;
      border-radius: 0.37rem;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15), 0 5px 15px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 380px;
      overflow: hidden;
    }

    .header {
      background-color: #fff;
      padding: 0.50rem 0.25rem;
      text-align: center;
      height: 70px;
      border-bottom: 1px solid #e5e7eb;
    }

    .logo { height: 60px; width: auto; object-fit: contain; }

    .form-container { padding: 0.75rem; }

    .form-group { margin-bottom: 0.75rem; position: relative; }

    .input-label {
      display: block;
      font-weight: 500;
      color: #374151;
      margin-bottom: 0.35rem;
      font-size: 0.9rem;
    }

    .input-container { position: relative; }

    .form-group i.input-icon {
      position: absolute;
      left: 0.75rem;
      top: 50%;
      transform: translateY(-50%);
      color: #6b7280;
      font-size: 0.9rem;
      z-index: 2;
    }

    .text-input {
      width: 100%;
      border: 1px solid #d1d5db;
      border-radius: 0.2rem;
      padding: 0.5rem 2.5rem 0.5rem 2.25rem;
      font-size: 0.9rem;
      color: #111827;
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
      height: 2.5rem;
      box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .text-input:focus {
      outline: none;
      border-color: #4f46e5;
      box-shadow: 0 0 0 2px rgba(79,70,229,0.2), inset 0 1px 2px rgba(0,0,0,0.05);
    }

    .input-action {
      position: absolute;
      right: 0.75rem;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #6b7280;
      font-size: 0.9rem;
      z-index: 2;
    }

    .input-action:hover { color: #4f46e5; }

    .input-error {
      color: #ef4444;
      font-size: 0.8rem;
      margin-top: 0.25rem;
      display: none;
    }

    .btn-primary {
      background-color: #4f46e5;
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 0.2rem;
      font-weight: 600;
      font-size: 0.9rem;
      cursor: pointer;
      transition: background-color 0.15s ease-in-out;
      height: 2.5rem;
      box-shadow: 0 2px 4px rgba(79, 70, 229, 0.2);
    }

    .btn-primary:hover {
      background-color: #4338ca;
      box-shadow: 0 4px 6px rgba(79,70,229,0.3);
    }

    .login-link { text-align: center; margin-top: 1rem; color: #6b7280; font-size: 0.9rem; }

    .login-link a { color: #4f46e5; text-decoration: none; font-weight: 600; }
    .login-link a:hover { text-decoration: underline; }

    .flex { display: flex; }
    .items-center { align-items: center; }
    .justify-end { justify-content: flex-end; }
    .mt-4 { margin-top: 1rem; }
    .ms-4 { margin-left: 1rem; }
    .underline { text-decoration: underline; }
    .text-sm { font-size: 0.9rem; }
    .text-gray-600 { color: #6b7280; }
    .hover-text-gray-900:hover { color: #111827; }
    .rounded-md { border-radius: 0.2rem; }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <img src="{{ asset('frontend/img/logo4.png') }}" alt="Frela-Med Logo" class="logo">
    </div>

    <div class="form-container">
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="form-group">
          <label class="input-label" for="email">Email</label>
          <div class="input-container">
            <i class="fas fa-envelope input-icon"></i>
            <input class="text-input" id="email" type="email" name="email" required autocomplete="username" placeholder="Email address"
                  value="{{ old('email') }}">
          </div>
          @error('email')
            <div class="input-error" style="display:block">{{ $message }}</div>
          @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
          <label class="input-label" for="password">Password</label>
          <div class="input-container">
            <i class="fas fa-lock input-icon"></i>
            <input class="text-input" id="password" type="password" name="password" required autocomplete="current-password" placeholder="Password">
            <i class="fas fa-eye input-action" id="toggle-password" title="Show/Hide Password"></i>
          </div>
          @error('password')
            <div class="input-error" style="display:block">{{ $message }}</div>
          @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
          <a class="underline text-sm text-gray-600 hover-text-gray-900 rounded-md" href="">
            Forgot your password?
          </a>
          <button type="submit" class="btn-primary ms-4">Login</button>
        </div>
      </form>

      <div class="login-link">
        Don’t have an account? <a href="{{ route('register') }}">Register</a>
      </div>
    </div>
  </div>

  <script>
    // Toggle password visibility
    const togglePassword = document.getElementById('toggle-password');
    const passwordInput = document.getElementById('password');
    
    togglePassword.addEventListener('click', () => {
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        togglePassword.classList.remove('fa-eye');
        togglePassword.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        togglePassword.classList.remove('fa-eye-slash');
        togglePassword.classList.add('fa-eye');
      }
    });
  </script>
</body>
</html>
