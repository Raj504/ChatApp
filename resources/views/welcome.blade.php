<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Group Chat</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .welcome-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .welcome-box {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: .5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .welcome-box h1 {
            margin-bottom: 1rem;
            font-weight: bold;
            color: #343a40;
        }
        .welcome-box p {
            margin-bottom: 2rem;
            color: #6c757d;
        }
        .btn-custom-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #ffffff;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .btn-custom-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-custom-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: #ffffff;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .btn-custom-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-box">
            <h1>Welcome to the Group Chat</h1>
            <p>Join the conversation by logging in or registering.</p>
            @if (Route::has('login'))
                <nav>
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-custom-primary">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-custom-primary">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-custom-secondary ml-2">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
