@extends('layouts.app')

@section('title','Tenures List')

@section('styles')
<style>
    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    a.btn-create {
        display: inline-block;
        padding: 8px 16px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    a.btn-create:hover {
        background-color: #45a049;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: auto;
    }

    th, td {
        padding: 12px;
        border: 1px solid #ccc;
        text-align: center;
    }

    th {
        background-color: #f4f4f4;
        color: #333;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    a {
        margin-right: 8px;
        color: #3498db;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    form {
        display: inline;
    }

    button {
        background-color: #e74c3c;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 3px;
        cursor: pointer;
    }

    button:hover {
        background-color: #c0392b;
    }
</style>
@endsection

@section('content')
<h2>Tenures</h2>
<a href="{{ route('admin.dashboard') }}" class="btn-create">Create New</a>

<table>
  <tr>
    <th>ID</th>
    <th>Months</th>
    <th>Active</th>
    <th>Actions</th>
  </tr>
  @foreach($tenures as $tenure)
  <tr>
    <td>{{ $tenure->id }}</td>
    <td>{{ $tenure->months }} months</td>
    <td>{{ $tenure->is_active ? "Yes" : "No" }}</td>
    <td>
      <a href="{{ route('tenures.edit', $tenure) }}">Edit</a>
      <form action="{{ route('tenures.destroy', $tenure) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Delete this?')">Delete</button>
      </form>
    </td>
  </tr>
  @endforeach
</table>
@endsection
