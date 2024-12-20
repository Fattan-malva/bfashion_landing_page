@extends('layouts.appAdmin')

@section('content')
<style>
    .card {
        padding: 50px;
        border: none;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    }

    .small {
        padding: 20px 20px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        margin-right: 35px;
    }
</style>
<div class="row">
    <div class="col-md-8">
        <div class="card p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h1>Management User</h1>
                    <p>Manage your users efficiently.</p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasCreateCustomer" aria-controls="offcanvasCreateCustomer">
                        <i class="fa-solid fa-address-book"></i> Add New User
                    </button>
                </div>
                <div class="d-flex align-items-center">
                    <img src="{{ asset('img/useradd.png') }}" alt="Image" class="img-fluid"
                        style="max-width: 120px; margin-bottom:8px; margin-left:20px;" />
                </div>
            </div>
        </div>
        <div class="card p-4 mt-4">
            <div class="d-flex align-items-center justify-content-between" style="padding-bottom:170px;">
                <div>
                    <h1>Content Premier</h1>
                    <p>This is the main content area.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card small mb-4">
            <h5>Small Card 1</h5>
            <p>Content for small card 1.</p>
        </div>
        <div class="card small mb-4">
            <h5>Small Card 2</h5>
            <p>Content for small card 2.</p>
        </div>
        <div class="card small mb-4">
            <h5>Small Card 3</h5>
            <p>Content for small card 3.</p>
        </div>
        <div class="card small">
            <h5>Small Card 4</h5>
            <p>Content for small card 4.</p>
        </div>
    </div>
</div>
<!-- Include SweetAlert2 (ensure you have it in your project) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Off-Canvas Content -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCreateCustomer"
    aria-labelledby="offcanvasCreateCustomerLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasCreateCustomerLabel">Add New Customer</h5>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('admin.customer-store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                    name="username" value="{{ old('username') }}" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" value="{{ old('password') }}" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger btn-label-danger" data-bs-dismiss="offcanvas"
                    aria-label="Close">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    // If there is any validation error, show SweetAlert Toast but do not close the offcanvas
    @if ($errors->any())
        document.addEventListener('DOMContentLoaded', function () {
            // Manually triggering the offcanvas and preventing it from closing
            var offcanvasElement = document.getElementById('offcanvasCreateCustomer');
            var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
            offcanvas.show(); // Keep offcanvas open when there is an error

            // Show SweetAlert2 toast notification with the first error
            Swal.fire({
                icon: 'error',
                title: 'Validation Error!',
                text: '{{ $errors->first() }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        });
    @endif
    // Handle success message
    @if (session('success'))
        document.addEventListener('DOMContentLoaded', function () {
            // Show SweetAlert2 toast notification for success
            Swal.fire({
                icon: 'success',
                title: 'Customer Added Successfully!',
                text: '{{ session('success') }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            // Close the offcanvas after success
            var offcanvasElement = document.getElementById('offcanvasCreateCustomer');
            var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
            offcanvas.hide(); // Close offcanvas on success
        });
    @endif
</script>



@endsection