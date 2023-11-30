@extends('adminlte::page')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('title', 'Students')

@section('content_header')
    <h1>Data Students</h1>
@stop

@section('body')
    @include('components.header')
    @include('components.sidebar')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Students</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Students</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Table Students</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 10%">Name</th>
                            <th style="width: 10%">nim</th>
                            <th style="width: 15%">Birth Date</th>
                            <th style="width: 20%">Address</th>
                            <th style="width: 5%">Gender</th>
                            <th style="width: 15%">Major</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Your student rows go here -->
                        <tr>
                            <!-- Example student row -->
                            <td>#</td>
                            <td>Student Name</td>
                            <td>NIM</td>
                            <td>Birth Date</td>
                            <td>Address</td>
                            <td>Gender</td>
                            <td>Major</td>
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-folder"></i>View</a>
                                <a class="btn btn-info btn-sm" href="#"><i class="fas fa-pencil-alt"></i>Edit</a>
                                <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i>Delete</a>
                            </td>
                        </tr>
                        <!-- Repeat similar rows for other students -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
