<?php
?>
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>template form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/n64ewxquxuxobze709rvafjp8ulg7yb862ijwsnictzy3u0n/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- Initialize TinyMCE -->
    <script>
        tinymce.init({
            selector: '#myTextarea',
            plugins: 'advlist autolink lists link image charmap print preview anchor',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image',
            automatic_uploads: true,
            file_picker_types: 'image',
            file_picker_callback: function(callback, value, meta) {
                // Open a dialog to prompt the user to enter the image filename or URL
                var imageUrl = prompt('Enter the image URL');

                // Check if imageUrl is not null and not an empty string
                if (imageUrl !== null && imageUrl.trim() !== "") {
                    // Join the entered image URL with the base prompt URL
                    var fullImageUrl = 'http://127.0.0.1:8000/storage/' + imageUrl;

                    // Call the callback function with the full image URL
                    callback(fullImageUrl, { text: imageUrl });
                }
            }
        });

    </script>

</head>
<body>
<div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
    <div class="container max-w-screen-lg mx-auto">
        <div>
            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                    <div class="text-gray-600">
                        <p class="font-medium text-lg">Template Form</p>
                    </div>
                    <!-- Template title -->
                    <div class="lg:col-span-2">

                        <form method="post" enctype="multipart/form-data"
                              action="{{route('save_newsletter_template')}}">
                            @csrf

                            <div class="grid gap-4 gap-y-2 text-sm ">
{{--                                template title--}}
                                <div class="md:col-span-3">
                                    <label for="title">Template Title</label>
                                    <input type="text" id="titre" name="titre" placeholder="Enter your Product Name"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"/>
                                </div>

                                <!-- content -->
                                <div class="md:col-span-3">
                                    <textarea id="myTextarea" name="contenu"></textarea>

                                </div>
                            </div>
                            <!-- Submit button-->
                            <div class="md:col-span-5 text-right">
                                <div class="inline-flex items-end">
                                    <button  id="save"
                                             class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <a href="{{ route('template') }}"  class="md:absolute  bottom-0 left-0 p-10 ">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 19l-7-7 7-7"></path>
            </svg>

        </a>
    </div>
</div>
</body>
</html>
