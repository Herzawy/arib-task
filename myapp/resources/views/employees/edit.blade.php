@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Employee</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" value="{{ $employee->first_name }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" value="{{ $employee->last_name }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="salary" class="form-label">Salary</label>
                        <input type="number" id="salary" name="salary" class="form-control" value="{{ $employee->salary }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="manager_name" class="form-label">Manager Name</label>
                        <input type="text" id="manager_name" name="manager_name" class="form-control" value="{{ $employee->manager_name }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="department_id" class="form-label">Department</label>
                        <select id="department_id" name="department_id" class="form-control" required>
                            <option value="" disabled>Select a Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ $employee->department_id == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4">Update Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
