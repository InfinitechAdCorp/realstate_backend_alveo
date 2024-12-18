// resources/views/emails/appointmentAccepted.blade.php

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Appointment</title>
</head>
<body>
    <h1>Your Appointment has been Accepted!</h1>
    <p>Dear {{ $appointment->fullname }},</p>
    <p>Your appointment for the property: {{ $appointment->property }} has been accepted successfully.</p>
    <p>Message: {{ $appointment->message }}</p>
    <p>Thank you for using our service!</p>
</body>
</html>
