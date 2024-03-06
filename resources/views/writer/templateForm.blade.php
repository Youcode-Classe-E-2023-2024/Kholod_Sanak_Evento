<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Form Title</title>
    <!-- Add your CSS stylesheets or include a stylesheet framework (e.g., Tailwind CSS) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

<form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data"
      class="max-w-screen-md mx-auto mt-8 p-6 bg-gray-100 rounded-md shadow-md">


    @csrf
    <div class="text-3xl text-red-900 pt-5 mb-10 text-center font-bold">Ajouter un evenement</div>

    <div class="-mx-3 flex flex-wrap">
        <input type="hidden" name="id">
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="titre" class="mb-3 block text-base font-medium text-[#07074D]">
                    Titre
                </label>
                @error('title')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                <input type="text" name="title" placeholder="Titre"
                       class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
            </div>
        </div>

        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="media" class="mb-3 block text-base font-medium ">
                    Category
                </label>
                @error('category')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                <div class="rounded-md border border-[#e0e0e0] p-1 py-1 bg-white outline-none flex">
                    <select class="rounded w-full pb-2 py-2 px-4 placeholder-gray-500 outline-none" name="category"
                            id="">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="-mx-3 flex flex-wrap">
        <input type="hidden" name="id">
        <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
                <label for="titre" class="mb-3 block text-base font-medium text-[#07074D]">
                    Prix
                </label>
                @error('price')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                <input type="number" name="price" placeholder="Prix"
                       class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
            </div>
        </div>

        <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
                <label for="media" class="mb-3 block text-base font-medium ">
                    Lieu
                </label>
                @error('lieu')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                <div class="rounded-md border border-[#e0e0e0] p-1 py-1 bg-white outline-none flex">
                    <select class="rounded w-full pb-2 py-2 px-4 placeholder-gray-500 outline-none" name="lieu"
                            id="">
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->ville }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
                <label for="media" class="mb-3 block text-base font-medium ">
                    Nombre de place
                </label>
                @error('place')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                <input type="number" name="place" placeholder="Nombre de place"
                       class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
            </div>
        </div>

    </div>

    <div class="-mx-3 flex flex-wrap">

        <input type="hidden" name="id">
        <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
                <label class="mb-3 block text-base font-medium text-[#07074D]">
                    Image
                </label>
                @error('image')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                <input type="file" name="image[]" placeholder="Description"
                       class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
            </div>
        </div>

        <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
                <label for="media" class="mb-3 block text-base font-medium ">
                    Date de l'evenement
                </label>
                @error('deadline')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                <input type="date" name="deadline" placeholder="Jour de l'evenement"
                       class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
            </div>
        </div>

        <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
                <label for="reservation_type" class="block text-base font-medium mb-3">
                    Reservation Type
                </label>
                <select name="reservation_type"
                        class="block w-full py-2 px-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    <option value="automatic">Automatic</option>
                    <option value="manual">Manual</option>
                </select>
            </div>
        </div>

    <div class=" w-full">
        <label class="mb-3 block text-base font-medium text-[#07074D]">
            Description
        </label>
        @error('description')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
        <textarea name="description" placeholder="Description"
               class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
        </textarea>
    </div>
    </div>



    <div class="my-10">
        <button type="submit" name="submit"
                class="hover:shadow-form rounded-md bg-gray-100 py-3 px-8 text-center text-base font-semibold w-full border-2 outline-none">
            Submit
        </button>
    </div>

</form>

</body>

</html>
