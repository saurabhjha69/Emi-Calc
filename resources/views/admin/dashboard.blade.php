@extends('layouts.app')

@section('title', 'Manage Tenures & EMI Rules')

@section('content')
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

    <div class="form-wrapper">
        <h2>Manage Tenures & EMI Rules</h2>

        <form method="POST" action="{{ route('tenures.store') }}">
            @csrf
            <h3>Add Tenure</h3>

            <label for="months">Number of Months</label>
            <input
                type="number"
                name="months"
                id="months"
                min="6"
                step="6"
                max="360"
                placeholder="e.g. 6, 12, 18, 24"
                required
            >
            @error('months')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="checkbox-group">
                <input type="checkbox" name="is_active" id="is_active" checked>
                <label for="is_active">Keep it active</label>
            </div>

            <button type="submit" class="btn">Add Tenure</button>
        </form>

        <form method="POST" action="{{ route('emi_rules.store') }}" class="form-section">
            @csrf
            @method('POST')
            <h3>Create EMI Rule</h3>

            <label for="min_amount">Minimum Amount</label>
            <input
                type="number"
                name="min_amount"
                id="min_amount"
                value="{{ old('min_amount') }}"
                required
            >
            @error('min_amount')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="max_amount">Maximum Amount</label>
            <input
                type="number"
                name="max_amount"
                id="max_amount"
                value="{{ old('max_amount') }}"
                required
            >
            @error('max_amount')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="tenure_id">Select Tenure</label>
            <select name="tenure_id" id="tenure_id" required>
                <option value="">-- Select Tenure --</option>
                @foreach ($tenures as $tenure)
                    <option value="{{ $tenure->id }}" {{ old('tenure_id') == $tenure->id ? 'selected' : '' }}>
                        {{ $tenure->months }} months
                    </option>
                @endforeach
            </select>
            @error('tenure_id')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="rate_of_interest">Interest Rate (%)</label>
            <input
                type="number"
                step="0.05"
                name="rate_of_interest"
                id="rate_of_interest"
                value="{{ old('rate_of_interest') }}"
                required
            >
            @error('rate_of_interest')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="checkbox-group">
                <input type="checkbox" name="is_active" id="is_active" checked >
                <label for="is_active">Keep it active</label>
            </div>

            <button type="submit" class="btn">Create EMI Rule</button>
        </form>
    </div>
@endsection
