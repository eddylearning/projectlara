@extends('admin.AdminLayout.layout')

@section('title', 'Edit Report')

@section('content')
<div class="container">
    <h2>Edit Report</h2>

    <form action="{{ route('admin.reports.update', $report) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $report->title) }}" required>
            @error('title') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Select Car</label>
            <select name="car_id" class="form-select" required>
                @foreach($cars as $car)
                    <option value="{{ $car->id }}" {{ $report->car_id == $car->id ? 'selected' : '' }}>
                        {{ $car->title }}
                    </option>
                @endforeach
            </select>
            @error('car_id') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="5" class="form-control" required>{{ old('description', $report->description) }}</textarea>
            @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">💾 Update Report</button>
        <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">⬅️ Back</a>
    </form>
</div>
@endsection
