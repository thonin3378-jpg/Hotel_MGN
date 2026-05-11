<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BS.HOTEL | Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary: #435ebe;
            --primary-hover: #364b9a;
            --bg-gradient: linear-gradient(135deg, #f2f7ff 0%, #e2eafc 100%);
            --glass-bg: rgba(255, 255, 255, 0.9);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0; /* Extra space for mobile scrolling */
        }

        #auth {
            width: 100%;
            max-width: 480px;
            padding: 20px;
        }

        .auth-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 28px;
            padding: 2.5rem;
            box-shadow: 0 25px 50px rgba(0,0,0,0.06);
        }

        .auth-logo {
            margin-bottom: 2rem;
            text-align: center;
        }

        .auth-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #25396f;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .auth-subtitle {
            color: #7c8db5;
            font-size: 0.95rem;
            margin-bottom: 2rem;
            line-height: 1.5;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.2rem;
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 14px 14px 14px 45px;
            border: 2px solid #e9ecef;
            border-radius: 14px;
            background: #fff;
            transition: all 0.3s ease;
            font-size: 0.95rem;
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
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .form-control:focus + .form-control-icon {
            color: var(--primary);
        }

        .btn-register {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-register:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(67, 94, 190, 0.2);
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
            font-weight: 700;
        }

        .terms-text {
            font-size: 0.85rem;
            color: #7c8db5;
            margin-top: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            line-height: 1.4;
        }

        .terms-text input {
            margin-top: 3px;
        }
    </style>
</head>
<body>

<div id="auth">
    <div class="auth-card">
        <div class="auth-logo">
            <svg width="45" height="45" viewBox="0 0 33 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 27.472c0 4.409 6.18 5.552 13.5 5.552 7.281 0 13.5-1.103 13.5-5.513s-6.179-5.552-13.5-5.552c-7.281 0-13.5 1.103-13.5 5.513z" fill="#435ebe"/>
                <circle cx="16.5" cy="8.8" r="8.8" fill="#41bbdd"/>
            </svg>
        </div>

        <h1 class="auth-title">Create Account</h1>
        <p class="auth-subtitle">Join us to start managing your projects.</p>

        <form method="POST" action="{{ route('Frontendregister.save') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Full Name" required name="name">
                <i class="bi bi-person form-control-icon"></i>
            </div>
            <div class="form-group">
                <select class="form-control" id="gender" name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <i class="bi bi-person form-control-icon"></i>
            </div>

            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email Address" required name="email">
                <i class="bi bi-envelope form-control-icon"></i>
            </div>
            
            <div class="form-group">
                <input type="phone" class="form-control" placeholder="Phone" required name="phone">
                <i class="bi bi-shield-lock form-control-icon"></i>
            </div>

            <div class="form-group">
                <input type="password" class="form-control" placeholder="Confirm Password" required name="password">
                <i class="bi bi-check2-circle form-control-icon"></i>
            </div>
            <div class="form-group">
               <label for="fileUpload" name="file Progile">Upload File</label>
                <input type="file" class="form-control" id="profile_photo" name="profile_photo">
            </div>

            <button type="submit" class="btn-register">Sign Up</button>
        </form>

        <div class="auth-footer">
            <p><a href="{{ route('home.index') }}">Back Home</a></p> <a href="{{ route('FrontendLogin') }}">Log in</a>
        </div>
    </div>
</div>

</body>
</html>