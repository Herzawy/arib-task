@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Create Employee</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="salary" class="form-label">Salary</label>
                        <input type="number" id="salary" name="salary" class="form-control" value="{{ old('salary') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="manager_name" class="form-label">Manager Name</label>
                        <input type="text" id="manager_name" name="manager_name" class="form-control" value="{{ old('manager_name') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="department_id" class="form-label">Department</label>
                        <select id="department_id" name="department_id" class="form-control" required>
                            <option value="" disabled {{ old('department_id') ? '' : 'selected' }}>Select a Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4">Create Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
