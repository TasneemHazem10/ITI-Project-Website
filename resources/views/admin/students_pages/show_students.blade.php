@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 data-en="All Students" data-ar="جميع الطلاب">All Students</h2>
                        <div class="d-flex gap-2">
                            
                           
                        </div>
                    </div>
                </div>
            </div>

            <!-- Students Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th data-en="Photo" data-ar="الصورة">Photo</th>
                                            <th data-en="Name" data-ar="الاسم">Name</th>
                                            <th data-en="Email" data-ar="البريد الإلكتروني">Email</th>
                                            <th data-en="Phone" data-ar="الهاتف">Phone</th>
                                            <th data-en="University" data-ar="الجامعة">University</th>
                                            <th data-en="Status" data-ar="الحالة">Status</th>
                                            <th data-en="Actions" data-ar="الإجراءات">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>
                                                    @php($img = $student->profile_image)
                                                    @php($imgUrl = $img ? (strpos($img,'/') !== false ? asset('storage/'.$img) : asset('storage/images/'.$img)) : 'https://bootdey.com/img/Content/avatar/avatar7.png') 
                                                    <img src="{{ $imgUrl }}"
                                                        alt="Student" class="rounded-circle" width="40" height="40">
                                                </td>
                                                <td>{{ $student->full_name }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->phone }}</td>
                                                <td>{{ $student->university }}</td>
                                                
                                                @if ($student->is_verified == 1)
                                                    <td><span class="badge bg-success" data-en="Verified"
                                                        data-ar="معتمد">{{ $student->is_verified }}</span></td>
                                                @elseif ($student->is_verified == 0)
                                                    <td><span class="badge bg-danger" data-en="Not Verified"
                                                        data-ar="غير معتمد">{{ $student->is_verified }}</span></td>
                                                @else
                                                    <td><span class="badge bg-warning" data-en="Pending"
                                                        data-ar="في الانتظار">{{ $student->is_verified }}</span></td>
                                                @endif
                                                <td>
                                                 

                                                        <form action="{{ route('admin.students.destroy', $student->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this student {{ $student->full_name }}?');">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                        </button>
                                  



                                                </td>
                                            </tr>
                                        @endforeach


                                        <!-- Add more students here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
