<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Success</title>
</head>
<body>
    <script>
        // Set the token in localStorage
        localStorage.setItem("jwt_token", "{{ $jwtToken }}");
        // Redirect to the dashboard
        window.location.href = "{{ route('dashboard') }}";
    </script>
</body>
</html>

