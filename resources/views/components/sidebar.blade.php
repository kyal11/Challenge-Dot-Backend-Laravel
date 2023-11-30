<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminPanel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            </div>
            <div class="info">
            <a href="#" class="d-block" id="current-user"></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add your sidebar items here -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('show-student')}}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Student</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('show-course') }}" class="nav-link">
                        <i class="nav-icon fas fa-users "></i>
                        <p>Course</p>
                    </a>
                </li> 
                <li class="nav-item">
                    <a href="{{ route('show-grade') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Grade</p>
                    </a>
                </li> 
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <!-- Logout Link -->
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Log Out</p>
                    </a>
                </li> 
                
                <!-- End of your sidebar items -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
                <!-- Logout Form -->
                
    </div>
    <!-- /.sidebar -->
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <script>
        function fetchAccountInfo() {

            var jwtToken = localStorage.getItem("jwt_token");
    
            $.ajax({
                url: "http://127.0.0.1:8000/api/auth/account",
                method: "POST",
                headers: {
                    Authorization: "Bearer " + jwtToken 
                },
                dataType: "json",
                success: function (data) {
                    // Update account name in the sidebar
                    $('#current-user').text(data.name);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    
        // Call the function on page load
        $(document).ready(function () {
            fetchAccountInfo();
        });
    </script>
    

</aside>
<!-- /.sidebar -->  
