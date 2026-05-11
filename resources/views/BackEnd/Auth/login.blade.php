<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BS.HOTEL | LOGIN</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        :root {
            --primary: #435ebe;
            --primary-hover: #000000;
            --bg-gradient: linear-gradient(135deg, #f2f7ff 0%, #e2eafc 100%);
            --glass-bg: rgba(255, 255, 255, 0.9);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #auth {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .auth-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        }

        .auth-logo {
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .auth-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #25396f;
            margin-bottom: 0.5rem;
        }

        .auth-subtitle {
            color: #7c8db5;
            font-size: 0.95rem;
            margin-bottom: 2.5rem;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 14px 14px 14px 45px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            background: #fff;
            transition: all 0.3s ease;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(67, 94, 190, 0.1);
        }

        .form-control-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .form-control:focus + .form-control-icon {
            color: var(--primary);
        }

        .btn-login {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-login:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 8px 15px rgba(67, 94, 190, 0.2);
        }

        .auth-footer {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.9rem;
            color: #60708e;
        }

        .auth-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #60708e;
            font-size: 0.9rem;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div id="auth">
    <div class="auth-card">
        <div class="auth-logo">
            <svg width="120" height="30" viewBox="0 0 152 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 27.472c0 4.409 6.18 5.552 13.5 5.552 7.281 0 13.5-1.103 13.5-5.513s-6.179-5.552-13.5-5.552c-7.281 0-13.5 1.103-13.5 5.513z" fill="#435ebe"/>
                <circle cx="13.5" cy="8.8" r="8.8" fill="#41bbdd"/>
                <text x="40" y="25" fill="#435ebe" style="font-family:Inter; font-weight:bold; font-size:24px">BS.HOTEL</text>
            </svg>
        </div>

        <h1 class="auth-title">Welcome back</h1>
        <p class="auth-subtitle">Enter your credentials to access your dashboard.</p>
        @if (Session::has('error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle-fill me-1"></i>
                <span>{{ Session::get('error') }}</span>
            </div>
        @endif
        <form action="{{ route('login.action') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" required name="name">
                <i class="bi bi-person form-control-icon"></i>
            </div>
            
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" required name="password">
                <i class="bi bi-shield-lock form-control-icon"></i>
            </div>

            <label class="remember-me">
                <input type="checkbox">
                Keep me logged in
            </label>

            <button type="submit" class="btn-login">Log in</button>
        </form>

        <div class="auth-footer">
            <p>Don't have an account? <a href="#">Register</a></p>
            <p><a href="{{ route('home.index') }}">Back Home</a></p>
        </div>
    </div>
</div>

</body>
</html>