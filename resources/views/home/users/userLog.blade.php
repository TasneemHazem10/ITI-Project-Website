
              @extends('home.layouts.app')
@section('content')







<!-- start login -->

    <div
      class="container d-flex justify-content-center align-items-center login-vh-100 mt-5"
    >
      <div class="card p-4 shadow-lg" style="width: 450px">
        <img src="{{ asset('home/assets/images/iti_logo.svg') }}" alt="ITI Logo" class="logo"/>
        <!-- Login Type Toggle -->
        <div class="login-type-toggle mb-4">
          <div class="btn-group w-100" role="group">
            <button
              type="button"
              class="btn btn-outline-primary active"
              id="studentLoginBtn"
              onclick="switchLoginType('student')"
            >
              <i class="fas fa-user-graduate me-2"></i>Student Login
            </button>
            <button
              type="button"
              class="btn btn-outline-primary"
              id="instructorLoginBtn"
              onclick="switchLoginType('instructor')"
            >
              <i class="fas fa-chalkboard-teacher me-2"></i>Instructor Login
            </button>
          </div>
        </div>

        <h3 class="text-center mb-5 text_color" id="loginTitle">
          Student Login
        </h3>

        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom: 30px;">
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

        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        
        <form
          novalidate
          action="{{ route('home.login.student') }}"
          method="POST"
          id="studentForm"
          class="login-form"
        >
            @csrf
          <div class="mb-4 main-input">
            <input
              class="form-control"
              id="studentEmail"
              aria-describedby="emailHelp"
              name="email"
              required
              min="1"
              oninput="valid_email()"
            />
            <label for="studentEmail" class="form-label">Email address</label>
            <div id="emailHelp" class="form-text"></div>
          </div>
          <div class="mb-4 main-input">
            <input
              type="password"
              class="form-control"
              id="studentPassword"
              name="password"
              required
              min="1"
              oninput="valid_pass()"
            />
            <label for="studentPassword" class="form-label">Password</label>
          </div>
          <div class="mb-3 form-check">
            <input
              type="checkbox"
              class="form-check-input"
              id="studentRemember"
              name=""
            />
            <label class="form-check-label" for="studentRemember"
              >Remember me</label
            >
          </div>
          <div class="mb-5 rigester">
            don't have account? <a href="{{ route('home.userReg') }}">Register</a>
          </div>
          <button
            onclick="check1(event)"
            type="submit"
            class="btn btn-light d-block mx-auto login_btn text_color"
          >
            Student
          </button>
        </form>

        <!-- Instructor Login Form -->
        <form
          novalidate
          action="{{ route('home.login.instructor') }}"
          method="POST"
          id="instructorForm"
          class="login-form"
          style="display: none"
        >
            @csrf
          <div class="mb-4 main-input">
            <input
              class="form-control"
              id="instructorEmail"
              aria-describedby="instructorEmailHelp"
              name="email"
              required
              min="1"
              oninput="valid_instructor_email()"
            />
            <label for="instructorEmail" class="form-label"
              >Email address</label
            >
            <div id="instructorEmailHelp" class="form-text"></div>
          </div>
          <div class="mb-4 main-input">
            <input
              type="password"
              class="form-control"
              id="instructorPassword"
              name="password"
              required
              min="1"
              oninput="valid_instructor_pass()"
            />
            <label for="instructorPassword" class="form-label">Password</label>
          </div>
          <div class="mb-3 form-check">
            <input
              type="checkbox"
              class="form-check-input"
              id="instructorRemember"
              name=""
            />
            <label class="form-check-label" for="instructorRemember"
              >Remember me</label
            >
          </div>

          <button
            onclick="checkInstructor(event)"
            type="submit"
            class="btn btn-light d-block mx-auto login_btn text_color"
          >
            Instructor
          </button>
        </form>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('home/assets/js/main.js') }}"></script>
    <script src="{{asset('home/assets/js/login-toggle.js')}}"></script>
    
 @section('script')



 @endsection
         <script src="assets/js/main.js"></script>
    <script src="{{asset('home/assets/js/footer.js')}}"></script>
    <script src="{{asset('home/assets/js/login-toggle.js')}}"></script>
    <script src="{{asset('home/assets/js/navbar-login.js')}}"></script>

@endsection 
 