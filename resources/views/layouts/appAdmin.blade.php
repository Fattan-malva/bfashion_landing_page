<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        }

        .content.collapsed {
            margin-left: 8%;
        }

        @media (max-width: 768px) {
            .content {
                margin-top: 15%;
            }
        }
    </style>
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
</body>

</html>