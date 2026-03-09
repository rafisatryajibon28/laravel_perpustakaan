<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Login - MyDigitalLibrary</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">
</head>
<body class="bg-light">
 <div class="container">
 <div class="row justify-content-center mt-5">
 <div class="col-md-4">
 <div class="card shadow">
 <div class="card-header bg-primary text-white text-center">
 <h4>MyDigitalLibrary</h4>
 <p class="mb-0">Login Sistem</p>
 </div>
 <div class="card-body">
 @if(session('error'))
 <div class="alert alert-danger">{{ session('error') }}</div>
 @endif

 @if(session('success'))
 <div class="alert alert-success">{{ session('success') }}</div>
 @endif
 <form action="/login" method="POST">
 @csrf
 <div class="mb-3">
 <label for="username" class="form-label">Username</label>
 <input type="text" class="form-control" id="username" name="username"
required>
 </div>
 <div class="mb-3">
 <label for="password" class="form-label">Password</label>
 <input type="password" class="form-control" id="password"
name="password" required>
 </div>
 <button type="submit" class="btn btn-primary w-100">Login</button>
 </form>

 <hr>
 <p class="text-center text-muted small">
 Demo: admin / admin123
 </p>
 </div>
 </div>
 </div>
 </div>
 </div>
</body>
</html>