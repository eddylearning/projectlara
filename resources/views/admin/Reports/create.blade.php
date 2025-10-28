@extends('admin.AdminLayout.layout')

@section('title', 'Create Report')

@section('content')
<div class="container">
    <h2>Create Report</h2>

    <form action="{{ route('admin.reports.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            @error('title') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Select Car</label>
            <select name="car_id" class="form-select" required>
                <option value="">-- Select a Car --</option>
                @foreach($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->title }}</option>
                @endforeach
            </select>
            @error('car_id') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="5" class="form-control" required>{{ old('description') }}</textarea>
            @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success">💾 Save Report</button>
        <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">⬅️ Back</a>
    </form>
</div>
@endsection
@extends('admin.AdminLayout.layout')

@section('title', 'Create Report')

@section('content')
<div class="container">
    <h2>Create Report</h2>

    <form action="{{ route('admin.reports.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            @error('title') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Select Car</label>
            <select name="car_id" class="form-select" required>
                <option value="">-- Select a Car --</option>
                @foreach($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->title }}</option>
                @endforeach
            </select>
            @error('car_id') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="5" class="form-control" required>{{ old('description') }}</textarea>
            @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success">💾 Save Report</button>
        <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">⬅️ Back</a>
    </form>
</div>
@endsection
