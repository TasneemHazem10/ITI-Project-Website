<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <link rel="icon" href="{{asset('admin/assets/images/favicon.png')}}" type="image/png" />
    <title>Admin Panel - Information Technology Institute</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
    
</head>

<body>
    <!-- Top Contact Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-12 text-end">
                    <a href="tel:7002" class="contact-info">
                        <i class="fas fa-phone"></i> 7002
                    </a>
                    <a href="mailto:ITinfo@iti.gov.eg" class="contact-info">
                        <i class="fas fa-envelope"></i> ITinfo@iti.gov.eg
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!-- start admin login -->

    <div class="container d-flex justify-content-center align-items-center login-vh-100 mt-5">
        <div class="card p-4 shadow-lg" style="width: 450px">
            <img src="assets/images/iti_logo.svg" alt="ITI Logo" class="logo" />
            <h3 class="text-center mb-5 text_color">Admin Login</h3>
            <form novalidate action="{{route('admin.handleLogin')}}" method="post" id="adminLoginForm">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif
                <div class="mb-4 main-input">
                    <input class="form-control" id="adminEmail" aria-describedby="emailHelp" name="email" required min="1"
                        oninput="valid_email_admin()" />
                    <label for="adminEmail" class="form-label">Email address</label>
                    <div id="emailHelp" class="form-text">
                    </div>
                </div>
                <div class="mb-4 main-input">
                    <input type="password" class="form-control" id="adminPassword" name="password" required min="1"
                        oninput="valid_pass_admin()" />
                    <label for="adminPassword" class="form-label">Password</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe" name="remember" />
                    <label class="form-check-label" for="rememberMe">Remember me (optional)</label>
                </div>
                <button onclick="check3(event)" type="submit" class="btn btn-danger d-block mx-auto login_btn  ">Admin </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('admin/assets/js/main.js')}}"></script>
    <!-- end admin login -->

    <!-- Footer -->
  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('admin/assets/js/footer.js')}}"></script>
    <!-- <script src="assets/js/admin-login.js"></script> -->
</body>

</html>
