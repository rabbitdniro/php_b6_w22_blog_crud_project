<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard</title>
    <!-- Bootstrap 5 CDN -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-dark border-end vh-100 position-fixed"
            style="width: 250px; transition: margin-left 0.3s;">
            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                <h2 class="text-light">
                    <strong>Admin</strong>
                </h2>
                <button id="closeSidebar" class="btn btn-sm btn-outline-secondary">X</button>
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action">Categories</a>
                <a href="{{ route('posts.index') }}" class="list-group-item list-group-item-action">Posts</a>
                <a href="#" class="list-group-item list-group-item-action">Reports</a>
            </div>
        </div>

        <!-- Main Layout -->
        <div class="flex-grow-1 d-flex flex-column" id="mainContent"
            style="margin-left: 250px; transition: margin-left 0.3s;">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button id="openSidebar" class="btn btn-outline-secondary me-2 d-none">☰</button>
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Profile</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ auth()->user()->name }}</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="container-fluid p-4 flex-grow-1">
                <!-- Main Content -->
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="bg-light text-center py-3 border-top">
                &copy; 2025 Your Company
            </footer>
        </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>

    <!-- Sidebar Toggle Script -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const closeBtn = document.getElementById('closeSidebar');
        const openBtn = document.getElementById('openSidebar');

        closeBtn.addEventListener('click', () => {
            sidebar.style.marginLeft = '-250px';
            mainContent.style.marginLeft = '0';
            openBtn.classList.remove('d-none');
        });

        openBtn.addEventListener('click', () => {
            sidebar.style.marginLeft = '0';
            mainContent.style.marginLeft = '250px';
            openBtn.classList.add('d-none');
        });
    </script>
</body>

</html>