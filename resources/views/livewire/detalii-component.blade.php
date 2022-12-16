<div class="container  mx-auto ">
    <div class="bg-white flex items-center mx-auto rounded-lg sm:flex-row flex-col">
        
    @if ($selectedSchool)
        <div class="flex-grow text-left ">
            <div class="flex items-center">
                <div class="mr-2 items-center justify-center flex-shrink-0">
                    @if ($selectedSchool->privat)
                        <i style="color: #f6c345;" class="fa-solid fa-location-pin text-2xl"></i>
                    @else
                        <i style="color: #00b23d;" class="fa-solid fa-location-pin text-2xl"></i>
                    @endif
                </div>
                <h1 class="text-black text-lg lg:text-xl title-font font-bold">{{ $selectedSchool->name }}</h1>
            </div>
            
            <p class="leading-relaxed text-xs lg:text-base">{{ $selectedSchool->address }} </p>
           
            <div class="md:flex mt-4 font-bold text-gray-800 space-y-2">
                <div class="w-full md:w-1/2 flex space-x-3">
                    <div class="w-1/2">
                        <h2 class="text-gray-500">Telefon</h2>
                        <p > {{ $selectedSchool->phoneNo }} </p>
                    </div>
                    <div class="w-1/2">
                        <h2 class="text-gray-500">Sector</h2>
                        <p> {{ $selectedSchool->sector }} </p>
                    </div>
                </div>
                <div class="w-full md:w-1/2 flex space-x-3">
                    <div class="w-1/2">
                        <h2 class="text-gray-500">Nivel</h2>
                        <p> 
                            @switch ($selectedSchool->nivel)
                                @case('0')
                                    -
                                    @break
                                @case('1')
                                    Primar
                                @break
                                @case('2')
                                    Gimnazial
                                @break
                                @case('3')
                                    Primar
                            @endswitch
                        </p>
                    </div>
                    <div class="w-1/2">
                        <h2 class="text-gray-500">Rating</h2>
                        <p>
                        @if($selectedSchool->total_rating != null)
                        <div class="star-wrapper">
                                @for($i = 0; $i < (int) $selectedSchool->total_rating; $i++)
                                <a href="#" class="fas fa-star text-yellow-500"></a>
                                @endfor
                        </div>
                        @else
                            -
                        @endif
                        </p>
                    </div>
                </div>
            </div>
            @if ($selectedSchool->hasResults())
            <div class="flex justify-between mt-4">
                <a href="/rezultate?table[search]={{$selectedSchool->name}}" class="text-primary inline-flex items-center text-xs lg:text-sm">Rezultate evaluare
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                    </a>
                    <div class="flex flex-row space-x-12">
                        <a href='https://www.google.com/maps/search/?api=1&query={{$selectedSchool->name}}&query_place_id={{$selectedSchool->place_id}}' class='mr-auto ml-0' target='_blank'> 
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 fill-primary hover:fill-secondary" viewBox="0 0 32 32"><path d="M 16 3 C 15.23 3 14.457 3.293 13.875 3.875 L 13.75 4.03125 L 4.03125 13.75 L 3.875 13.875 C 2.711 15.039 2.711 16.961 3.875 18.125 L 13.875 28.125 C 15.039 29.289 16.961 29.289 18.125 28.125 L 28.125 18.125 C 29.289 16.961 29.289 15.039 28.125 13.875 L 18.125 3.875 C 17.543 3.293 16.77 3 16 3 z M 16 5 C 16.254 5 16.51975 5.08225 16.71875 5.28125 L 26.71875 15.28125 C 27.11675 15.67925 27.11675 16.31975 26.71875 16.71875 L 16.71875 26.71875 C 16.32075 27.11675 15.68025 27.11675 15.28125 26.71875 L 5.28125 16.71875 C 4.88325 16.32075 4.88325 15.68025 5.28125 15.28125 L 15.28125 5.28125 C 15.48025 5.08225 15.746 5 16 5 z M 17 11 L 17 14 L 13 14 C 11.895 14 11 14.895 11 16 L 11 19 L 13 19 L 13 16 L 17 16 L 17 19 L 21 15 L 17 11 z"/></svg>
                        </a>
                        
                    </div>
            </div>
            @endif
        </div>
    @endif
    </div>
</div>
