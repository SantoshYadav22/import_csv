<!-- resources/views/emails/contact-updated.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Contact Updated</title>
</head>
<body>
    <h1>Contact Updated</h1>
    <p>Dear {{ $contact->name }},</p>
    <p>Your contact details have been updated. Here are the changes:</p>
    <ul>
        @foreach($changes as $field => $value)
            <li><strong>{{ ucfirst($field) }}:</strong> {{ $value['old'] }} -> {{ $value['new'] }}</li>
        @endforeach
    </ul>
    <p>Thank you.</p>
</body>
</html>
