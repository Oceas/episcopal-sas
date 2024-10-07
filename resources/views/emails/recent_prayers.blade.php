<!-- resources/views/email/recent_prayers.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Prayers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            color: #333;
        }
        .email-container {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            background-color: #0273AA;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .prayer-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .prayer-table th, .prayer-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .prayer-table th {
            background-color: #0273AA;
            color: white;
        }
        .prayer-table td {
            background-color: #f9f9f9;
        }
        /* Adjust the width for the Request column */
        .prayer-table td.request-column {
            width: 40%; /* Make the request column wider */
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="email-container">
    <div class="header">
        <h1>Recent Prayers</h1>
    </div>

    <table class="prayer-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Request</th>
            <th>Public</th>
            <th>Reported</th>
            <th>Reason</th>
            <th>Received</th>
        </tr>
        </thead>
        <tbody>
        @foreach($prayers as $prayer)
            <tr>
                <td>{{ $prayer->name }}</td>
                <td class="request-column">{{ $prayer->request }}</td>
                <td>{{ $prayer->public ? 'Yes' : 'No' }}</td>
                <td>{{ $prayer->reported ? 'Yes' : 'No' }}</td>
                <td>{{ $prayer->reported_reason }}</td>
                <td>{{ $prayer->created_at->format('M d, Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Thank you for your attention and prayers. This message was generated automatically by our system.</p>
    </div>
</div>

</body>
</html>
