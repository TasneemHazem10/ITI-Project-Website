 @extends('home.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="main-body">



      <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
          <div class="card"style="height: 100%">
            <div class="card-body "style="height: 100% ;display: flex ; justify-content: center ; align-items: center"  >
              <div class="d-flex flex-column align-items-center text-center"  >
                @php($stuImg = Auth::guard('web_student')->user()->profile_image)
                @php($imgUrl = $stuImg ? (strpos($stuImg,'/') !== false ? asset('storage/'.$stuImg) : asset('storage/images/'.$stuImg)) : 'https://bootdey.com/img/Content/avatar/avatar7.png') 
                <img src="{{ $imgUrl }}" alt="Profile" class="rounded-circle" style="width: 250px"
                  width="150">
                <div class="mt-3">
                  <h4>{{ Auth::guard('web_student')->user()->full_name }}</h4>
                  <p class="text-secondary mb-1">{{ Auth::guard('web_student')->user()->university }}</p>
                  <p class="text-muted font-size-sm">&nbsp;</p>
                
                </div>
              </div>
            </div>
          </div>
      
        </div>
        <div class="col-md-8">
          <div class="card mb-3  " style="height: 342px;">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Full Name</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{ Auth::guard('web_student')->user()->full_name }}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{ Auth::guard('web_student')->user()->email }}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Phone</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{ Auth::guard('web_student')->user()->phone }}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Mobile</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{ Auth::guard('web_student')->user()->phone }}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Address</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{ Auth::guard('web_student')->user()->email }}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-12 profile_but">
                  <a class="btn btn-info " href="{{ route('home.profile.edit') }}">Edit</a>
                </div>
              </div>
            </div>
          </div>

        



        </div>
      </div>

    </div>


 @section('script')
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('home/assets/js/footer.js')}}"></script>
</body>


 @endsection
@endsection 