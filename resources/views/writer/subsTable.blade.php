<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Writer Dashboard</title>
</head>
<body class="bg-gray-100">

<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
{{--    @include('inc/sidebarWriter')--}}

    <!-- Content -->
    <div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
        <div class="container mx-auto mt-20">


            <!-- Subscriber List -->
            <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
                <div class="col-span-2">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="bg-gray-200 rounded-t-xl p-6">
                            <h2 class="text-xl font-semibold text-gray-700">Subscriber List</h2>
                        </div>
                        <div class="p-6 overflow-x-scroll">
                            <table class="w-full table-auto">
                                <thead>
                                <tr>
                                    <th class="py-3 px-6 text-left">Emails</th>
                                    <th class="py-3 px-6 text-left">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($subscribers as $subscriber)
                                    <tr>
                                        <td class="py-3 px-5 border-b">
                                            <p class="text-blue-gray-900 font-bold">{{ $subscriber->email }}</p>
                                        </td>
                                        <td class="py-3 px-5 border-b">
                                            <p class="text-blue-gray-600">{{ $subscriber->status }}</p>
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
    </div>
</div>

</body>
</html>
