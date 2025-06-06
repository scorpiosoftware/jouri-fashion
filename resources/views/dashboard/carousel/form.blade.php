        <form id="uploadForm" class="pt-4" action="{{ route('carousel.update', $record->id) }}"
            enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="grid gap-6 mb-6 md:grid-cols-1">
                <div class="grid grid-cols-1 gap-4 border-2 p-4 md:grid-cols-2">
                    <div class="grid grid-cols-1 gap-4 border-2 p-4 md:grid-cols-2 md:col-start-1 md:col-end-3">
                        <div class="w-full mt-2">
                            <div class="flex justify-between items-center">
                                <label for="logo_url"
                                    class="block mb-2 text-sm font-medium text-gray-900 d:text-white">{{ session('lang') == 'en' ? 'Logo' : 'الشعار' }}</label>
                            </div>
                            <div class="mt-4">
                                <input type="file" id="logo_url" name="logo_url"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 d:bg-gray-700 d:border-gray-600 d:placeholder-gray-400 d:text-white d:focus:ring-blue-500 d:focus:border-blue-500"
                                    placeholder="choose image" />
                            </div>
                        </div>

                        <div class="w-full mt-2">
                            <div class="flex justify-between items-center">
                                <label for="multiImageInput"
                                    class="block mb-2 text-sm font-medium text-gray-900 d:text-white">{{ session('lang') == 'en' ? 'Images' : 'الصور' }}</label>
                            </div>
                            <div class="mt-4" x-data="imageUploader()" x-init="init()">
                                <input id="multiImageInput" type="file" name="photos[]" multiple
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 d:bg-gray-700 d:border-gray-600 d:placeholder-gray-400 d:text-white d:focus:ring-blue-500 d:focus:border-blue-500">
                            </div>
                            <!-- Note: Script moved to a separate file or the end of the document -->
                        </div>
                        <div class="flex justify-center items-center md:col-start-1 md:col-end-3">
                            <div aria-controls="gallery" data-collapse-toggle="gallery"
                                class="cursor-pointer transition-all w-full text-center bg-blue-300 container mx-auto delay-75 hover:scale-95">
                                {{ session('lang') == 'en' ? 'Gallery' : 'البوم الصور' }}
                            </div>
                        </div>
                        @if (!empty($record))
                            <div id="gallery" class="grid md:grid-cols-2  items-center  w-full mx-auto gap-4">
                                {{-- Main Image --}}
                                <input class="hidden" type="text" name="image" value="{{ $record->logo_url }}">
                                @if (!empty($record?->logo_url))
                                    <div class="relative">
                                        <img class=" object-cover rounded-lg transition-all delay-100 hover:scale-105"
                                            src="{{ URL::to('storage/' . $record->logo_url) }}" alt="">
                                    </div>
                                @endif
                                {{-- Other Images --}}
                                @if (!empty($record?->images))
                                    @foreach ($record->images as $image)
                                        <div class="relative">
                                            <img class=" rounded-lg transition-all delay-100 hover:scale-105"
                                                src="{{ URL::to('storage/' . $image->url) }}" alt="">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {{--  --}}
            <div class="flex justify-end items-center">
                <button type="submit" {{-- onclick="document.getElementById('uploadForm').dispatchEvent(new Event('submit', { cancelable: true }))" --}}
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center d:bg-blue-600 d:hover:bg-blue-700 d:focus:ring-blue-800">{{ session('lang') == 'en' ? 'Submit' : 'حفظ' }}</button>
            </div>
        </form>

        <!-- Script moved at the end of the body or in a separate JS file -->
        <script>
            function imageUploader() {
                return {
                    compressedFiles: [],
                    init() {
                        const input = document.getElementById('multiImageInput');
                        const form = document.getElementById('uploadForm');

                        input.addEventListener('change', async (event) => {
                            const files = Array.from(event.target.files);
                            this.compressedFiles = [];

                            for (const file of files) {
                                const compressed = await this.compressImage(file, 0.7);
                                if (compressed) {
                                    this.compressedFiles.push(compressed);
                                } else {
                                    console.warn("Skipping file due to compression error:", file.name);
                                }
                            }

                            if (this.compressedFiles.length > 0) {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Images compressed successfully',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                        });

                        // form.addEventListener('submit', (e) => {
                        //     e.preventDefault(); // Prevent native form submission
                        //     e.stopImmediatePropagation(); // Stop bubbling to avoid double trigger

                        //     // Create a new FormData object
                        //     const formData = new FormData();

                        //     // Add CSRF token
                        //     formData.append('_token', document.querySelector('input[name="_token"]').value);

                        //     // Add method PUT
                        //     formData.append('_method', 'PUT');

                        //     // Add logo file if it exists
                        //     const logoInput = document.getElementById('logo_url');
                        //     if (logoInput && logoInput.files.length > 0) {
                        //         formData.append('logo_url', logoInput.files[0]);
                        //     }

                        //     // Add the compressed files if they exist
                        //     if (this.compressedFiles.length > 0) {
                        //         this.compressedFiles.forEach(file => {
                        //             formData.append('photos[]', file, file.name);
                        //         });
                        //     }

                        //     // Add any hidden inputs (like the image value)
                        //     const hiddenInputs = form.querySelectorAll(
                        //         'input[type="hidden"], input[type="text"]:not([type="file"])');
                        //     hiddenInputs.forEach(input => {
                        //         if (input.name && input.name !== 'photos[]') {
                        //             formData.append(input.name, input.value);
                        //         }
                        //     });

                        //     // Submit via fetch()
                        //     // fetch(form.action, {
                        //     //         method: 'POST',
                        //     //         body: formData
                        //     //     })
                        //     //     .then(async (response) => {
                        //     //         const contentType = response.headers.get("content-type");
                        //     //         if (response.ok) {
                        //     //             if (contentType && contentType.includes("application/json")) {
                        //     //                 const data = await response.json();
                        //     //                 console.log("Received JSON response:", data);
                        //     //                 Swal.fire({
                        //     //                     icon: 'success',
                        //     //                     title: 'Upload Successful!',
                        //     //                     text: 'Images uploaded successfully.'
                        //     //                 });
                        //     //                 // Reload the page to show the updated gallery
                        //     //                 setTimeout(() => {
                        //     //                     window.location.reload();
                        //     //                 }, 1500);
                        //     //             } else {
                        //     //                 const text = await response.text();
                        //     //                 console.warn("Received non-JSON response:", text);
                        //     //                 Swal.fire({
                        //     //                     icon: 'info',
                        //     //                     title: 'Upload Done!',
                        //     //                     text: 'But response is not JSON.'
                        //     //                 });
                        //     //                 // Reload the page to show the updated gallery
                        //     //                 setTimeout(() => {
                        //     //                     window.location.reload();
                        //     //                 }, 1500);
                        //     //             }
                        //     //         } else {
                        //     //             const errorText = await response.text();
                        //     //             throw new Error(errorText || 'Upload failed');
                        //     //         }
                        //     //     })
                        //     //     .catch(error => {
                        //     //         console.error(error);
                        //     //         Swal.fire({
                        //     //             icon: 'error',
                        //     //             title: 'Upload Failed!',
                        //     //             text: error.message
                        //     //         });
                        //     //     });

                        //     return false; // Prevent fallback
                        // });

                    },

                    compressImage(file, quality = 0.7) {
                        return new Promise((resolve) => {
                            const reader = new FileReader();
                            reader.readAsDataURL(file);

                            reader.onload = (event) => {
                                const img = new Image();
                                img.src = event.target.result;

                                img.onload = () => {
                                    const canvas = document.createElement('canvas');
                                    canvas.width = img.width;
                                    canvas.height = img.height;

                                    const ctx = canvas.getContext('2d');
                                    ctx.drawImage(img, 0, 0);

                                    canvas.toBlob((blob) => {
                                        if (blob) {
                                            const compressed = new File([blob], file.name, {
                                                type: file.type,
                                                lastModified: Date.now()
                                            });
                                            resolve(compressed);
                                        } else {
                                            resolve(null);
                                        }
                                    }, file.type, quality);
                                };

                                img.onerror = () => {
                                    console.error("Error loading image:", file.name);
                                    resolve(null);
                                };
                            };

                            reader.onerror = () => {
                                console.error("Error reading file:", file.name);
                                resolve(null);
                            };
                        });
                    }
                }
            }
        </script>
