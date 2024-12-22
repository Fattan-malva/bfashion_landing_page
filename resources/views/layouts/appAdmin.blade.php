<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS and JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <style>
        /* General Styles */
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
            font-weight: 700;
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

        /* Content */
        .content {
            padding: 20px;
            border-radius: 10px;
            margin-left: 305px;
            margin-top: 90px;
            width: calc(100% - 280px);
            z-index: 998;
            transition: margin-left 0.5s ease, left 0.5s ease, width 0.5s ease;
            min-height: 80vh;
            overflow-y: auto;

        }

        .content.collapsed {
            margin-left: 105px;
            width: 94%;
        }

        @media (max-width: 768px) {
            .content {
                margin-left: 0;
                /* Center content on small screens */
                width: 100%;
                /* Full width */
                margin-top: 10px;
                /* Adjust top margin for mobile view */
            }

            .content.collapsed {
                margin-left: 0;
                /* No margin for collapsed state on mobile */
                width: 100%;
                /* Full width for collapsed state */
            }
        }


        /* Button Styles */
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        /* No Transition Class */
        .no-transition {
            transition: none !important;
        }

        /* Loading Overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.86);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 1;
            visibility: visible;
            transition: opacity 1s ease, visibility 0s 1s;
        }

        .loading-overlay.hidden {
            opacity: 0;
            visibility: hidden;
            transition: opacity 1s ease, visibility 0s 1s;
        }

        .loading-spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #696cff;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    @livewireStyles
</head>

<body>
    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay">
        <div class="loading-spinner"></div>
    </div>

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

    <!-- Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.getElementById("sidebar");
            const content = document.getElementById("content");
            const toggleButton = document.getElementById("toggleSidebar");
            const header = document.getElementById("header");
            const backdrop = document.getElementById('headerBackdrop');
            const sidebarCollapsedKey = "sidebar-collapsed";

            sidebar.classList.add("no-transition");
            content.classList.add("no-transition");
            header.classList.add("no-transition");
            backdrop.classList.add("no-transition");

            const isCollapsed = localStorage.getItem(sidebarCollapsedKey) === "true";

            if (isCollapsed) {
                sidebar.classList.add("collapsed");
                content.classList.add("collapsed");
                header.classList.add("collapsed");
                backdrop.classList.add("collapsed");
            }
            setTimeout(() => {
                sidebar.classList.remove("no-transition");
                content.classList.remove("no-transition");
                header.classList.remove("no-transition");
                backdrop.classList.remove("no-transition");
            }, 100);


            toggleButton.addEventListener("click", function () {
                const collapsed = sidebar.classList.toggle("collapsed");
                content.classList.toggle("collapsed");
                header.classList.toggle("collapsed");
                backdrop.classList.toggle("collapsed");

                localStorage.setItem(sidebarCollapsedKey, collapsed);
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const loadingOverlay = document.getElementById("loadingOverlay");

            // Show loading overlay when the page is first loaded
            loadingOverlay.style.display = "flex";

            // Hide loading overlay with fade-out animation when page is fully loaded
            window.addEventListener('load', function () {
                loadingOverlay.classList.add("hidden");
            });
        });

        // Show loading overlay on page navigation
        window.addEventListener('beforeunload', function () {
            const loadingOverlay = document.getElementById("loadingOverlay");
            loadingOverlay.style.display = "flex";
        });

    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>