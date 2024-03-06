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
                <a href="{{route('restore')}}" aria-expanded="false" aria-haspopup="menu" id=":r5:"
                        class="relative middle none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-8 max-w-[32px] h-8 max-h-[32px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30" type="button">
                    <svg class="text-blue-gray-500 group-hover:text-blue-gray-600 w-8 h-8" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h48v48h-48z" fill="none"/>
                        <path d="M25.99 6c-9.95 0-17.99 8.06-17.99 18h-6l7.79 7.79.14.29 8.07-8.08h-6c0-7.73 6.27-14 14-14s14 6.27 14 14-6.27 14-14 14c-3.87 0-7.36-1.58-9.89-4.11l-2.83 2.83c3.25 3.26 7.74 5.28 12.71 5.28 9.95 0 18.01-8.06 18.01-18s-8.06-18-18.01-18zm-1.99 10v10l8.56 5.08 1.44-2.43-7-4.15v-8.5h-3z"/>
                    </svg>
                    <span class="absolute left-0 -bottom-8 text-xs text-blue-gray-600 opacity-0 group-hover:opacity-100">Restore deleted users</span>
                </a>
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
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Roles</p>
                        </th>
{{--                        assign role--}}
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Assign Role</p>
                        </th>
{{--                        action--}}
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Action</p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <div class="flex items-center gap-4">
                                    <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-bold">{{ $user->name }}</p>
                                </div>
                            </td>
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <p class="block antialiased font-sans text-xs font-medium text-blue-gray-600">
                                    @foreach($user->roles as $role)
                                        {{ $role->name }}@if(!$loop->last),@endif
                                    @endforeach
                                </p>
                            </td>
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <div class="w-10/12 px-2">
{{--                                    form to update--}}
                                    <form method="POST" action="{{ route('updateUserRole', ['user' => $user->id]) }}">
                                        @csrf
                                        @method('PUT')

                                        <select name="role">
                                            @foreach($allRoles as $role)
                                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    <button type="submit" class="mt-2 px-2 py-1 text-white cursor-pointer">
                                        <svg height="24" version="1.1" width="24" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
                                            <g transform="translate(0 -1028.4)">
                                                <path d="m22 12c0 5.523-4.477 10-10 10-5.5228 0-10-4.477-10-10 0-5.5228 4.4772-10 10-10 5.523 0 10 4.4772 10 10z" fill="#27ae60" transform="translate(0 1029.4)"/>
                                                <path d="m22 12c0 5.523-4.477 10-10 10-5.5228 0-10-4.477-10-10 0-5.5228 4.4772-10 10-10 5.523 0 10 4.4772 10 10z" fill="#2ecc71" transform="translate(0 1028.4)"/>
                                                <path d="m16 1037.4-6 6-2.5-2.5-2.125 2.1 2.5 2.5 2 2 0.125 0.1 8.125-8.1-2.125-2.1z" fill="#27ae60"/>
                                                <path d="m16 1036.4-6 6-2.5-2.5-2.125 2.1 2.5 2.5 2 2 0.125 0.1 8.125-8.1-2.125-2.1z" fill="#ecf0f1"/>
                                            </g>
                                        </svg>
                                    </button>
                                    </form>
                                </div>
                            </td>
{{--                            delete user--}}
                            <td>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button  type="submit" class=" flex   delete_product text-red-500 hover:text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <p>Delete</p>
                                        </button>
                                    </form>
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
