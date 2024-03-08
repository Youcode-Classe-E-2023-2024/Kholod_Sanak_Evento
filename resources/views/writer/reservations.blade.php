
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>Organizer Dashboard</title>
</head>
<body>

<div class=" mt-20 bg-gray-50/50">
    @include('inc/sidebarWriter')


    {{--            List--}}
    <div class="xl:w-full  mb-4 grid grid-cols-1 gap-6 xl:grid-cols-3 ml-80 ">

        <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md overflow-hidden xl:col-span-2">
            <div class="relative bg-clip-border rounded-xl overflow-hidden bg-transparent text-gray-700 shadow-none m-0 flex items-center justify-between p-6">

                <div></div>
            </div>
            <div class="p-6 overflow-x-scroll px-0 pt-0 pb-2">
                {{--                table--}}
                {{-- table --}}
                <table class="w-full min-w-[640px] table-auto">
                    <thead>
                    <tr>
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Reservations</p>
                        </th>

                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Status</p>
                        </th>

                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Action</p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-bold">{{ optional($reservation->event)->titre }}</p>
                            </td>

                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <p class="block antialiased font-sans text-xs font-medium text-blue-gray-600">
                                    {{ $reservation->status == 1 ? 'Automatic' : 'Manual' }}
                                </p>
                            </td>

                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <div class="flex gap-2">
{{--                                    approve reservation--}}
                                    <form method="post" action="{{ route('reservations.approve', $reservation->id) }}">
                                        @csrf
                                        <button type="submit" class="mt-2 px-2 py-1 bg-blue-500 text-white font-bold rounded hover:bg-blue-700 cursor-pointer">Approve</button>
                                    </form>
                                    {{--Decline reservation--}}
                                    <form method="post" action="{{ route('reservations.decline', $reservation->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="mt-2 px-2 py-1 bg-red-500 text-white font-bold rounded hover:bg-red-700 cursor-pointer">Decline</button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

                {{ $reservations->links() }}




            </div>
        </div>
    </div>
</div>
</div>



</body>
</html>
