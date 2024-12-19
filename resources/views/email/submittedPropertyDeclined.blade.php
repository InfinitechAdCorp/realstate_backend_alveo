
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Submitted Property</title>
</head>
<body>
    <h1>Your Submitted Property has been Declined</h1>
    <p>Dear {{ $appointment->first_name }} {{$appointment->last_name}},</p>
    <p>We are so sorry to inform you that your appointment for the property: {{ $appointment->property_name }} has been declined.</p>
    <p>Thank you for using your time!</p>
</body>
</html>
