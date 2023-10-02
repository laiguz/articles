<div>
    <section class="p-6 dark:bg-gray-800 dark:text-gray-50">
        <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
            <div class="col-span-full">
                <label for="title">Imagem </label>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @if ($image_path)
                        <div class="col-span-full">
                            <div class="flex grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                                <div class="flex col-span-full items-center space-x-4 mb-10 justify-start">
                                    <button wire:click="excluirTemp()" type="button"
                                        class="btn btn-outline btn-error">
                                        <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Excluir
                                    </button>
                                    <button class="btn btn-neutral" wire:click="uploadGallery()">
                                        <svg class="w-5 h-5 mr-1 -ml-1" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        Enviar
                                    </button>
                                </div>
                            </div>
                            <img src="{{ $image_path->temporaryUrl() }}">

                        </div>
                    @endif
                    <div class="{{ $image_path ? 'hidden' : 'col-span-full' }}">
                        <form wire:submit="uploadGallery()" class="container flex flex-col mx-auto space-y-12">
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Clique
                                                ou </span> arraste e solte</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or JPEG</p>
                                    </div>
                                    <div class="col-span-1" x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <!-- File Input -->
                                        <input id="dropzone-file" type="file" class="hidden"
                                            wire:model="image_path" />

                                        @error('image_path')
                                            <span class="error">{{ $message }}</span>
                                        @enderror

                                        <!-- Progress Bar -->
                                        <div x-show="isUploading">
                                            <progress x-bind:value="progress"
                                                class="progress progress-primary w-56" value="0"
                                                max="100"></progress>
                                        </div>
                                        <div wire:loading wire:target="image_path">Enviando...</div>
                                    </div>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- In work, do what you enjoy. --}}
    <div class=" dark:bg-gray-800 sm:rounded-lg my-6 px-4">
        <div class="-mx-4  overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full align-middle md:px-6 lg:px-8">
                <div class=" grid gap-4 grid-cols-2 mt-5" wire:model.live="images">
                    <div class="col-span-full">
                        <label for="title">Galeria </label>
                    </div>
                    @foreach ($images as $image)
                        <div wire:key="{{ $image->id }}"
                            class="col-span-2 sm:col-span-1 p-4 shadow-md rounded-md
                            dark:bg-gray-900 dark:text-gray-100
                            bg-gray-100 text-gray-900">
                            <div class="flex justify-between pb-4 border-bottom">
                                <div class="w-full">
                                    <div class="flex justify-between font-medium duration-200 ">
                                        <div class="tooltip tooltip-top p-0" data-tip="Apagar">
                                            <button wire:click="deleteImage({{ $image->id }})"
                                                class="py-2 px-3
                                                transition-colors dark:hover:bg-red-500 hover:hover:bg-red-500
                                                duration-200 hover:text-white -ml-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                        @if ($image->highlight == 1)
                                            <div class="tooltip tooltip-top p-0" data-tip="Destaque">
                                                <button
                                                    class="py-2 px-3
                                                    transition-colors
                                                    duration-200  -ml-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                                         viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" >
                                                        <path d="M908.1 353.1l-253.9-36.9L540.7 86.1c-3.1-6.3-8.2-11.4-14.5-14.5-15.8-7.8-35-1.3-42.9 14.5L369.8 316.2l-253.9 36.9c-7 1-13.4 4.3-18.3 9.3a32.05 32.05 0 0 0 .6 45.3l183.7 179.1-43.4 252.9a31.95 31.95 0 0 0 46.4 33.7L512 754l227.1 119.4c6.2 3.3 13.4 4.4 20.3 3.2 17.4-3 29.1-19.5 26.1-36.9l-43.4-252.9 183.7-179.1c5-4.9 8.3-11.3 9.3-18.3 2.7-17.5-9.5-33.7-27-36.3z"/>
                                                      </svg>
                                                </button>
                                            </div>
                                        @else
                                            <div class="tooltip tooltip-top p-0" data-tip="Destaque">
                                                <button wire:click="highlight({{ $image->id }})"
                                                    class="py-2 px-3
                                                transition-colors dark:hover:bg-blue-500 hover:hover:bg-blue-500
                                                duration-200 hover:text-white -ml-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.2691 4.41115C11.5006 3.89177 11.6164 3.63208 11.7776 3.55211C11.9176 3.48263 12.082 3.48263 12.222 3.55211C12.3832 3.63208 12.499 3.89177 12.7305 4.41115L14.5745 8.54808C14.643 8.70162 14.6772 8.77839 14.7302 8.83718C14.777 8.8892 14.8343 8.93081 14.8982 8.95929C14.9705 8.99149 15.0541 9.00031 15.2213 9.01795L19.7256 9.49336C20.2911 9.55304 20.5738 9.58288 20.6997 9.71147C20.809 9.82316 20.8598 9.97956 20.837 10.1342C20.8108 10.3122 20.5996 10.5025 20.1772 10.8832L16.8125 13.9154C16.6877 14.0279 16.6252 14.0842 16.5857 14.1527C16.5507 14.2134 16.5288 14.2807 16.5215 14.3503C16.5132 14.429 16.5306 14.5112 16.5655 14.6757L17.5053 19.1064C17.6233 19.6627 17.6823 19.9408 17.5989 20.1002C17.5264 20.2388 17.3934 20.3354 17.2393 20.3615C17.0619 20.3915 16.8156 20.2495 16.323 19.9654L12.3995 17.7024C12.2539 17.6184 12.1811 17.5765 12.1037 17.56C12.0352 17.5455 11.9644 17.5455 11.8959 17.56C11.8185 17.5765 11.7457 17.6184 11.6001 17.7024L7.67662 19.9654C7.18404 20.2495 6.93775 20.3915 6.76034 20.3615C6.60623 20.3354 6.47319 20.2388 6.40075 20.1002C6.31736 19.9408 6.37635 19.6627 6.49434 19.1064L7.4341 14.6757C7.46898 14.5112 7.48642 14.429 7.47814 14.3503C7.47081 14.2807 7.44894 14.2134 7.41394 14.1527C7.37439 14.0842 7.31195 14.0279 7.18708 13.9154L3.82246 10.8832C3.40005 10.5025 3.18884 10.3122 3.16258 10.1342C3.13978 9.97956 3.19059 9.82316 3.29993 9.71147C3.42581 9.58288 3.70856 9.55304 4.27406 9.49336L8.77835 9.01795C8.94553 9.00031 9.02911 8.99149 9.10139 8.95929C9.16534 8.93081 9.2226 8.8892 9.26946 8.83718C9.32241 8.77839 9.35663 8.70162 9.42508 8.54808L11.2691 4.41115Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                </button>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <img class="block object-cover object-center w-full rounded-md h-72 dark:bg-gray-500"
                                        src="{{ url('storage/articles/' . $article->id . '/' . $image->image_path . '.webp') }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
