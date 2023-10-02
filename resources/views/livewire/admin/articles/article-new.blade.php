<div>
    <section class="p-6 dark:bg-gray-800 dark:text-gray-50">
        <form wire:submit.prevent="store()" wire.loading.attr='disable'
            class="container flex flex-col mx-auto space-y-12">
            <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                <div class="col-span-full">
                    <label for="title">*Título</label>
                    <input
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700
                        dark:text-gray-900" placeholder="Título" wire:model="title"
                        required maxlength="100"
                        value="{{ old('title', $title ?? '') }}">
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full" wire:ignore>
                    <textarea wire:model.defer="description" id="editor">{{ old('description', $description ?? '') }}</textarea>
                </div>
                <div class="col-span-full" >
                    <label for="title">Imagem principal (Thumbnail) </label>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @if ($thumbnail_path)
                            <div class="col-span-full">
                                <img src="{{ $thumbnail_path->temporaryUrl() }}">
                                <div class="flex justify-between space-x-1">
                                    <button wire:click="excluirTemp()" type="button"
                                        class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                        <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Excluir
                                    </button>
                                </div>
                            </div>
                        @endif
                        <div class="{{ ($thumbnail_path ? 'hidden' : 'col-span-full') }}" >

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
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Clique
                                                    ou </span> arraste e solte</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or JPEG</p>
                                        </div>
                                        <div class="col-span-1" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                                            <!-- File Input -->
                                            <input id="dropzone-file" type="file" class="hidden" wire:model="thumbnail_path" />

                                            @error('thumbnail_path')
                                                <span class="error">{{ $message }}</span>
                                            @enderror

                                            <!-- Progress Bar -->
                                            <div x-show="isUploading">
                                                <progress x-bind:value="progress" class="progress progress-primary w-56"
                                                    value="0" max="100"></progress>
                                            </div>
                                            <div wire:loading wire:target="thumbnail_path">Enviando...</div>
                                        </div>
                                        <input id="dropzone-file" type="file" class="hidden" />
                                    </label>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-full">
                    <label for="title">Categorias </label>
                    <ul class="grid w-full gap-6 md:grid-cols-3">
                        @foreach ($categories as $category)
                            <li>
                                <input wire:model="article_categories" type="checkbox" id="{{ $category->id }}"
                                    value="{{ $category->id }}" class="hidden peer" >
                                <label for="{{ $category->id }}"
                                    class="inline-flex items-center justify-between w-full p-5
                                    text-gray-500 bg-white border-2 border-gray-200
                                    rounded-lg cursor-pointer dark:hover:text-gray-300
                                    dark:border-gray-700 peer-checked:border-blue-600
                                    hover:text-gray-600 dark:peer-checked:text-gray-300
                                    peer-checked:text-blue-600 hover:bg-gray-50
                                    dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">{{ $category->title }}</div>
                                    </div>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-span-full">
                    <label for="meta_description">Descrição (150 caracteres)</label>
                    <textarea class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900" maxlength="150"
                        wire:model="meta_description" rows="5">{{ old('meta_description', $meta_description ?? '') }}</textarea>
                </div>
                <div class="col-span-full">
                    <label for="meta_tags">Palavras chave (80 caracteres)</label>
                    <textarea class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900" maxlength="80"
                        wire:model="meta_tags" rows="5">{{ old('meta_tags', $meta_tags ?? 'As palavras chaves devem ser separadas por ","') }}</textarea>
                </div>

                <div class="flex col-span-full items-center space-x-4 mt-10 justify-end">
                    <button class="btn btn-neutral">Salvar</button>
                </div>
            </div>
        </form>
    </section>
</div>
@section('scripts')

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <script>
        function MypluginUpload(editor) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                return {
                    upload() {
                        return loader.file.then(file => new Promise((resolve, reject) => {
                            let form_data = new FormData();
                            form_data.append('file',file);
                            axios.post(
                                '{{ route('upload-editor') }}', form_data, {
                                    headers: {
                                        'Content-Type': 'multipart/form-data'
                                    }
                                }).then(response => {
                                resolve({
                                    default: response.data
                                })
                            })
                        }))
                    }
                }
            };
        }
        ClassicEditor
            .create(document.querySelector('#editor'), {
                extraPlugins: [MypluginUpload],
                // toolbar: [
                //     itens:['...']
                // ],
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        }
                    ]
                }
            })
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('description',editor.getData())
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
