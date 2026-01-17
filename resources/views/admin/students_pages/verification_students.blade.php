@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 data-en="Pending Verification Requests" data-ar="طلبات التحقق المعلقة">Pending Verification
                            Requests</h2>
                        <div class="d-flex gap-2">
                          
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
    
            <!-- Verification Process Overview -->


            <!-- Verification Requests -->
            <div class="row g-4">
                @foreach($pendingStudents as $student)
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-3">
                                <div class="photo-upload-indicator">
                                  @php($img = $student->profile_image)
                                  @php($imgUrl = $img ? (strpos($img,'/') !== false ? asset('storage/'.$img) : asset('storage/images/'.$img)) : 'https://bootdey.com/img/Content/avatar/avatar1.png') 
                                    <img src="{{ $imgUrl }}" alt="Student"
                                        class="rounded-circle me-3" width="60" height="60">
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">{{ $student->full_name }}</h5>
                                    <p class="text-muted mb-1">{{ $student->email }}</p>
                                </div>
                                @php($status = $student->is_verified)
                                @if($status === \App\Models\Admin\Student::VERIFICATION_UNDER_REVIEW)
                                    <span class="badge bg-warning" data-en="Under Review" data-ar="قيد المراجعة">Under Review</span>
                                @else
                                    <span class="badge bg-secondary" data-en="Pending" data-ar="في الانتظار">Pending</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <h6 data-en="Personal Information:" data-ar="المعلومات الشخصية:">Personal Information:</h6>
                                <p class="mb-1"><strong data-en="Phone:" data-ar="الهاتف:">Phone:</strong> {{ $student->phone }}</p>
                                <p class="mb-1"><strong data-en="University:" data-ar="الجامعة:">University:</strong> {{ $student->university }}</p>
                            </div>

                            <div class="d-flex gap-2">
                                <form action="{{ route('admin.students.approve', $student->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success btn-sm" type="submit">
                                        <i class="fas fa-check me-1"></i>
                                        <span data-en="Approve" data-ar="موافقة">Approve</span>
                                    </button>
                                </form>
                                <form action="{{ route('admin.students.reject', $student->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="fas fa-times me-1"></i>
                                        <span data-en="Reject" data-ar="رفض">Reject</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/pending-verification.js"></script>
    <script src="assets/js/admin-layout.js"></script>
    <script src="assets/js/sitebar-appear.js"></script>
    
</body>

</html>

@endsection
