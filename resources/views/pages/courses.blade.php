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
<div class="wrapper">
    @include('components.header')
    @include('components.sidebar')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Courses</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Courses</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Table Courses</h3>
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
                            <th style="width: 35%">Name</th>
                            <th style="width: 1%">Credit</th>
                            <th style="width: 50%">Description</th>
                            {{-- <th style="width: 20%">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($data as $index => $course)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $course['name'] }}</td>
                                <td>{{ $course['credit'] }}</td>
                                <td>{{ $course['description'] }}</td>
                                {{-- <td class="project-actions text-right">
                                    <form action="{{ route('update-student', ['id' => $student['id']]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>Edit</button>
                                    </form>
                                    <form action="{{ route('delete-student', ['id' => $student['id']]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"  ><i class="fas fa-trash"></i>Delete</button>
                                    </form>
                                    
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
