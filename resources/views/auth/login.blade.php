<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        SILaSOl
    </title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #007bff;
            color: white;
            font-family: Arial, sans-serif;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background-color: white;
            color: black;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-box h2 {
            margin-bottom: 1rem;
        }

        .login-box .form-control {
            margin-bottom: 1rem;
        }

        .login-box .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .login-box .btn-primary:hover {
            background-color: #0056b3;
        }

        .login-box .social-login {
            display: flex;
            justify-content: space-around;
            margin-top: 1rem;
        }

        .login-box .social-login a {
            color: black;
            font-size: 1.5rem;
        }

        .left-section {
            text-align: center;
            padding: 2rem;
        }

        .left-section img {
            max-width: 100%;
            height: auto;
        }

        .left-section h1 {
            font-size: 2rem;
            margin-top: 1rem;
        }

        .left-section p {
            font-size: 1rem;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row login-container">
            <div class="col-md-6 left-section">
                <img alt="Bootstrap Brain Logo" height="150"
                    src="{{ asset('/img/logo_kemdikbud.png') }}"
                    width="150" />
                <h1>
                    Selamat datang di SILaSOl
                </h1>
                <p>
                    Sistem Informasi Layanan Sertifikat Online
                </p>
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="col-md-4 login-box">
                @if ($errors->any())
                    <p style="color: red;">{{ $errors->first() }}</p>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input class="form-control" placeholder="Surel" type="text" id="username" name="username" value="{{old('username')}}"
                    required autofocus />
                    <input class="form-control" placeholder="Sandi" id="password" type="password" name="password" required
                    autocomplete="current-password" />
                    <button class="btn btn-primary w-100" type="submit">
                        {{ __('Masuk') }}
                    </button>
                    @if (Route::has('password.request'))
                    <a class="d-block text-end mt-2" href="{{ route('password.request') }}">
                            {{ __('Lupa Sandi?') }}
                    </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</body>

</html>
