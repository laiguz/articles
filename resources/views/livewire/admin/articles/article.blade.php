<div class="w-100">
    <div class="bg-white dark:bg-gray-800 pt-3 sm:rounded-lg">
        <div>
            <div
                class="flex flex-col items-center justify-between px-4
            space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                <div class="flex w-full">
                    <div
                        class="bg-gray-50 text-gray-900 text-sm
                            focus:ring-blue-500 block w-full
                            dark:bg-gray-700 dark:placeholder-gray-400
                            dark:text-white dark:focus:ring-blue-500 ">
                        <label for="simple-search" class="sr-only">
                            Pesquisar
                        </label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-blue-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" placeholder="Pesquisar" wire:model.live="search"
                                class="w-full border-blue-500 py-3 pl-10 text-sm text-gray-900
                                    rounded-2xl bg-gray-50 focus:ring-primary-500 dark:bg-gray-700
                                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500" />
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                    <div class="group flex ">
                        <button wire:click="showModalCreate()"
                            class="flex items-center justify-center w-1/2 px-5
                                py-3 text-sm tracking-wide text-white transition-colors
                                duration-200 bg-blue-500 rounded-lg sm:w-auto gap-x-2
                                hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                            <svg class="h-4 w-4 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            <span>Novo </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class=" dark:bg-gray-800 sm:rounded-lg my-6 px-4">
                <div class="-mx-4  overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full align-middle md:px-6 lg:px-8">
                        <div class=" grid gap-4 grid-cols-2 mt-5">
                            @foreach ($articles as $article)
                                <div wire:key="{{ $article->id }}"
                                    class="col-span-2 sm:col-span-1 p-4 shadow-md rounded-md
                                    dark:bg-gray-900 dark:text-gray-100
                                    bg-gray-100 text-gray-900">
                                    <div class="flex justify-between pb-4 border-bottom">
                                        <a href="{{ route('gallery-articles',[$article->slug]) }}" class="flex items-center">
                                            <button class="btn btn-neutral">
                                                Galeria
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M21.9998 12.6978C21.9983 14.1674 21.9871 15.4165 21.9036 16.4414C21.8067 17.6308 21.6081 18.6246 21.1636 19.45C20.9676 19.814 20.7267 20.1401 20.4334 20.4334C19.601 21.2657 18.5405 21.6428 17.1966 21.8235C15.8835 22 14.2007 22 12.0534 22H11.9466C9.79929 22 8.11646 22 6.80345 21.8235C5.45951 21.6428 4.39902 21.2657 3.56664 20.4334C2.82871 19.6954 2.44763 18.777 2.24498 17.6376C2.04591 16.5184 2.00949 15.1259 2.00192 13.3967C2 12.9569 2 12.4917 2 12.0009V11.9466C1.99999 9.79929 1.99998 8.11646 2.17651 6.80345C2.3572 5.45951 2.73426 4.39902 3.56664 3.56664C4.39902 2.73426 5.45951 2.3572 6.80345 2.17651C7.97111 2.01952 9.47346 2.00215 11.302 2.00024C11.6873 1.99983 12 2.31236 12 2.69767C12 3.08299 11.6872 3.3952 11.3019 3.39561C9.44749 3.39757 8.06751 3.41446 6.98937 3.55941C5.80016 3.7193 5.08321 4.02339 4.5533 4.5533C4.02339 5.08321 3.7193 5.80016 3.55941 6.98937C3.39683 8.19866 3.39535 9.7877 3.39535 12C3.39535 12.2702 3.39535 12.5314 3.39567 12.7844L4.32696 11.9696C5.17465 11.2278 6.45225 11.2704 7.24872 12.0668L11.2392 16.0573C11.8785 16.6966 12.8848 16.7837 13.6245 16.2639L13.9019 16.0689C14.9663 15.3209 16.4064 15.4076 17.3734 16.2779L20.0064 18.6476C20.2714 18.091 20.4288 17.3597 20.5128 16.3281C20.592 15.3561 20.6029 14.1755 20.6044 12.6979C20.6048 12.3126 20.917 12 21.3023 12C21.6876 12 22.0002 12.3125 21.9998 12.6978Z" fill="currentColor"/>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5 11C15.3787 11 14.318 11 13.659 10.341C13 9.68198 13 8.62132 13 6.5C13 4.37868 13 3.31802 13.659 2.65901C14.318 2 15.3787 2 17.5 2C19.6213 2 20.682 2 21.341 2.65901C22 3.31802 22 4.37868 22 6.5C22 8.62132 22 9.68198 21.341 10.341C20.682 11 19.6213 11 17.5 11ZM19.7121 4.28794C20.096 4.67187 20.096 5.29434 19.7121 5.67826L19.6542 5.7361C19.5984 5.7919 19.5205 5.81718 19.4428 5.80324C19.3939 5.79447 19.3225 5.77822 19.2372 5.74864C19.0668 5.68949 18.843 5.5778 18.6326 5.36742C18.4222 5.15704 18.3105 4.93324 18.2514 4.76276C18.2218 4.67751 18.2055 4.60607 18.1968 4.55721C18.1828 4.47953 18.2081 4.40158 18.2639 4.34578L18.3217 4.28794C18.7057 3.90402 19.3281 3.90402 19.7121 4.28794ZM17.35 8.0403C17.2057 8.18459 17.1336 8.25673 17.054 8.31878C16.9602 8.39197 16.8587 8.45472 16.7512 8.50591C16.6602 8.54932 16.5634 8.58158 16.3698 8.64611L15.349 8.98639C15.2537 9.01814 15.1487 8.99335 15.0777 8.92234C15.0067 8.85134 14.9819 8.74631 15.0136 8.65104L15.3539 7.63021C15.4184 7.43662 15.4507 7.33983 15.4941 7.24876C15.5453 7.14133 15.608 7.0398 15.6812 6.94596C15.7433 6.86642 15.8154 6.79427 15.9597 6.65L17.7585 4.85116C17.802 4.80767 17.8769 4.82757 17.8971 4.88568C17.9707 5.09801 18.109 5.37421 18.3674 5.63258C18.6258 5.89095 18.902 6.02926 19.1143 6.10292C19.1724 6.12308 19.1923 6.19799 19.1488 6.24148L17.35 8.0403Z" fill="currentColor"/>
                                                    </svg>
                                              </button>
                                        </a>
                                        <span>
                                            @livewire('admin.search-bar.actions-buttons', ['search_id' => $article->id], key($article->id))
                                        </span>
                                    </div>
                                    <div class="space-y-4">
                                        <div class="space-y-2">
                                            @if ($article->thumbnail_path)
                                            <img class="block object-cover object-center w-full rounded-md h-72 dark:bg-gray-500"
                                            src="{{ url('storage/articles/' . $article->id . '/' . $article->thumbnail_path . '.webp') }}">
                                            @else
                                            <img class="block object-cover object-center w-full rounded-md h-72 dark:bg-gray-500"
                                            src="{{ url('storage/logos/' . config('app.configs')->logo_path . '.webp') }}">
                                            @endif

                                        </div>
                                        <div class="space-y-2">
                                            <span class="block">
                                                <h3 class="text-xl font-semibold dark:text-violet-400">
                                                    {{ $article->title }}</h3>
                                            </span>
                                            {{-- <p class="leadi dark:text-gray-400">
                                                {!! $article->description !!}
                                            </p> --}}
                                            @if ($article->categories->count() > 0)
                                            <p class="leadi dark:text-gray-400">
                                                Categorias:
                                            </p>
                                            <span>
                                                @foreach ($article->categories as $category)
                                                    <div class="badge badge-info gaspan-2">
                                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24"
                                                            class="inline-block w-4 h-4 stroke-current">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg> --}}
                                                        {{ $category->title }}
                                                    </div>
                                                @endforeach
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="items-center justify-between  py-4">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>

        {{-- MODAL DELETE --}}
        <x-confirmation-modal wire:model="showJetModal">
            <x-slot name="title">
                Excluir registro
            </x-slot>

            <x-slot name="content">
                <h2 class="h2">Deseja realmente excluir o registro?</h2>
                <p>Não será possível reverter esta ação!</p>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('showJetModal')" wire:loading.attr="disabled">
                    Cancelar
                </x-secondary-button>

                <x-danger-button class="ml-2" wire:click="delete({{ $registerId }})" wire:loading.attr="disabled">
                    Apagar registro
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>

        {{-- MODAL READ --}}
        <x-dialog-modal wire:model="showModalView">
            <x-slot name="title">Detalhes</x-slot>
            <x-slot name="content">
                <dl class="max-w text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                    @if ($detail)
                        @foreach ($detail as $item => $value)
                            @if ($value)
                                @if ($item == 'Foto')
                                    <figure class="w-48">
                                        <img class="photo" src="{{ $value }}" alt="Movie" />
                                    </figure>
                                @else
                                    <div class="flex flex-col pb-1">
                                        <dt class="text-gray-500 md:text-lg dark:text-gray-400">{{ $item }}:
                                        </dt>
                                        <dd class="text-lg font-semibold">
                                            {{ $value }}
                                        </dd>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endif
                </dl>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('showModalView')" class="mx-2">
                    Fechar
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
        {{-- MODAL CREATE --}}
        <x-dialog-modal wire:model="showModalCreate">
            <x-slot name="title">Inserir novo</x-slot>
            <x-slot name="content">
                <form wire:submit="store">

                    <div class="grid gap-4 mb-1 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                        <div class="col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-900 dark:text-white">
                                Título</label>
                            <input type="text" wire:model="title" placeholder="Título" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('title')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </form>
            </x-slot>
            <x-slot name="footer">
                <button type="submit" wire:click="store"
                    class="text-white
                        bg-blue-700 hover:bg-blue-800
                        focus:ring-4 focus:outline-none focus:ring-blue-300
                        font-medium rounded-lg text-sm px-5 py-2.5
                        text-center dark:bg-blue-600 dark:hover:bg-blue-700
                        dark:focus:ring-blue-800">
                    Salvar
                </button>
                <x-secondary-button wire:click="$toggle('showModalCreate')" class="mx-2">
                    Fechar
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
        {{-- MODAL UPDATE --}}
        <x-dialog-modal wire:model="showModalEdit">
            <x-slot name="title">Editar</x-slot>
            <x-slot name="content">
                <form wire:submit="update">
                    <div class="grid gap-4 mb-1 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                        <div class="col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-900 dark:text-white">
                                Título</label>
                            <input type="text" wire:model="title" placeholder="Título" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('title')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </form>
            </x-slot>
            <x-slot name="footer">
                <button type="submit" wire:click="update"
                    class="text-white
                        bg-blue-700 hover:bg-blue-800
                        focus:ring-4 focus:outline-none focus:ring-blue-300
                        font-medium rounded-lg text-sm px-5 py-2.5
                        text-center dark:bg-blue-600 dark:hover:bg-blue-700
                        dark:focus:ring-blue-800">
                    Atualizar
                </button>
                <x-secondary-button wire:click="$toggle('showModalEdit')" class="mx-2">
                    Fechar
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    </div>
</div>
