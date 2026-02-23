<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MyPocket') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#f6f0d7',
                        sage: '#c5d89d',
                        olive: '#9cab84',
                        darkolive: '#6b7854',
                    }
                }
            }
        }
    </script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #f6f0d7 0%, #e8edc2 100%);
            min-height: 100vh;
        }
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .auth-card {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 40px rgba(137, 152, 109, 0.2);
            border: 1px solid rgba(197, 216, 157, 0.5);
        }
        .auth-logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #c5d89d 0%, #9cab84 100%);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 10px 20px rgba(137, 152, 109, 0.3);
        }
        .auth-logo svg {
            width: 40px;
            height: 40px;
            color: #2d2d2d;
        }
        .auth-title {
            text-align: center;
            font-size: 1.875rem;
            font-weight: 700;
            color: #2d2d2d;
            margin-bottom: 0.5rem;
        }
        .auth-subtitle {
            text-align: center;
            color: #6b7854;
            margin-bottom: 2rem;
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #6b7854;
            margin-bottom: 0.5rem;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            background: #faf8ed;
            border: 1px solid rgba(197, 216, 157, 0.5);
            border-radius: 0.75rem;
            color: #2d2d2d;
            font-size: 1rem;
            transition: all 0.2s;
        }
        .form-input:focus {
            outline: none;
            border-color: #9cab84;
            box-shadow: 0 0 0 3px rgba(197, 216, 157, 0.3);
        }
        .form-input::placeholder {
            color: #9cab84;
        }
        .form-checkbox {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }
        .form-checkbox input {
            width: 1rem;
            height: 1rem;
            accent-color: #9cab84;
        }
        .form-checkbox label {
            font-size: 0.875rem;
            color: #6b7854;
        }
        .btn-primary {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, #c5d89d 0%, #9cab84 100%);
            color: #2d2d2d;
            font-weight: 600;
            border: none;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(137, 152, 109, 0.3);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(137, 152, 109, 0.4);
        }
        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: #9cab84;
        }
        .auth-footer a {
            color: #6b7854;
            font-weight: 600;
            text-decoration: none;
        }
        .auth-footer a:hover {
            color: #2d2d2d;
        }
        .error-message {
            color: #c17b7b;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .forgot-link {
            font-size: 0.875rem;
            color: #9cab84;
            text-decoration: none;
        }
        .forgot-link:hover {
            color: #6b7854;
        }
        .label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    {{$slot}}
</body>
</html>
