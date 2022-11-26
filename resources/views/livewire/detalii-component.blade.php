<div class="container  mx-auto">
                        <div class="p-5 bg-white flex items-center mx-auto border-b  mb-10 border-gray-200 rounded-lg sm:flex-row flex-col">
                        <div class="sm:w-32 sm:h-32 h-20 w-20 sm:mr-10 inline-flex items-center justify-center flex-shrink-0">
                            @if ($selectedSchool->privat)
                                <i style="color: #f6c345;font-size:72px;" class="fa-solid fa-location-pin"></i>
                            @else
                                <i style="color: #00b23d;font-size:72px;" class="fa-solid fa-location-pin"></i>
                            @endif
                        </div>
                        @if ($selectedSchool)
                        <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                            <h1 class="text-black text-xl title-font font-bold mb-2">{{ $selectedSchool->name }}</h1>
                            <p class="leading-relaxed text-xs text-base">{{ $selectedSchool->address }} </p>
                            <div class="flex flex-row mt-3 mb-3 space-x-12">
                                <a href="https://www.google.com/maps?saddr=My+Location&daddr={{ $selectedSchool->lat }},{{$selectedSchool->lon}}" class='bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded' target='_blank'> <i class='fa-regular fa-map'></i> </a>
                                @if ($selectedSchool->website != null)
                                <a href="{{$selectedSchool->website}}" class='bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded' target='_blank'> <i class="fa-regular fa-globe"></i> </a>                  
                                @endif
                            </div>
                            <div class="md:flex font-bold text-gray-800">
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
                                             <a href="#" class="fas fa-star"></a>
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
                            <a href="/rezultate?table[search]={{$selectedSchool->name}}" class="mt-3 text-indigo-500 inline-flex items-center">Rezultate evaluare
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                            </a>
                            @endif
                        </div>
                        @endif
                        </div>
</div>
