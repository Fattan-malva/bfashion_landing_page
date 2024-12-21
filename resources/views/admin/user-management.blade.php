@extends('layouts.appAdmin')

@section('content')
<link rel="stylesheet" href="{{ asset('view/style/user-management.css') }}">
<div class="row">
    <div class="col-md-8">
        <div class="card p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h1>Management User</h1>
                    <p>User management controls system access, assigns roles, and tracks activities to ensure security
                        and efficiency.</p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasCreateCustomer" aria-controls="offcanvasCreateCustomer">
                        <i class="fa-solid fa-address-book"></i> Add New User
                    </button>
                </div>
                <div class="d-flex align-items-center">
                    <img src="{{ asset('img/useradd.png') }}" alt="Image" class="img-fluid"
                        style="max-width: 120px; margin-bottom:8px; margin-right:50px;" />
                </div>
            </div>
        </div>

        <div class="card p-4 mt-4">
            <div>
                <table id="customerTable" class="table table-responsive">
                    <thead>
                        <tr>
                            <th>#</th> <!-- Nomor urut -->
                            <th class="USER">USER</th>
                            <th>ROLE</th>
                            <th>TYPE ACCOUT</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $index => $customer)
                            <tr>
                                <td>{{ $index + 1 }}</td> <!-- Menambahkan nomor urut -->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- Lingkaran dengan dua huruf pertama dari nama -->
                                        <div class="avatar"
                                            style="background-color: {{ '#' . substr(md5(rand()), 0, 6) }};">
                                            {{ strtoupper(substr($customer->name, 0, 2)) }}
                                        </div>
                                        <div class="ms-2">
                                            <div style="font-size: 18px; font-weight: bold;">{{ $customer->name }}</div>
                                            <div style="font-size: 14px; color: #6c757d;">{{ $customer->username }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $customer->role }}</td>
                                <td>{{ $customer->login_type }}</td>
                                <td>
                                    <button class="btn btn-sm text-primary border-0">
                                        <i class="fas fa-circle-info fa-lg"></i> <!-- Ikon edit -->
                                    </button>
                                    <button class="btn btn-sm text-danger border-0">
                                        <i class="fas fa-trash fa-lg"></i> <!-- Ikon delete -->
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                        @if ($customers->count() < 10)
                            @for ($i = 0; $i < 10 - $customers->count(); $i++)
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            @endfor
                        @endif
                    </tbody>
                </table>
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
        <div class="card small mb-4">
            <h5>Small Card 4</h5>
            <p>Content for small card 4.</p>
        </div>
        <div class="card small" style="padding-bottom: 440px;">
            <h5>Small 5</h5>
            <p>Content for small card 4.</p>
        </div>
    </div>
</div>

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
                <label for="username" class="form-label">Email</label>
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
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}" required>
                @error('name')
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
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="submit" name="create_another" value="1" class="btn btn-secondary">Create &
                    Another</button>
                <button type="button" class="btn btn-danger btn-label-danger" data-bs-dismiss="offcanvas"
                    aria-label="Close">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if ($errors->any())
            var offcanvasElement = document.getElementById('offcanvasCreateCustomer');
            var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
            offcanvas.show();
            Swal.fire({
                icon: 'error',
                title: 'Validation Error!',
                text: '{{ $errors->first() }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000
            });
            if ("{{ session('create_another') }}") {
                var offcanvasElement = document.getElementById('offcanvasCreateCustomer');
                var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                offcanvas.show();
            } else {
                var offcanvasElement = document.getElementById('offcanvasCreateCustomer');
                var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                offcanvas.hide();
            }
        @endif
    });
</script>
<script>
    $(document).ready(function () {
        $('#customerTable').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            lengthChange: true,
            autoWidth: false,
            pageLength: 10,
            drawCallback: function (settings) {
                var api = this.api();
                var rows = api.rows({ page: 'current' }).data().length;
                var emptyRows = 10 - rows;
                if (emptyRows > 0) {
                    for (var i = 0; i < emptyRows; i++) {
                        $('#customerTable tbody').append(
                            '<tr class="empty-row">' +
                            '<td>&nbsp;</td>' +
                            '<td>&nbsp;</td>' +
                            '<td>&nbsp;</td>' +
                            '<td>&nbsp;</td>' +
                            '<td>&nbsp;</td>' +
                            '</tr>'
                        );
                    }
                }
            },
            language: {
                paginate: {
                    next: "<i class='bx bx-chevron-right'></i> ",
                    previous: "<i class='bx bx-chevron-left'></i> "
                },
                lengthMenu: "_MENU_",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                search: "",
            }
        });

        // Tambahkan ikon pencarian di dalam placeholder
        $('#customerTable_filter input').attr('placeholder', 'Search...').css('padding-left', '25px');
        $('#customerTable_filter input').before('<i class="fas fa-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%);"></i>');
    });
</script>
<!-- Style Page -->
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

    #offcanvasCreateCustomerLabel {
        padding: 1rem 1rem;
        margin-bottom: 0;
        border-radius: 20px;
        color: #696CFF;
        background-color: rgb(235, 236, 236);
    }
</style>
<!-- Style Full Table -->
<style>
    #customerTable_filter {
        margin-bottom: 15px;
        margin-left: 42%;
        position: relative;
    }

    #customerTable_filter input {
        padding-left: 50px;
        border-radius: 20px;
    }

    #customerTable_filter i {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #384551;
    }

    /* Custom table header and row color */
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_info {
        color: #5a56e0;
    }

    /* Gaya untuk halaman aktif */
    .active>.page-link,
    .page-link.active {
        background-color: #696CFF !important;
        border-radius: 7px !important;
        border: none !important;
        color: white !important;
        box-shadow: none !important;
    }

    /* Gaya untuk tombol halaman normal dan hover */
    .page-link,
    .page-link.active {
        background-color: #F2F3F4 !important;
        border-radius: 7px !important;
        border: none !important;
        color: #384551 !important;
        transition: background-color 0.3s, color 0.3s;
    }

    /* Efek hover untuk tombol halaman */
    .page-link:hover {
        background-color: rgb(213, 214, 214) !important;
        color: #696CFF !important;
    }

    /* Menghilangkan border atau box-shadow biru terang saat fokus */
    .page-link:focus {
        outline: none !important;
        box-shadow: none !important;
    }

    .dataTables_wrapper .dataTables_paginate {
        display: flex;
        justify-content: center;
        width: 100%;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        margin: 0 5px;
    }

    table.dataTable tbody tr:nth-child(odd) {
        background-color: #fff;
    }

    table.dataTable tbody tr:nth-child(even) {
        background-color: #fff;
    }

    #customerTable td {
        width: auto;
        text-align: center;
        vertical-align: middle;
        padding: 10px;
    }

    #customerTable th {
        width: auto;
        text-align: center;
        vertical-align: middle;
        padding: 10px;
    }

    #customerTable th.USER {
        text-align: left;
        vertical-align: middle;
        padding: 10px;
    }


    .empty-row td {
        height: 4.3em;
        padding: 0;
    }

    #customerTable td,
    #customerTable th {
        border-left: none;
        border-right: none;
    }

    #customerTable td,
    #customerTable th {
        border-bottom: 1px solid #ddd;
        border-top: 1px solid #ddd;
    }

    #customerTable tr:last-child td {
        border-bottom: none;
    }

    .avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 16px;
        text-transform: uppercase;
    }
</style>
@endsection