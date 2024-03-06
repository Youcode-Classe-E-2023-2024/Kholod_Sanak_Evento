<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>test </title>
</head>
<body>
<main class="flex min-h-screen w-full items-center justify-center bg-gray-100">
    <!-- component -->
    @foreach($subscribers as $subscriber)
        <p>You are receiving this email because you are subscribed to our newsletter.</p>
        <p>If you wish to unsubscribe, <a href="{{ route('unsubscribe', ['token' => $subscriber->unsubscribe_token]) }}">click here</a>.</p>
    @endforeach
</main>
</body>
</html>
