<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Link</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1f2937;
            color: #f9fafb;
            text-align: center;
            padding: 2rem;
        }
        .container {
            background-color: #111827;
            padding: 2rem;
            border-radius: 8px;
            max-width: 500px;
            margin: auto;
            color: #f9fafb;
        }
        .button {
            display: inline-block;
            padding: 1rem 2rem;
            background-color: #3b82f6;
            color: #ffffff;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 1rem;
        }
        .button:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 style="font-size: 24px; margin-bottom: 1rem;">You Are subscribing With newsletter </h1>
    <p style="font-size: 16px; line-height: 1.5;">
        Hi, <br>
        Thank you for subscribing to our newsletter. Please click the button below to login to your account.
    </p>
    <a href="{{ route('front.index') }}" class="button">Go To Site</a>
    <p style="margin-top: 2rem; font-size: 14px; color: #9ca3af;">
{{--        This link is valid for a limited time and can only be used once.--}}
        If you did not request this email, please ignore it.
    </p>


</div>
</body>
</html>
