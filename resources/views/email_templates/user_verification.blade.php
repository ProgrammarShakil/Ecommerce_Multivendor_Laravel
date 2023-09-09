<!DOCTYPE html>
<html lang="en">

<body>
    <div>
        <h3>Dear {{ $user->name }}</h3>
        <p>Your account has been created, please click the following link to verify your accout.</p>
        <a
            href="{{ route('verify', $user->email_verification_token) }}">{{ route('verify', $user->email_verification_token) }}</a>

        <br>

        <p>Thanks!</p>
    </div>
</body>

</html>
