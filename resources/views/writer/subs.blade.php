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
{{--                download button--}}
                <button onclick="window.location='{{ route('generate.pdf') }}'" aria-expanded="false" aria-haspopup="menu" id=":r5:"
                        class="relative middle none font-sans font-medium text-center uppercase transition-all
                        disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-8 max-w-[32px]
                        h-8 max-h-[32px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10
                        active:bg-blue-gray-500/30" type="button">
                  <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                    <svg enable-background="new 0 0 50 50" height="30px" id="Layer_1"
                         version="1.1" viewBox="0 0 50 50" width="30px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><rect fill="none" height="50" width="50"/><circle cx="43" cy="21" r="2"/><path d="M40,15V1H10v14" fill="none" stroke="#000000" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"/><path d="M40,29v20H10V29H40z" fill="none" stroke="#000000" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"/><path d="M10,40H3  c-1.104,0-2-0.896-2-2V17c0-1.104,0.896-2,2-2h44c1.104,0,2,0.896,2,2v21c0,1.104-0.896,2-2,2h-7" fill="none" stroke="#000000" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"/><line fill="none" stroke="#000000" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" x1="35" x2="15" y1="35" y2="35"/><line fill="none" stroke="#000000" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" x1="31" x2="15" y1="39" y2="39"/><line fill="none" stroke="#000000" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" x1="35" x2="15" y1="43" y2="43"/></svg>
                  </span>
                </button>
            </div>
            <div class="p-6 overflow-x-scroll px-0 pt-0 pb-2">
                {{--                table--}}
                <table class="w-full min-w-[640px] table-auto">
                    <thead>
                    <tr>
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Emails</p>
                        </th>
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Status</p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($subscribers as $subscriber)
                        <tr>
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <div class="flex items-center gap-4">
                                    <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-bold">{{ $subscriber->email }}</p>
                                </div>
                            </td>
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <p class="block antialiased font-sans text-xs font-medium text-blue-gray-600">{{ $subscriber->status }}</p>
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
