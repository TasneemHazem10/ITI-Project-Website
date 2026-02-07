@extends('student.layouts.app')

@section('student')
<div class="main-content" id="mainContent">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12">
                    <h2>Student Profile</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            @php($img = $student->profile_image)
                            @php($imgUrl = $img ? (strpos($img,'/') !== false ? asset('storage/'.$img) : asset('storage/images/'.$img)) : 'https://bootdey.com/img/Content/avatar/avatar7.png') 
                            <img src="{{ $imgUrl }}" class="rounded-circle mb-3" width="150" height="150" alt="Student">
                            <h4>{{ $student->full_name }}</h4>
                            <p class="text-muted">{{ $student->university }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Full Name</strong></div>
                                <div class="col-sm-9 text-secondary">{{ $student->full_name }}</div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Email</strong></div>
                                <div class="col-sm-9 text-secondary">{{ $student->email }}</div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Phone</strong></div>
                                <div class="col-sm-9 text-secondary">{{ $student->phone }}</div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>University</strong></div>
                                <div class="col-sm-9 text-secondary">{{ $student->university }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('student/assets/js/admin-layout.js')}}"> </script>
<script src="{{asset('student/assets/js/sitebar-appear.js')}}"> </script>
@endsection
@endsection


