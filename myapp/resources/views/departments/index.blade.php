@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @if ($errors->has('error'))
        <div class="alert alert-danger">
            {{ $errors->first('error') }}
        </div>
    @endif
    <h1 class="text-center mb-4">Departments</h1>

    <form method="GET" action="{{ route('departments.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by department name"
                value="{{ request()->search }}">
            <button type="submit" class="btn btn-outline-primary">Search</button>
        </div>
    </form>

    <table class="table table-striped table-bordered">
        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Employee Count</th>
                <th>Total Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($departments as $department)
                <tr>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->employees->count() }}</td>
                    <td>${{ number_format($department->employees_sum_salary, 2) }}</td>
                    <td>
                        <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('departments.destroy', $department->id) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this department?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No departments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="{{ route('departments.create') }}" class="btn btn-primary">Create New Department</a>
    </div>
</div>
@endsection