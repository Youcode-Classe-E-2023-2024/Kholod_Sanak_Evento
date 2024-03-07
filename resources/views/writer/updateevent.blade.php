<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un evenement</title>
    <!-- Add your CSS stylesheets or include a stylesheet framework (e.g., Tailwind CSS) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

<form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="max-w-screen-md mx-auto mt-8 p-6 bg-gray-100 rounded-md shadow-md">
    @csrf

    <!-- Title -->
    <div class="-mx-3 flex flex-wrap">
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="title" class="mb-3 block text-base font-medium text-[#07074D]">Titre</label>
                <input type="text" name="title" placeholder="Titre" value="{{ old('title', $event->titre) }}" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                @error('title')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Category -->
        <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
                <label for="category" class="mb-3 block text-base font-medium ">Category</label>
                <div class="rounded-md border border-[#e0e0e0] p-1 py-1 bg-white outline-none flex">
                    <select class="rounded w-full pb-2 py-2 px-4 placeholder-gray-500 outline-none" name="category" id="">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category', $event->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Price, Place, Lieu, Image, Deadline, Reservation Type -->
    <div class="-mx-3 flex flex-wrap">
        <!-- Price -->
        <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
                <label for="price" class="mb-3 block text-base font-medium text-[#07074D]">Prix</label>
                <input type="number" name="price" placeholder="Prix" value="{{ old('price', $event->prix) }}" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                @error('price')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Lieu -->
        <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
                <label for="lieu" class="mb-3 block text-base font-medium ">Lieu</label>
                <div class="rounded-md border border-[#e0e0e0] p-1 py-1 bg-white outline-none flex">
                    <select class="rounded w-full pb-2 py-2 px-4 placeholder-gray-500 outline-none" name="lieu" id="">
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ old('lieu', $event->ville_id) == $city->id ? 'selected' : '' }}>{{ $city->ville }}</option>
                        @endforeach
                    </select>
                </div>
                @error('lieu')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Place -->
        <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
                <label for="place" class="mb-3 block text-base font-medium ">Nombre de place</label>
                <input type="number" name="place" placeholder="Nombre de place" value="{{ old('place', $event->nombre_place) }}" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                @error('place')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Image -->
        <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
                <label for="image" class="mb-3 block text-base font-medium ">Image</label>
                <input type="file" name="image" placeholder="Image" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                @error('image')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Deadline -->
        <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
                <label for="deadline" class="mb-3 block text-base font-medium ">Date de l'événement</label>
                <input type="date" name="deadline" placeholder="Deadline" value="{{ old('deadline', $event->deadline) }}" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                @error('deadline')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Reservation Type -->
        <div class="w-full px-3 sm:w-1/3">
            <div class="mb-5">
                <label for="reservation_type" class="mb-3 block text-base font-medium ">Reservation Type</label>
                <select name="reservation_type" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                    <option value="automatic" {{ old('reservation_type', $event->status == 1 ? 'automatic' : 'manual') == 'automatic' ? 'selected' : '' }}>Automatic</option>
                    <option value="manual" {{ old('reservation_type', $event->status == 1 ? 'automatic' : 'manual') == 'manual' ? 'selected' : '' }}>Manual</option>
                </select>
                @error('reservation_type')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Description -->
        <div class="w-full">
            <label for="description" class="mb-3 block text-base font-medium text-[#07074D]">Description</label>
            <textarea name="description" placeholder="Description" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">{{ old('description', $event->description) }}</textarea>
            @error('description')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Submit button -->
    <div class="my-10">
        <button type="submit" name="submit" class="hover:shadow-form rounded-md bg-gray-100 py-3 px-8 text-center text-base font-semibold w-full border-2 outline-none">
            Submit
        </button>
    </div>

</form>

</body>

</html>
