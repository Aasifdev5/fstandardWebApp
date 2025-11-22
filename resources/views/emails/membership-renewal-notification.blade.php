<!DOCTYPE html>
<html>
<head>
    <title>Membership Renewal Confirmation</title>
</head>
<body>
    <h1>Hi {{ $user->name }},</h1>

    <p>Thank you for renewing your membership!</p>

    <p>Your membership type: <strong>{{ $membershipType }}</strong></p>
    <p>Membership is valid until: <strong>{{ $membershipEndDate->format('F d, Y') }}</strong></p>

    <p>We appreciate your continued support and look forward to serving you in the coming year!</p>

    <p>Best regards,</p>
    <p>The Team</p>
</body>
</html>
