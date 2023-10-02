<p align="center"><a href="https://github.com/laiguz" target="_blank"><img src="https://avatars.githubusercontent.com/u/138938048?v=4" width="100" alt="Laravel Logo"></a></p>

# Site básico 
## Pacote Artigos
#### Dependencias: 
> Search Bar personalizado
> OU
> Configuração do AppServiceProvider 
Registrar a macro personalizada para o Query Builder

        Builder::macro('search', function ($string) {
            return $string ? $this->where(function ($query) use ($string) {
                $columns = Schema::getColumnListing($this->from);

                foreach ($columns as $column) {
                    $query->orWhere($column, 'LIKE', '%' . $string . '%');
                }
            }) : $this;
        });
### V 0.1 
    -Migrates
    -Modals
    -Controllers
    -views

### Route
    Route::get('/artigos', Article::class)
        ->name('articles');
    Route::get('/artigos/artigo-novo', ArticleNew::class)
        ->name('articles.new');
    Route::get('/artigos/{articles:slug}', ArticleUpdate::class)
        ->name('articles.update');
    Route::get('/artigos/galeria/{articles:slug}', ArticleGallery::class)
        ->name('gallery-articles');
    Route::get('/categorias-de-artigos', ArticleCategory::class)
        ->name('category-articles');

### SideBar
>  <!-- Dropdown Article -->
                        <button id="dropdownArticle" data-dropdown-toggle="dropdown"
                            class="flex items-center justify-start w-full px-4 py-2
                                font-thin uppercase transition-colors duration-200
                                {{ Request::is('*artigos*')
                                    ? ' bg-gradient-to-r from-white to-blue-100
                                                                                                                                            dark:from-gray-700 dark:to-gray-200 text-blue-500 border-r-4 border-blue-500'
                                    : 'dark:text-gray-200 hover:text-blue-500 text-gray-500' }}"
                            type="button">
                            <span class="text-left">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xml:space="preserve">
                                    <g id="article">
                                        <g>
                                            <path
                                                d="M20.5,22H4c-0.2,0-0.3,0-0.5,0C1.6,22,0,20.4,0,18.5V6h5V2h19v16.5C24,20.4,22.4,22,20.5,22z M6.7,20h13.8
                                                c0.8,0,1.5-0.7,1.5-1.5V4H7v14.5C7,19,6.9,19.5,6.7,20z M2,8v10.5C2,19.3,2.7,20,3.5,20S5,19.3,5,18.5V8H2z" />
                                        </g>
                                        <g>
                                            <rect x="15" y="6" width="5" height="6" />
                                        </g>
                                        <g>
                                            <rect x="9" y="6" width="4" height="2" />
                                        </g>
                                        <g>
                                            <rect x="9" y="10" width="4" height="2" />
                                        </g>
                                        <g>
                                            <rect x="9" y="14" width="11" height="2" />
                                        </g>
                                    </g>
                                </svg>
                            </span>
                            <span class="mx-4 text-sm font-normal">
                                Artigos
                            </span>
                            <svg class="w-2.5 h-2.5 ml-5 justify-end" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <div id="dropdown"
                            class="justify-start w-full z-10 hidden bg-white
                                divide-gray-100 rounded-es-lg shadow dark:bg-gray-700 ">
                            <ul class="text-sm ml-5 -mt-2 rounded-ee-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownArticle">
                                <li
                                    class="font-thin uppercase transition-colors duration-200
                                {{ Request::is('artigos*')
                                    ? ' bg-gradient-to-r from-white to-blue-100
                                                                                                                                            dark:from-gray-700 dark:to-gray-200 text-blue-500 border-r-4 border-blue-500'
                                    : 'dark:text-gray-200 hover:text-blue-500 text-gray-500' }}">
                                    <a href="{{ route('articles') }}" aria-label="Ir para artigos"
                                        class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600
                                        dark:hover:text-white">
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                                fill="currentColor" />
                                            <path fill="#292D32"
                                                d="M10.7397 16.2802C10.5497 16.2802 10.3597 16.2102 10.2097 16.0602C9.91969 15.7702 9.91969 15.2902 10.2097 15.0002L13.2097 12.0002L10.2097 9.00016C9.91969 8.71016 9.91969 8.23016 10.2097 7.94016C10.4997 7.65016 10.9797 7.65016 11.2697 7.94016L14.7997 11.4702C15.0897 11.7602 15.0897 12.2402 14.7997 12.5302L11.2697 16.0602C11.1197 16.2102 10.9297 16.2802 10.7397 16.2802Z" />
                                        </svg>
                                        Artigos
                                    </a>
                                </li>
                                <li
                                    class="font-thin uppercase transition-colors duration-200
                                {{ Request::is('categorias-de-artigos')
                                    ? ' bg-gradient-to-r from-white to-blue-100
                                                                                                                                            dark:from-gray-700 dark:to-gray-200 text-blue-500 border-r-4 border-blue-500'
                                    : 'dark:text-gray-200 hover:text-blue-500 text-gray-500' }}">
                                    <a href="{{ route('category-articles') }}" aria-label="Ir para artigos"
                                        class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600
                                    dark:hover:text-white">
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                                fill="currentColor" />
                                            <path fill="#292D32"
                                                d="M10.7397 16.2802C10.5497 16.2802 10.3597 16.2102 10.2097 16.0602C9.91969 15.7702 9.91969 15.2902 10.2097 15.0002L13.2097 12.0002L10.2097 9.00016C9.91969 8.71016 9.91969 8.23016 10.2097 7.94016C10.4997 7.65016 10.9797 7.65016 11.2697 7.94016L14.7997 11.4702C15.0897 11.7602 15.0897 12.2402 14.7997 12.5302L11.2697 16.0602C11.1197 16.2102 10.9297 16.2802 10.7397 16.2802Z" />
                                        </svg>
                                        Categorias
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Dropdown Article -->