@foreach($contacts as $contact)
    <option value="{{ $contact->id }}">{{ $contact->name }}</option>
@endforeach
