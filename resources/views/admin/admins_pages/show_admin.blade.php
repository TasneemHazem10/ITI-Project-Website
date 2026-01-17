@extends('admin.layouts.app')

@section('title')
    <h6 class="mb-0 text-truncate" data-en="All Admins" data-ar="جميع المسؤولين">
        All Admins
    </h6>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 data-en="All Admins" data-ar="جميع المسؤولين">All Admins</h2>
                        <a href="{{route('admin.add.admin')}}" class="btn btn-danger">
                            <i class="fas fa-user-plus me-2"></i>
                            <span data-en="Add New Admin" data-ar="إضافة مسؤول جديد">Add New Admin</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="row mb-4 d-flex">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                        <input type="text" class="form-control" placeholder="Search admins..."
                                            data-en="Search admins..." data-ar="البحث في المسؤولين...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select">
                                        <option data-en="All Types" data-ar="جميع الأنواع">All Types</option>
                                        <option data-en="Super Admin" data-ar="مسؤول رئيسي">Super Admin</option>
                                        <option data-en="Regular Admin" data-ar="مسؤول عادي">Regular Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admins Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th data-en="ID" data-ar="الرقم">ID</th>
                                            <th data-en="First Name" data-ar="الاسم الاول "> First Name</th>
                                            <th data-en="Last Name" data-ar="الاسم"> Last Name</th>

                                            <th data-en="Email" data-ar="البريد الإلكتروني">Email</th>

                                            <th data-en="Type" data-ar="النوع">Type</th>

                                            <th data-en="Joined Date" data-ar="تاريخ الانضمام">Joined Date</th>
                                            <th data-en="Actions" data-ar="الإجراءات">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($admins as $admin)
                                            <tr>

                                                <td>{{ $admin->id }}</td>

                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-circle me-2">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                        <div>
                                                            {{-- <div class="fw-bold">Ahmed Mohamed</div> --}}
                                                            <div class="fw-bold">{{ $admin->fname }}</div>


                                                            <small class="text-muted">{{ $admin->phone }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> {{ $admin->lname }}</td>
                                                <td>{{ $admin->email }}</td>

                                                @if ($admin->is_supper)
                                                    <td><span class="badge bg-danger"> Super Admin</span></td>
                                                @else
                                                    <td><span class="badge bg-success">Regular Admin</span></td>
                                                @endif

                                                <td>{{ $admin->joined_at ? $admin->joined_at->format('Y-m-d') : 'غير محدد' }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{route('admin.edit.admin', $admin->id)}}" class="btn btn-sm btn-danger me-2">
                                                            <i class="fas fa-edit"></i>
                                                        </a>


                                                        @if (!$admin->is_supper)
                                                            <form action="{{ route('admin.admins.destroy', $admin->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-danger"
                                                                    onclick="return confirm('are you sure delete {{ $admin->fname }}')">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
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
    <script src="assets/js/admins.js"></script>
    <script src="assets/js/sitebar-appear.js"></script>
    </body>

    </html>
@endsection
