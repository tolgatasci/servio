<div class="p-4 bg-white rounded shadow">
    <h2>Contact Details</h2>

    <div>
        <strong>Name:</strong> {{ $contact->name }}
    </div>
    <div>
        <strong>Email:</strong> {{ $contact->email }}
    </div>
    <div>
        <strong>Subject:</strong> {{ $contact->subject }}
    </div>
    <div>
        <strong>Message:</strong>
        <p>{{ $contact->message }}</p>
    </div>
    <div>
        <strong>Sent At:</strong> {{ $contact->created_at->toDateTimeString() }}
    </div>
</div>
