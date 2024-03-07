<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .num {
            font-size: 60px;
            text-align: center;
            color: #111;
        }

        .day {
            text-align: center;
            font-size: 25px;
        }
    </style>
</head>
<body>


<div class="container mx-auto max-w-7xl">
    <div class="item bg-white p-0 sm:p-20 overflow-hidden my-10 border border-gray-300">
        <div class="item-right float-left p-20">
            <h2 class="num">{{ $ticket->event->deadline->format('d') }} {{ $ticket->event->deadline->format('M') }}</h2>
            <p class="day">{{ $ticket->event->deadline->format('M') }}</p>
            <span class="up-border"></span>
            <span class="down-border"></span>
        </div>

        <div class="item-left w-4/5 sm:w-3/4 p-0 sm:p-34 border-l-3 border-dotted border-gray-300">
            <p class="event">{{ $ticket->event->titre }}</p>
            <h2 class="title">{{ $ticket->event->description }}</h2>

            <div class="sce mt-5">
                <div class="icon float-left mr-3">
                    <i class="fa fa-table"></i>
                </div>
                <p>{{ $ticket->event->deadline->format('l jS Y') }} <br> {{ $ticket->created_at->format('H:i A') }}</p>
            </div>
            <div class="clearfix"></div>
            <div class="loc mt-5">
                <div class="icon float-left mr-3">
                    <i class="fa fa-map-marker"></i>
                </div>
                <p>{{ $ticket->event->lieu->ville }}</p>
            </div>
            <div class="clearfix"></div>
            <button class="tickets bg-gray-700 text-white px-14 py-6 float-right mt-10">Tickets</button>
        </div>
    </div>
</div>


</body>
</html>
