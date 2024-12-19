
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Submitted Property</title>
</head>
<body>
    <h1>Your Submitted Property has been Accepted!</h1>
    <p>Dear {{ $appointment->first_name }} {{$appointment->last_name}},</p>
    <p>Your property: {{ $appointment->property_name }} has been accepted successfully.</p>
    <p>Thank you for using our service!</p>
</body>
</html>
