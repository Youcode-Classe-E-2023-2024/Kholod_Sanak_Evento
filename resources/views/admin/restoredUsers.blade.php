<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>Admin Dashboard</title>
</head>
<body>

<div class=" mt-20 bg-gray-50/50">
    @include('inc/sidebar')


    {{--            List--}}
    <div class="xl:w-full  mb-4 grid grid-cols-1 gap-6 xl:grid-cols-3 ml-80 ">

        <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md overflow-hidden xl:col-span-2">
            <div class="relative bg-clip-border rounded-xl overflow-hidden bg-transparent text-gray-700 shadow-none m-0 flex items-center justify-between p-6">

                <div></div>
                <a href="{{route('usersList')}}" aria-expanded="false" aria-haspopup="menu" id=":r5:"
                   class="relative middle none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-8 max-w-[32px] h-8 max-h-[32px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30" type="button">
                    <svg data-name="Layer 1" id="Layer_1" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M478,280.82a123.1,123.1,0,0,1-123,123H34V373.94H355a93.12,93.12,0,0,0,0-186.23H157l28.53,28.54-21.1,21.11L99.84,172.78l64.58-64.57,21.1,21.11L157,157.86H355A123.1,123.1,0,0,1,478,280.82Z"/></svg>                </a>
            </div>
            <div class="p-6 overflow-x-scroll px-0 pt-0 pb-2">
                {{--                table--}}
                <table class="w-full min-w-[640px] table-auto">
                    <thead>
                    <tr>
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Names</p>
                        </th>
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Action</p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($trashedUsers as $user)
                        <tr>
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <div class="flex items-center gap-4">
                                    <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-bold">{{ $user->name }}</p>
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('users.restore', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class=" flex text-blue-500 hover:text-blue-600 edit-product">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <p>Restore</p>
                                    </button>                                  </form>
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
