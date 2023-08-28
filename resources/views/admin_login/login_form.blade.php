<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            max-width: 400px;
            padding: 20px;
            border: 1px solid #dcdcdc;
            border-radius: 5px;
            background-color: white;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div>
            @if (session()->has('errorAdminLogin'))
                <div class="alert alert-danger">
                    {{session('errorAdminLogin')}}
                </div>
            @endif
            @if (session()->has('errorCredentials'))
                <div class="alert alert-danger">
                    {{session('errorCredentials')}}
                </div>
            @endif
            @if (session()->has('successAdminLogin'))
                <div class="alert alert-primary">
                    {{session('successAdminLogin')}}
                </div>
            @endif
            @if (session()->has('adminLogout'))
                <div class="alert alert-primary">
                    {{session('adminLogout')}}
                </div>
            @endif
        </div>

        <h2>Login</h2>
        <form action="{{route('admin_login')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
