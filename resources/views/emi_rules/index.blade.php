@extends('layouts.app')

@section('title', 'EMI Rule List')

@section('styles')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f8;
    }

    .container {
        max-width: 1000px;
        margin: 40px auto;
        background: #fff;
        padding: 20px 30px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .header h2 {
        font-size: 24px;
        color: #333;
    }

    .create-btn {
        background-color: #007bff;
        color: white;
        padding: 8px 16px;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.2s ease-in-out;
    }

    .create-btn:hover {
        background-color: #0056b3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    th, td {
        padding: 12px 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f1f1f1;
        color: #555;
    }

    tr:hover {
        background-color: #f9f9f9;
    }

    .action-btns a,
    .action-btns button {
        margin-right: 8px;
        padding: 5px 10px;
        font-size: 13px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    .action-btns a {
        background-color: #ffc107;
        color: #fff;
        text-decoration: none;
    }

    .action-btns a:hover {
        background-color: #e0a800;
    }

    .action-btns button {
        background-color: #dc3545;
        color: white;
    }

    .action-btns button:hover {
        background-color: #c82333;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="header">
        <h2>EMI Rules</h2>
        <a href="{{ route('admin.dashboard') }}" class="create-btn">Create New</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Min Amount</th>
                <th>Max Amount</th>
                <th>Tenure</th>
                <th>Rate Of Interest (%)</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($emirules as $emi_rule)
            <tr>
                <td>{{ $emi_rule->min_amount }}</td>
                <td>{{ $emi_rule->max_amount }}</td>
                <td>{{ $emi_rule->tenure->months }} months</td>
                <td>{{ $emi_rule->rate_of_interest }}</td>
                <td>{{ $emi_rule->is_active ? 'Active' : 'Not Active' }}</td>
                <td class="action-btns">
                    <a href="{{ route('emi_rules.edit', $emi_rule) }}">Edit</a>
                    <form action="{{ route('emi_rules.destroy', $emi_rule) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
