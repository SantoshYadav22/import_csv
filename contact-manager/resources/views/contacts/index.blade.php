<!-- resources/views/contacts/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Contact List</h1>
    <a href="{{ route('contacts.create') }}" class="btn btn-primary mb-3">Add Contact</a>
    <a href="{{ route('contacts_export') }}" class="btn btn-success mb-3">Export Contacts</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form action="{{ route('contacts.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
            <input type="file" class="form-control" name="file" required>
            <button class="btn btn-primary" type="submit">Import Contacts</button>
        </div>
    </form>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th><a href="{{ route('contacts.index', ['sort_by' => 'name', 'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc']) }}">Name</a></th>
            <th><a href="{{ route('contacts.index', ['sort_by' => 'email', 'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc']) }}">Email</a></th>
            <th><a href="{{ route('contacts.index', ['sort_by' => 'phone', 'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc']) }}">Phone</a></th>
            <th>Action</th>
        </tr>
        @foreach ($contacts as $key => $contact)
        <tr> 
            <td>{{$key + 1 }}</td>
            <td>{{ $contact->name }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->phone }}</td>
            <td>
                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
                    {{-- <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-info">Show</a> --}}
                    <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-primary">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $contacts->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
</div>
@endsection
