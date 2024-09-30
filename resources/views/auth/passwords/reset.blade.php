<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
</head>

<body>
    <h1>Reset Password</h1>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div>
            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
            <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" required>
            @error('password')
            <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit">Reset Password</button>
    </form>
</body>

</html>