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
                <a href="{{route('addMedia')}}" aria-expanded="false" aria-haspopup="menu" id=":r5:"
                        class="relative middle none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-8 max-w-[32px] h-8 max-h-[32px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30" type="button">
{{--              <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">--}}
{{--            Add Media--}}
{{--                  --}}{{--               <svg data-name="Livello 1" id="Livello_1" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg"><title/><path d="M64,0a64,64,0,1,0,64,64A64.07,64.07,0,0,0,64,0Zm0,122a58,58,0,1,1,58-58A58.07,58.07,0,0,1,64,122Z"/><path d="M90,61H67V38a3,3,0,0,0-6,0V61H38a3,3,0,0,0,0,6H61V90a3,3,0,0,0,6,0V67H90a3,3,0,0,0,0-6Z"/></svg>--}}
{{--              </span>--}}
                    <svg style="enable-background:new 0 0 24 24;" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="info"/><g id="icons">
                            <path d="M12,1C5.9,1,1,5.9,1,12s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z M17,14h-3v3c0,1.1-0.9,2-2,2s-2-0.9-2-2v-3H7   c-1.1,0-2-0.9-2-2c0-1.1,0.9-2,2-2h3V7c0-1.1,0.9-2,2-2s2,0.9,2,2v3h3c1.1,0,2,0.9,2,2C19,13.1,18.1,14,17,14z" id="add"/></g></svg>                </a>

                </a>
            </div>
            <div class="p-6 overflow-x-scroll px-0 pt-0 pb-2">
                {{--                table--}}
                <table class="w-full min-w-[640px] table-auto">
                    <thead>
                    <tr>
                        {{-- Media --}}
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Media</p>
                        </th>
{{--                         Created at--}}
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Created at</p>
                        </th>
{{--                         Action--}}
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Action</p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mediaList as  $mediaItem)
                        <tr>
                            {{-- Media --}}
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <div class="flex items-center gap-4">
                                    {{-- Display the media name or file name --}}
                                    <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-bold">{{ Str::limit($mediaItem->name, 10) }}
                                    </p>
                                </div>
                            </td>
                            {{-- Created at --}}
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                {{-- Display the created_at timestamp --}}
                                <p class="block antialiased font-sans text-xs font-medium text-blue-gray-600">{{ $mediaItem->created_at }}</p>
                            </td>
                            {{-- Action--}}
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <!-- Add delete and modify buttons -->
                                <div class="flex items-center gap-4">
                                    <!-- Delete button -->
                                    <form action="{{ route('media.delete', ['id' => $mediaItem->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button  class=" delete_product text-red-500 hover:text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <p>Delete</p>
                                        </button>                                    </form>
                                    <!-- Modify button -->
{{--                                    <a href="{{ route('media.update', ['id' => $media->id]) }}" class="text-blue-500 hover:text-blue-700">Modify</a>--}}
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
