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
    
                    @if(Route::current()->uri == 'students/{id}')
                    @method('put')
                    @endif
    
                    <div class="mb-3 row">
                        <label for="Nama" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='name' id="name" value="{{ isset($data['name'])?$data['name']:old('name')}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">Nim</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name='nim' id="nim" value="{{ isset($data['nim'])?$data['nim']:old('nim')}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="birth_date" class="col-sm-2 col-form-label">Birth Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name='birth_date' id="birth_date" value="{{ isset($data['birth_date'])?$data['birth_date']:old('birth_date')}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='address' id="address" value="{{ isset($data['address'])?$data['address']:old('address')}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                            <select class="custom-select my-1 mr-sm-2" name="gender" id="gender">
                                <option selected>Choose...</option>
                                <option value="Male" {{ (isset($data['gender']) && $data['gender'] == 'Male') ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ (isset($data['gender']) && $data['gender'] == 'Female') ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="major" class="col-sm-2 col-form-label">Major</label>
                        <div class="col-sm-10">
                            <select class="custom-select my-1 mr-sm-2" name="major" id="major">
                                <option selected>Choose...</option>
                                <option value="Computer Science" {{ (isset($data['major']) && $data['major'] == 'Computer Science') ? 'selected' : '' }}>Computer Science</option>
                                <option value="Electrical Engineering" {{ (isset($data['major']) && $data['major'] == 'Electrical Engineering') ? 'selected' : '' }}>Electrical Engineering</option>
                                <option value="Mechanical Engineering" {{ (isset($data['major']) && $data['major'] == 'Mechanical Engineering') ? 'selected' : '' }}>Mechanical Engineering</option>
                                <option value="Civil Engineering" {{ (isset($data['major']) && $data['major'] == 'Civil Engineering') ? 'selected' : '' }}>Civil Engineering</option>
                                <option value="Chemical Engineering" {{ (isset($data['major']) && $data['major'] == 'Chemical Engineering') ? 'selected' : '' }}>Chemical Engineering</option>
                                <option value="Biomedical Engineering" {{ (isset($data['major']) && $data['major'] == 'Biomedical Engineering') ? 'selected' : '' }}>Biomedical Engineering</option>
                                <option value="Aerospace Engineering" {{ (isset($data['major']) && $data['major'] == 'Aerospace Engineering') ? 'selected' : '' }}>Aerospace Engineering</option>
                                <option value="Software Engineering" {{ (isset($data['major']) && $data['major'] == 'Software Engineering') ? 'selected' : '' }}>Software Engineering</option>
                                <option value="Environmental Engineering" {{ (isset($data['major']) && $data['major'] == 'Environmental Engineering') ? 'selected' : '' }}>Environmental Engineering</option>
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
            @if (Route::current()->uri == 'students')
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 10%">Name</th>
                            <th style="width: 10%">NIM</th>
                            <th style="width: 15%">Birth Date</th>
                            <th style="width: 20%">Address</th>
                            <th style="width: 5%">Gender</th>
                            <th style="width: 15%">Major</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($data as $index => $student)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $student['name'] }}</td>
                                <td>{{ $student['nim'] }}</td>
                                <td>{{ $student['birth_date'] }}</td>
                                <td>{{ $student['address'] }}</td>
                                <td>{{ $student['gender'] }}</td>
                                <td>{{ $student['major'] }}</td>
                                <td class="project-actions text-right">
                                <a href="{{ url('students/'.$student['id']) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-pencil-alt"></i>Edit
                                </a>
                                <form action="{{ route('delete-student', ['id' => $student['id']]) }}" method="post">
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
