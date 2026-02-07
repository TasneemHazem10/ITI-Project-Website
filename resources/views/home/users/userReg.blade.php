@extends('home.layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center mb-5 mt-5">
    <div class="card p-4 shadow-lg" style="width: 450px">
        <h3 class="text-center mb-5 text_color">Register</h3>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form novalidate action="{{ route('home.register') }}" method="POST">
            @csrf
            <div class="mb-4 main-input">
                <input class="form-control" id="name" name="name" required min="3" oninput="valid_name()" value="{{ old('name') }}" />
                <label for="name" class="form-label">Full Name</label>
            </div>

            <div class="mb-4 main-input">
                <input class="form-control" id="email" name="email" type="email" required oninput="valid_email()" value="{{ old('email') }}" />
                <label for="email" class="form-label">Email address</label>
            </div>

            <div class="mb-4 main-input">
                <input type="password" class="form-control" id="password" name="password" required min="8"
                    oninput="valid_pass()" />
                <label for="password" class="form-label">Password (min 8 characters)</label>
            </div>

            <div class="mb-4 main-input">
                <input type="tel" class="form-control" id="phone" name="phone" required pattern="^(010|011|012|015)\d{8}$"
                    oninput="valid_phone()" value="{{ old('phone') }}" placeholder="01012345678" />
                <label for="phone" class="form-label">Phone Number</label>
            </div>

            <div class="mb-4 main-input">
                <input type="text" class="form-control" id="university" name="university" required
                    oninput="valid_univ()" value="{{ old('university') }}" />
                <label for="university" class="form-label">University</label>
            </div>

            <div class="mb-4 main-input">
                <input type="text" class="form-control" id="id" name="id" required pattern="[0-9]{14}" maxlength="14"
                    oninput="valid_id()" value="{{ old('id') }}" placeholder="12345678901234" />
                <label for="id" class="form-label">National ID (14 digits)</label>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>

            <div class="mb-5 rigester">have account? <a href="{{ route('home.userLog') }}">login</a></div>
            <button onclick="check2(event)" type="submit" class="btn btn-light d-block mx-auto login_btn text_color">
                Register
            </button>
        </form>
    </div>
</div>
@section('script')


       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('home/assets/js/main.js')}}"></script>
    <script src="{{asset('home/assets/js/footer.js')}}"></script>
    <script src="{{asset('home/assets/js/login-toggle.js')}}"></script>
    <script src="{{asset('home/assets/js/navbar-login.js')}}"></script>
@endsection
@endsection
