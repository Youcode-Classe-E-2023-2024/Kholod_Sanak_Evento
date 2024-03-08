<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .event-description {
            font-family: 'Inknut Antiqua', serif;
        }

        .num {
            font-family: 'Ravi Prakash', cursive;
        }

        .day,
        .event {
            font-family: 'Lora', serif;
        }

        .sce p,
        .loc p {
            font-family: 'Indie Flower', cursive;
        }

        .tickets,
        .booked,
        .cancel {
            font-family: 'Cabin', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-300">

<div class="container mx-auto">
    <div class="item bg-white rounded overflow-hidden shadow-lg my-10 mx-auto md:w-1/2">
        <div class="item-right p-10">
            <h2 class="num text-6xl">{{ $ticket->event->deadline->format('d') }}</h2>
            <p class="day text-2xl">{{ $ticket->event->deadline->format('M') }}</p>
            <span class="up-border bg-gray-400 rounded-full p-3 absolute top-0 right-0"></span>
            <span class="down-border bg-gray-400 rounded-full p-3 absolute bottom-0 right-0"></span>
        </div>

        <div class="item-left border-l-4 border-dotted border-gray-900 p-8">
            <p class="event text-2xl">{{ $ticket->event->titre }}</p>
            <h2 class="title text-4xl">{{ $ticket->event->description }}</h2>

            <div class="sce flex items-center mt-5">
                <div class="icon">
                    <i class="fa fa-table"></i>
                </div>
                <p>{{ $ticket->event->deadline->format('l jS Y') }} <br> {{ $ticket->created_at->format('H:i A') }}</p>
            </div>
            <div class="loc flex items-center">
                <div class="icon">
                    <i class="fa fa-map-marker"></i>
                </div>
                <p>{{ $ticket->event->lieu->ville }}</p>
            </div>
            <button class="tickets bg-gray-700 text-white px-6 py-2 mt-5">Tickets</button>
        </div>
    </div>
</div>

</body>

</html>
