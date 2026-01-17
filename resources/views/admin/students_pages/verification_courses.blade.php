@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12">
                    <h2>Course Enrollment Requests</h2>
                </div>
            </div>

            <div class="row g-4">
                @forelse($pending as $req)
                    @php($student = \App\Models\Admin\Student::find($req->student_id))
                    @php($course = \App\Models\Admin\Course::find($req->course_id))
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="photo-upload-indicator">
                                        <img src="{{ $student?->profile_image ? asset('storage/images/'.$student->profile_image) : 'https://bootdey.com/img/Content/avatar/avatar1.png' }}" alt="Student"
                                            class="rounded-circle me-3" width="60" height="60">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-1">{{ $student?->full_name }}</h5>
                                        <p class="text-muted mb-1">{{ $student?->email }}</p>
                                        <small class="text-muted">Course: <strong>{{ $course?->course_name }}</strong></small>
                                    </div>
                                    <span class="badge bg-warning">Pending</span>
                                </div>

                                <div class="d-flex gap-2">
                                    <form action="{{ route('admin.enrollments.approve', [$req->student_id, $req->course_id]) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success btn-sm" type="submit">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.enrollments.reject', [$req->student_id, $req->course_id]) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger btn-sm" type="submit">Reject</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">No pending enrollment requests.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection


