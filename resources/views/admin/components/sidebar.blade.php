<style>
    .sidebar {
        position: fixed;
        top: 10px;
        left: 20px;
        height: 97%;
        width: 250px;
        border-radius: 10px 10px;
        background-color: rgb(255, 255, 255);
        color: black;
        transition: width 0.5s ease;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    }

    .sidebar .logo {
        padding: 20px;
        text-align: center;
    }

    .sidebar .logo img {
        max-width: 80%;
        height: auto;
    }


    .sidebar.collapsed {
        width: 80px;
    }

    .sidebar ul {
        padding: 0;
        margin-left: 22px;
        list-style-type: none;
    }

    .sidebar ul li {
        padding: 10px;
        margin-bottom: 5px;
        text-align: left;
    }

    .sidebar ul li a {
        color: black;
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .sidebar ul li a i {
        margin-right: 10px;
    }

    .sidebar ul li a span {
        opacity: 1;
        visibility: visible;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .sidebar.collapsed ul li a span {
        opacity: 0;
        visibility: hidden;
    }


    .sidebar ul li.active,
    .sidebar ul li:hover {
        background-color: #f1f1f1;
        border-radius: 10px;
        margin-right: 20px;
        color: black;
    }

    .sidebar ul li.active a {
        color: black;
        font-weight: bold;
    }

    .bottom-navbar a.active {
        background-color: #f1f1f1;
        border-radius: 10px;
        color: black;
        font-weight: bold;
    }

    @media (max-width: 768px) {
        .bottom-navbar {
            display: flex;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #343a40;
            justify-content: space-around;
            z-index: 1050;
        }

        .bottom-navbar a {
            color: #fff;
            text-decoration: none;
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }

        .bottom-navbar a i {
            font-size: 18px;
            display: block;
        }
    }
</style>
<!-- Sidebar -->
<div id="sidebar" class="sidebar text-white">
    <!-- Logo -->
    <div class="logo">
        <img src="{{ asset('img/logoBadmin.png') }}" alt="Logo">
    </div>

    <!-- Menu Items -->
    <ul class="list-unstyled">
        <li class="{{ request()->routeIs('admin.index') ? 'active' : '' }}">
            <a href="{{ route('admin.index') }}" class="d-flex align-items-center">
                <i class="fas fa-home"></i> <span>Dashboard</span>
            </a>
        </li>
        <li><a href="#" class="d-flex align-items-center"><i class="fas fa-user"></i> <span>Profile</span></a></li>
        <li><a href="#" class="d-flex align-items-center"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
        <li><a href="#" class="d-flex align-items-center"><i class="fas fa-chart-bar"></i> <span>Reports</span></a></li>
    </ul>
</div>

<!-- Bottom Navbar for Mobile -->
<div class="bottom-navbar d-md-none">
    <a href="#" class="text-white"><i class="fas fa-home"></i><br>Home</a>
    <a href="#" class="text-white"><i class="fas fa-user"></i><br>Profile</a>
    <a href="#" class="text-white"><i class="fas fa-cog"></i><br>Settings</a>
    <a href="#" class="text-white"><i class="fas fa-chart-bar"></i><br>Reports</a>
</div>