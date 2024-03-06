<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>Writer Dashboard</title>
</head>
<body>

<div class=" mt-20 bg-gray-50/50">
    @include('inc/sidebarWriter')


    {{--            List--}}
    <div class="xl:w-full  mb-4 grid grid-cols-1 gap-6 xl:grid-cols-3 ml-80 ">

        <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md overflow-hidden xl:col-span-2">
            <div class="relative bg-clip-border rounded-xl overflow-hidden bg-transparent text-gray-700 shadow-none m-0 flex items-center justify-between p-6">

                <div></div>
                <a href="{{route('addTemplate')}}"
                        class="relative middle none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-8 max-w-[32px] h-8 max-h-[32px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30" type="button">
{{--              <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">--}}
{{--                  add template--}}
                <svg style="enable-background:new 0 0 24 24;" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="info"/><g id="icons">
                        <path d="M12,1C5.9,1,1,5.9,1,12s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z M17,14h-3v3c0,1.1-0.9,2-2,2s-2-0.9-2-2v-3H7   c-1.1,0-2-0.9-2-2c0-1.1,0.9-2,2-2h3V7c0-1.1,0.9-2,2-2s2,0.9,2,2v3h3c1.1,0,2,0.9,2,2C19,13.1,18.1,14,17,14z" id="add"/></g></svg>                </a>
            </div>
            <div class="p-6 overflow-x-scroll px-0 pt-0 pb-2">
                {{--                table--}}
                {{-- table --}}
                <table class="w-full min-w-[640px] table-auto">
                    <thead>
                    <tr>
                        {{-- template --}}
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Template</p>
                        </th>
                        {{-- created at --}}
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Created at</p>
                        </th>
                        {{-- status --}}
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Status</p>
                        </th>
                        {{-- Action --}}
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Action</p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($newsletters as $newsletter)
                        <tr>
                            {{-- template --}}
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-bold">{{ $newsletter->titre }}</p>
                            </td>
                            {{-- created at --}}
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <p class="block antialiased font-sans text-xs font-medium text-blue-gray-600">{{ $newsletter->created_at }}</p>
                            </td>
                            {{-- status --}}
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <p class="block antialiased font-sans text-xs font-medium text-blue-gray-600">{{ $newsletter->status }}</p>
                            </td>
                            {{-- action --}}
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <div class="flex gap-2">
                                    {{-- Edit button --}}
                                    {{-- <form>
                                        <button type="submit" class="mt-2 px-2 py-1 bg-blue-500 text-white font-bold rounded hover:bg-blue-700 cursor-pointer">
                                            Edit
                                        </button>
                                    </form> --}}

                                    {{-- Send button --}}
                                    <form method="post" action="{{ route('send_newsletter_template', ['id' => $newsletter->id]) }}">
                                        @csrf
                                        <button type="submit" class="mt-2 px-2 py-1 bg-green-500 text-white font-bold rounded hover:bg-green-700 cursor-pointer">
                                            Send
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $newsletters->links() }}




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
