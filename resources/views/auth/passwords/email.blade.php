<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
</head>

<body>
    <h1>Forgot Password</h1>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div>
            <label>Email Address</label>
            <input type="email" name="email" required autofocus>
            @error('email')
            <span>{{ $message }}</span>
            @enderror
        </div>
        <button type="submit">Send Password Reset Link</button>
    </form>
</body>

</html>