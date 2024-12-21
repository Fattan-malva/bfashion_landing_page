<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <link href="https://unpkg.com/boxicons/css/boxicons.min.css" rel="stylesheet">


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Comic Sans MS', 'Comic Sans', cursive;
        }

        body {
            font-family: 'Comic Sans MS', 'Comic Sans', cursive;
            background-color: #F5F5F9;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: bold;
        }

        h1 {
            font-size: 2rem;
            line-height: 1.5;
        }

        p {
            font-size: 1rem;
            line-height: 1.5;
        }

        button {
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border: none;
            cursor: pointer;
        }

        .emoji-text {
            font-family: 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
            font-size: 1.2rem;
        }


        .content {
            margin-left: 20%;
            margin-top: 5%;
            padding: 20px;
            transition: margin-left 0.5s ease;
            min-height: 80vh;

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

        }

        .btn-primary:hover {
            background-color: #5a56e0;
            border-color: #5a56e0;
            box-shadow: 0 0 2px 1px rgba(105, 108, 255, 0.7);
        }

        .btn-secondary {
            color: #696cff;
            background-color: rgb(235, 236, 236);
            border-color: rgb(235, 236, 236);
            box-shadow: 0 .125rem .25rem rgb(228, 228, 228);
            transition: all 0.3s ease;

        }

        .btn-secondary:hover {
            background-color: #696cff;
            border-color: #696cff;
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
            ;
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
</body>

</html>