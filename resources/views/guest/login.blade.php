<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .bg-blur {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/images/login.jpeg') center center / cover no-repeat;
            z-index: -1;
            filter: blur(6px);
            opacity: 0.7;
        }


        .login-card {
            width: 100%;
            max-width: 420px;
            background-color: #ffffff;
            padding: 2.5rem 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease-in-out;
        }

        .login-card:hover {
            transform: scale(1.02);
        }

        .login-card h2 {
            font-weight: 600;
            color: #343a40;
        }

        .login-card p {
            color: #6c757d;
            font-size: 0.95rem;
        }

        .form-control {
            border-radius: 0.5rem;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
        }

        .btn-custom {
            background-color:rgb(95, 151, 255);
            border: none;
            width: 100%;
            padding: 0.75rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color:rgba(73, 146, 255, 0.42);
        }

        .invalid-feedback {
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="bg-blur"></div>

    <div class="login-card">
        <h2 class="text-center mb-2">Freeport Indonesia</h2>
        <p class="text-center mb-4">Silakan login untuk mengakses sistem</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    value="{{ old('email') }}" 
                    placeholder="Masukkan email" 
                    required 
                    autocomplete="email">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    placeholder="Masukkan password" 
                    required 
                    autocomplete="current-password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-custom">Login</button>
        </form>
    </div>
</body>
</html>
