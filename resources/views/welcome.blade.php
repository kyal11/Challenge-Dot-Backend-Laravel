@extends('adminlte::page')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop
@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('body')
    @include('components.header')
    @include('components.sidebar')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Home</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    <div class="row ml-1 mr-1">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3 id="dataStudents"></h3>
                    <p>Students</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('show-student')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3 id="dataCourses"></h3>
                    <p>Courses</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('show-course')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 id="dataGrades"></h3>
                    <p>Grades</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('show-grade')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3 id="dataAccounts"></h3>
                    <p>Accounts</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer"><i class="fas"></i></a>
            </div>
        </div>
        <!-- /.col -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
    function fetchDataStudents() {

        var jwtToken = localStorage.getItem("jwt_token");

        $.ajax({
            url: "http://127.0.0.1:8000/api/students",
            method: "GET",
            headers: {
                Authorization: "Bearer " + jwtToken 
            },
            dataType: "json",
            success: function (data) {
                console.log('succes')
                let lengthData = data.students.length
                // Update account name in the sidebar
                $('#dataStudents').text(lengthData);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function fetchDataCourses() {

        var jwtToken = localStorage.getItem("jwt_token");

        $.ajax({
            url: "http://127.0.0.1:8000/api/courses",
            method: "GET",
            headers: {
                Authorization: "Bearer " + jwtToken 
            },
            dataType: "json",
            success: function (data) {
                console.log('succes')
                let lengthData = data.courses.length
                // Update account name in the sidebar
                $('#dataCourses').text(lengthData);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    function fetchDataGrades() {

        var jwtToken = localStorage.getItem("jwt_token");

        $.ajax({
            url: "http://127.0.0.1:8000/api/grades",
            method: "GET",
            headers: {
                Authorization: "Bearer " + jwtToken 
            },
            dataType: "json",
            success: function (data) {
                console.log('succes')
                let lengthData = data.grades.length
                // Update account name in the sidebar
                $('#dataGrades').text(lengthData);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }   
    function fetchDataUsers() {
    var jwtToken = localStorage.getItem("jwt_token");

    $.ajax({
        url: "http://127.0.0.1:8000/api/users",
        method: "GET",
        headers: {
            Authorization: "Bearer " + jwtToken 
        },
        dataType: "json",
        success: function (data) {
            console.log('succes')
            let lengthData = data.users.length
            // Update account name in the sidebar
            $('#dataAccounts').text(lengthData);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
    }  
    // Call the function on page load
    $(document).ready(function () {
        fetchDataStudents();
        fetchDataCourses();
        fetchDataGrades();
        fetchDataUsers();
    });
</script>
    <!-- /.row -->
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop