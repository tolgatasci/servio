{{-- emails/offer.blade.php --}}
        <!DOCTYPE html>
<html>
<head>
    <style>
        .email-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .email-table th,
        .email-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .email-table th {
            background-color: #f8f9fa;
        }
        .offer-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
<h1>New Offer Request</h1>

<p>Dear Partner, </p>

<p>Please review the following application details and provide your offer:</p>

<table class="email-table">
    <tr>
        <th>Field</th>
        <th>Value</th>
    </tr>
    @foreach($publishedFields as $field)
        <tr>
            <td>{{ $field['label'] }}</td>
            <td>{{ $field['value'] }}</td>
        </tr>
    @endforeach
</table>

<a href="{{ route('offer.give', $offer->id) }}" class="offer-button">GIVE OFFER</a>

<p>Thanks,<br>
    {{ config('app.name') }}</p>
</body>
</html>