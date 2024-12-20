<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F5F5F9;
        }

        /* Content */
        .content {
            margin-left: 20%;
            margin-top: 5%;
            padding: 20px;
            transition: margin-left 0.5s ease;
            min-height: 80vh;
            /* Ensure content height for footer alignment */
        }

        .content.collapsed {
            margin-left: 8%;
        }

        .btn-primary {
            color: #fff;
            background-color: #696cff;
            border-color: #696cff;
            box-shadow: 0 .125rem .25rem #696cff66;
            transition: all 0.3s ease;
            /* Smooth transition for hover effect */
        }

        .btn-primary:hover {
            background-color: #5a56e0;
            border-color: #5a56e0;
            box-shadow: 0 0 2px 1px rgba(105, 108, 255, 0.7);
        }

        .btn-label-danger {
            color: #ff3e1d !important;
            border-color: transparent;
            background: #ffe0db;
        }

        .btn-label-danger:hover {
            color: #ffffff !important;
            background: #ff3e1d;
            border-color: #ff3e1d;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }


        @media (max-width: 768px) {
            .content {
                margin-top: 15%;
            }
        }
    </style>
    @livewireStyles
</head>

<body>
    <!-- Sidebar -->
    @include('admin.components.sidebar')

    <!-- Header -->
    @include('admin.components.header')

    <!-- Content -->
    <div id="content" class="content">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('admin.components.footer')

    @livewireScripts

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleSidebar = document.getElementById('toggleSidebar');
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const header = document.getElementById('header');

            toggleSidebar.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                content.classList.toggle('collapsed');
                header.classList.toggle('collapsed');
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.livewire.on('datatableUpdated', () => {
            $('#customersTable').DataTable({
                "searching": true,
                "pageLength": 10,
                "lengthChange": false,
            });
        });
    </script>
</body>

</html>