@extends('layouts.app')
<?php 
    use App\Models\Group;
    use App\Models\Contact;
?>

@section('content')
<div class = "container">
    <h1>Contacts and Groups</h1>
    <a href="{{ route('groups.create') }}" class="btn btn-success mb-3">Create Group</a>
    <a href="{{ route('contact-group.create') }}" class="btn btn-primary mb-3">Add Group Member</a>
    <input id="myInput" type="text" class="form-control" placeholder="Search.."><br>

    <table id="myTable" class = "table table-bordered">
        <thead>
            <tr>
                <th>Group Name</th>
                <th>Contact Name</th>
            </tr>
        </thead>
        <tbody>     
            @foreach($groups as $contact)
                @php 
                    $groups  = Group::where('id',$contact->group_id)->first();
                    $contact = Contact::where('id',$contact->contact_id)->first();
                @endphp
                <tr>
                    <td>{{ $groups ? $groups->name : 'N/A' }}</td>
                    <td>{{ $contact->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
