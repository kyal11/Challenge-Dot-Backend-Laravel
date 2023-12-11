@extends('adminlte::page')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('title', 'Grades')

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
                        <h1 class="m-0">Data Grades</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Grades</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Table Grade</h3>
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
    
                    @if(Route::current()->uri == 'grades/{id}')
                    @method('put')
                    @endif

                    <div class="mb-3 row">
                        <label for="student" class="col-sm-2 col-form-label">Student</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="student_id" id="student_id">
                                <option  selected>Choose...</option>
                                @foreach($data as $student)
                                    <option value="{{ $student['student_id'] }}" {{ (isset($data['student_id']) && $data['student_id'] == $student['student_name']) ? 'selected' : '' }}>
                                        {{ $student['student_name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="course" class="col-sm-2 col-form-label">Course</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="course_id" id="course_id">
                                <option  selected>Choose...</option>
                                @foreach($data as $course)
                                    <option value="{{ $course['course_id'] }}" {{ (isset($data['course_id']) && $data['course_id'] == $course['course_name']) ? 'selected' : '' }}>
                                        {{ $course['course_name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="grade" class="col-sm-2 col-form-label">Grade</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="grade" id="grade">
                                <option selected>Choose...</option>
                                <option value="A" {{ (isset($data['grade']) && $data['grade'] == 'A') ? 'selected' : '' }}>A</option>
                                <option value="A-" {{ (isset($data['grade']) && $data['grade'] == 'A-') ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ (isset($data['grade']) && $data['grade'] == 'B+') ? 'selected' : '' }}>B+</option>
                                <option value="B" {{ (isset($data['grade']) && $data['grade'] == 'B') ? 'selected' : '' }}>B</option>
                                <option value="B-" {{ (isset($data['grade']) && $data['grade'] == 'B-') ? 'selected' : '' }}>B-</option>
                                <option value="C+" {{ (isset($data['grade']) && $data['grade'] == 'C+') ? 'selected' : '' }}>C+</option>
                                <option value="C" {{ (isset($data['grade']) && $data['grade'] == 'C') ? 'selected' : '' }}>C</option>
                                <option value="C-" {{ (isset($data['grade']) && $data['grade'] == 'C-') ? 'selected' : '' }}>C-</option>
                                <option value="D+" {{ (isset($data['grade']) && $data['grade'] == 'D+') ? 'selected' : '' }}>D+</option>
                                <option value="D" {{ (isset($data['grade']) && $data['grade'] == 'D') ? 'selected' : '' }}>D</option>
                                <option value="D-" {{ (isset($data['grade']) && $data['grade'] == 'D-') ? 'selected' : '' }}>D-</option>
                                <option value="E" {{ (isset($data['grade']) && $data['grade'] == 'E') ? 'selected' : '' }}>E</option>
                            </select>
                            </select>
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
        </div>
            @if (Route::current()->uri == 'grades')
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 30%">Student</th>
                            <th style="width: 30%">Course</th>
                            <th style="width: 30%">Grade</th>
                            <th style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($data as $index => $grade)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $grade['student_name'] }}</td>
                                <td>{{ $grade['course_name'] }}</td>
                                <td>{{ $grade['grade'] }}</td>
                                <td class="project-actions">
                                    <a href="{{ url('grades/'.$grade['id']) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-pencil-alt"></i>Edit
                                    </a>
                                    <form action="{{ route('delete-grade', ['id' => $grade['id']]) }}" method="post">
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
