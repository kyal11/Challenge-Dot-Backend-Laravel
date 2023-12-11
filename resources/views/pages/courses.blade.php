@extends('adminlte::page')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('title', 'Courses')

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
                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $item)
                    <li>{{$item}}</li>
                     @endforeach                    
                </div>
                @endif
    
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>     
                @endif
            <div class="card-body p-0 m-3">
                    <form action="" method="post">
                        @csrf
        
                        @if(Route::current()->uri == 'courses/{id}')
                        @method('put')
                        @endif
        
                        <div class="mb-3 row">
                            <label for="Nama" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name='name' id="name" value="{{ isset($data['name'])?$data['name']:old('name')}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="credit" class="col-sm-2 col-form-label">Credit</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name='credit' id="credit" value="{{ isset($data['credit'])?$data['credit']:old('credit')}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" name="description" id="description">{{ isset($data['description']) ? $data['description'] : old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary" name="submit">Add Data</button>
                            </div>
                        </div>
                    </form>
                </div>
                @if (Route::current()->uri == 'courses')
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 35%">Name</th>
                            <th style="width: 1%">Credit</th>
                            <th style="width: 50%">Description</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($data as $index => $course)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $course['name'] }}</td>
                                <td>{{ $course['credit'] }}</td>
                                <td>{{ $course['description'] }}</td>
                                <td class="project-actions">
                                    <a href="{{ url('courses/'.$course['id']) }}"class="btn btn-info btn-sm">
                                        <i class="fas fa-pencil-alt"></i>Edit
                                    </a>
                                    <form action="{{ route('delete-course', ['id' => $course['id']]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"  ><i class="fas fa-trash"></i>Delete</button>
                                    </form>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
