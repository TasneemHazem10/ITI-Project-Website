@extends('home.layouts.app')

@section('content')

@if ($errors->any())
    <div class="container mt-3">
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if (session('success'))
    <div class="container mt-3">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
@endif

@if (session('info'))
    <div class="container mt-3">
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    </div>
@endif


 <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">
                            <i class="fas fa-user-circle me-2"></i>
                            Upload Profile Photo
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('home.uploadPhoto') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="mb-4">
                            <label class="form-label">Select Profile Photo</label>
                            <input type="file" name="photo" accept="image/*" class="form-control" required>
                            <small class="text-muted">Supported: JPG, PNG, GIF. Max 5MB</small>
                        </div>

                        
                        <div class="agreement-section mb-4">
                            <h6 class="text-danger mb-3">
                                <i class="fas fa-file-contract me-2"></i>
                                Terms and Agreement
                            </h6>
                            <div class="agreement-content border rounded p-3 bg-light" style="max-height: 200px; overflow-y: auto;">
                                <p><strong>By uploading your photo, you agree to the following terms:</strong></p>
                                <ul class="mb-0">
                                    <li>I confirm that the uploaded photo is my own and represents me accurately</li>
                                    <li>I understand that this photo will be used for identification purposes</li>
                                    <li>I agree that the photo meets ITI's requirements (clear, professional, recent)</li>
                                    <li>I consent to ITI using this photo for administrative and educational purposes</li>
                                    <li>I understand that false or misleading photos may result in account suspension</li>
                                    <li>I agree to ITI's privacy policy and data protection guidelines</li>
                                </ul>
                            </div>
                            
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" id="agreeTerms" name="agree_terms" required>
                                <label class="form-check-label" for="agreeTerms">
                                    I have read and agree to the terms and conditions above
                                </label>
                            </div>
                        </div>

                        
                        <div class="alert alert-danger d-none" id="errorAlert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <span id="errorMessage"></span>
                        </div>

                        
                        <div class="alert alert-success d-none" id="successAlert">
                            <i class="fas fa-check-circle me-2"></i>
                            <span id="successMessage"></span>
                        </div>

                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-danger btn-lg d-inline-flex align-items-center justify-content-center gap-2 px-5 py-3 text-nowrap" style="min-width: 260px;">
                                <i class="fas fa-paper-plane"></i>
                                <span>Submit for Verification</span>
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@section('script')
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('home/assets/js/footer.js')}}"></script>
@endsection

@endsection

