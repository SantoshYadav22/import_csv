<!-- resources/views/groups/create.blade.php -->
@extends('layouts.app')
@section('content')

    <div class="container">
        <h1>Create a New Group</h1>
        <a href="{{ route('contacts.create') }}" class="btn btn-primary mb-3">Add Contact</a>
        <a href="{{ route('view_group') }}" class="btn btn-success mb-3">View Group</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('groups.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Group Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div><br>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection