@extends('home.layouts.app')

@section('content')

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
                <div class="card shadow-lg verification-card">
                    <div class="card-body text-center p-5">
                        
                        <div class="verification-icon mb-4">
                            <div class="spinner-border text-danger" role="status" style="width: 4rem; height: 4rem;">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        
                        <h2 class="text-danger mb-3">
                            <i class="fas fa-clock me-2"></i>
                            Verification Pending
                        </h2>
                        
                        <p class="lead text-muted mb-4">
                            Your account is currently under review by our administration team.
                        </p>

                        
                        <div class="verification-status bg-light rounded p-4 mb-4">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <div class="status-item">
                                        <i class="fas fa-check-circle text-success fa-2x mb-2"></i>
                                        <h6 class="text-success">Photo Uploaded</h6>
                                        <small class="text-muted">Your profile photo has been submitted</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="status-item">
                                        <i class="fas fa-spinner text-danger fa-2x mb-2"></i>
                                        <h6 class="text-danger">Under Review</h6>
                                        <small class="text-muted">Admin verification in progress</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="status-item">
                                        <i class="fas fa-hourglass-half text-muted fa-2x mb-2"></i>
                                        <h6 class="text-muted">Awaiting Approval</h6>
                                        <small class="text-muted">You'll be notified once approved</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="verification-timeline mb-4">
                            <h6 class="text-start mb-3">
                                <i class="fas fa-history me-2"></i>
                                Verification Timeline
                            </h6>
                            <div class="timeline">
                                <div class="timeline-item completed">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Account Created</h6>
                                        <small class="text-muted">Registration completed successfully</small>
                                    </div>
                                </div>
                                <div class="timeline-item completed">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Photo Uploaded</h6>
                                        <small class="text-muted">Profile photo submitted for review</small>
                                    </div>
                                </div>
                                <div class="timeline-item active">
                                    <div class="timeline-marker bg-danger"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Admin Review</h6>
                                        <small class="text-muted">Currently under administrative review</small>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Account Approved</h6>
                                        <small class="text-muted">Full access granted (pending)</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="alert alert-danger">
                            <h6 class="alert-heading text-white">
                                <i class="fas fa-info-circle me-2"></i>
                                What happens next?
                            </h6>
                            <ul class="mb-0 text-start text-white">
                                <li>Our admin team will review your submitted photo</li>
                                <li>Verification typically takes 24-48 hours</li>
                                <li>You'll receive an email notification once approved</li>
                                <li>You can then access all ITI services</li>
                            </ul>
                        </div>

                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="{{ route('home.checkStatus') }}" class="btn btn-outline-danger">
                                <i class="fas fa-sync-alt me-2"></i>
                                Check Status
                            </a>
                            
                            <form action="{{ route('home.logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    Logout
                                </button>
                            </form>
                        </div>

                        
                        <div class="mt-4 pt-3 border-top">
                            <small class="text-muted">
                                <i class="fas fa-question-circle me-1"></i>
                                Need help? Contact us at 
                                <a href="mailto:ITinfo@iti.gov.eg verfi_color" class="text-decoration-none verfi_color">ITinfo@iti.gov.eg</a>
                                or call <a href="tel:7002" class="text-decoration-none verfi_color">7002</a>
                            </small>
                        </div>
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