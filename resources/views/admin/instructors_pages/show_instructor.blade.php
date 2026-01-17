@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 data-en="All Instructors" data-ar="جميع المدربين">All Instructors</h2>
                        <a href="{{route('admin.add.instructor')}}" class="btn btn-danger">
                            <i class="fas fa-plus me-2"></i>
                            <span data-en="Add New Instructor" data-ar="إضافة مدرب جديد">Add New Instructor</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Instructors Grid -->
            <div class="row g-4">
                @foreach ($instructors as $instructor)
                    <!-- Instructor Card 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm h-100 instructor-card">
                            <div class="card-body text-center">
                                @if (empty($instructor->img_name))
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Instructor"
                                        class="rounded-circle mb-3" width="100" height="100">
                                @else
                                    <img src="{{asset('storage/'.$instructor->img_name)}}" alt="Instructor" class="rounded-circle mb-3"
                                        width="100" height="100">
                                @endif
                                <h5 class="card-title">Dr. {{ $instructor->fname }}</h5>
                                <p class="text-muted mb-2" data-en="{{ $instructor->job_tittle }}"
                                    data-ar="عالم بيانات رئيسي">
                                    {{ $instructor->job_tittle }}</p>
                                <ul class="list-unstyled text-start small text-muted">
                                    <li><i class="fas fa-envelope me-2"></i>{{ $instructor->email }}</li>
                                    <li><i class="fas fa-phone me-2"></i>{{ $instructor->phone }}</li>

                                </ul>

                                <div class="mt-3"
                                    style="
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                gap: 10px;
                                ">
                                    <a href="{{ route('admin.edit.instructors') }}" class="btn btn-sm btn-danger me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.instructor.destroy', $instructor->national_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this instructor {{ $instructor->fname }}?');">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>

                                    {{-- <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> --}}
                                    {{-- </button> --}}
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
    <script src="assets/js/admin-layout.js"></script>
    <script src="assets/js/sitebar-appear.js"></script>

    </body>

    </html>
@endsection
