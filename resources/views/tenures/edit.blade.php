@extends('layouts.app')

@section('title','Edit Tenure')

@section('styles')

    <style>
        .form-wrapper {
        max-width: 700px;
        margin: 40px auto;
        background: #fff;
        padding: 24px;
        border-radius: 10px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
    }

    .form-wrapper h2 {
        font-size: 24px;
        text-align: center;
        margin-bottom: 20px;
    }

    .form-section {
        margin-top: 30px;
        border-top: 1px solid #e0e0e0;
        padding-top: 20px;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #333;
    }

    input[type="number"],
    select {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        margin-bottom: 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 16px;
    }

    .checkbox-group input {
        width: auto;
        margin: 0;
    }

    .error {
        color: #d32f2f;
        font-size: 13px;
        margin-top: -8px;
        margin-bottom: 12px;
    }

    .btn {
        display: inline-block;
        background: #2563eb;
        color: #fff;
        border: none;
        padding: 10px 16px;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
    }

    .btn:hover {
        background: #1e40af;
    }
    </style>
@endsection

@section('content')
    <form method="POST" action="{{ route('tenures.update',$tenure) }}">
            @csrf
            @method('PUT')
            <h3>Edit Tenure</h3>

            <label for="months">Number of Months</label>
            <input
                type="number"
                name="months"
                id="months"
                min="6"
                step="6"
                max="360"
                placeholder="e.g. 6, 12, 18, 24"
                value={{ $tenure->months }}
                required
            >
            @error('months')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="checkbox-group">
                <input type="checkbox" name="is_active" id="is_active" {{ $tenure->is_active ? 'checked' : null  }}>
                <label for="is_active">Keep it active</label>
            </div>

            <button type="submit" class="btn">Update Tenure</button>
        </form>
@endsection
