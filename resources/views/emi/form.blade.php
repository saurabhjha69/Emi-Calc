@extends('layouts.app')

@section('content')
<div class="emi-container">
    <h2>EMI Calculator</h2>

    @if(session('result'))
        <div class="result">
            <p><strong>Principal Amount:</strong> ₹{{ number_format(session('result')['pamount'], 2) }}</p>
            <p><strong>No. of Year:</strong> {{    session('result')['year'] }}</p>
            <p><strong>Rate (Interest):</strong> {{ session('result')['rate'] }} %</p>
            <p><strong>Monthly EMI:</strong> ₹{{ number_format(session('result')['emi'], 2) }}</p>
            <p><strong>Total Interest:</strong> ₹{{ number_format(session('result')['interest'], 2) }}</p>
            <p><strong>Total Payable:</strong> ₹{{ number_format(session('result')['total'], 2) }}</p>
        </div>
    @endif

    <form action="{{ route('emi.calculate') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="principal_amount">Loan Amount (₹)</label>
            <input type="number" name="principal_amount" id="principal_amount" required min="10000" step="1000" value="{{ old('principal_amount') }}">
        </div>
        @error('principal_amount')
            <p>{{ $message }}</p>
        @enderror

        <div class="form-group">
        <label for="tenure_id">Select Tenure</label>
            <select name="tenure_id" id="tenure_id" required>
                <option value="">-- Select Tenure --</option>
                @foreach ($tenures as $tenure)
                    <option value="{{ $tenure->id }}" {{ old('tenure_id') == $tenure->id ? 'selected' : '' }}>
                        {{ $tenure->months }} months
                    </option>
                @endforeach
            </select>
        </div>
        @error('tenure_id')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">Calculate EMI</button>
    </form>
</div>
@endsection

@section('styles')
<style>
.emi-container {
    max-width: 500px;
    margin: 50px auto;
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.emi-container h2 {
    text-align: center;
    margin-bottom: 20px;
}
.form-group {
    margin-bottom: 15px;
}
label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
}
input {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
}
button {
    width: 100%;
    padding: 10px;
    background: #007BFF;
    border: none;
    color: #fff;
    font-weight: bold;
    border-radius: 6px;
    cursor: pointer;
}
button:hover {
    background: #0056b3;
}
.result {
    background: #f0f8ff;
    padding: 15px;
    border: 1px solid #007BFF;
    border-radius: 6px;
    margin-bottom: 15px;
    text-align: left;
    color: #003366;
}
.result p {
    margin: 6px 0;
}
</style>
@endsection
