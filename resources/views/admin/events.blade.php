
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
@include('inc/sidebar')


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
                        <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Events</p>
                    </th>
                    <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                        <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Deadline</p>
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
                @foreach($events as $event)
                    <tr>
                        <td class="py-3 px-5 border-b border-blue-gray-50">
                            <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-bold">{{ $event->titre }}</p>
                        </td>
                        <td class="py-3 px-5 border-b border-blue-gray-50">
                            <p class="block antialiased font-sans text-xs font-medium text-blue-gray-600">{{ $event->deadline }}</p>
                        </td>
                        <td class="py-3 px-5 border-b border-blue-gray-50">
                            <p class="block antialiased font-sans text-xs font-medium text-blue-gray-600">
                                {{ $event->status == 1 ? 'Automatic' : 'Manual' }}
                            </p>
                        </td>
                        <td class="py-3 px-5 border-b border-blue-gray-50">
                            <div class="flex gap-2">
                                <form method="post" action="{{ route('events.destroy', $event->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mt-2 px-2 py-1 bg-red-500 text-white font-bold rounded hover:bg-red-700 cursor-pointer">
                                        Decline
                                    </button>
                                </form>
                                <form method="post" action="{{ route('events.approve', $event->id) }}">
                                    @csrf
                                    <button type="submit" class="mt-2 px-2 py-1 bg-green-500 text-white font-bold rounded hover:bg-green-700 cursor-pointer">
                                        Approve
                                    </button>
                                </form>
                            </div>

                        </td>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

                            {{ $events->links() }}




        </div>
    </div>
</div>
</div>
</div>

<script>
    {{--function editTemplate(newsletterId) {--}}
    {{--    // Redirect to edit route with the newsletter ID--}}
    {{--    window.location.href = "{{ route('edit_newsletter_template', ['id' => '']) }}/" + newsletterId;--}}
    {{--}--}}

    {{--function sendTemplate(newsletterId) {--}}
    {{--    // Redirect to send route with the newsletter ID--}}
    {{--    window.location.href = "{{ route('send_newsletter_template', ['id' => '']) }}".replace('','/') + newsletterId;--}}
    {{--}--}}
</script>

</body>
</html>
