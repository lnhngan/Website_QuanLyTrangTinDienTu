{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - Sport News</title>

    <!-- Font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    @stack('styles')
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: #fff;
            border-right: 1px solid #e9ecef;
            padding: 1.5rem;
            overflow-y: auto;
            z-index: 1000;
        }
        .sidebar .nav-link {
            color: #495057;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
            font-weight: 500;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #e3f2fd;
            color: #1976d2;
        }
        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 0.75rem;
        }
        .main-content {
            margin-left: 260px;
            padding: 2rem;
        }
        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
        }
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .stat-card h3 {
            font-size: 2rem;
            font-weight: 700;
        }
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
                padding: 1rem 0.5rem;
            }
            .sidebar .nav-text {
                display: none;
            }
            .main-content {
                margin-left: 80px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center mb-4">
            <h5 class="text-primary fw-bold">
                <i class="fas fa-futbol"></i> Sport News
            </h5>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i>
                <span class="nav-text">Dashboard</span>
            </a>
            <a class="nav-link" href="{{ route('admin.articles.index') }}">
                <i class="fas fa-newspaper"></i>
                <span class="nav-text">Bài viết</span>
            </a>
            <a class="nav-link" href="{{ route('admin.categories.index') }}">
                <i class="fas fa-folder"></i>
                <span class="nav-text">Chuyên mục</span>
            </a>
            <a class="nav-link" href="{{ route('admin.tags.index') }}">
                <i class="fas fa-tags"></i>
                <span class="nav-text">Thẻ</span>
            </a>
            <a class="nav-link" href="{{ route('admin.games.index') }}">
                <i class="fas fa-trophy"></i>
                <span class="nav-text">Trận đấu</span>
            </a>
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users"></i>
                <span class="nav-text">Người dùng</span>
            </a>
            <hr class="my-3">
            <a class="nav-link text-danger" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span class="nav-text">Đăng xuất</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Flash Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>