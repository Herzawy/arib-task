@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Create Department</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('departments.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Department Name</label>
                        <input type="text" id="name" name="name" class="form-control" 
                               value="{{ old('name') }}" required>
                    </div>


                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4">Create Department</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
