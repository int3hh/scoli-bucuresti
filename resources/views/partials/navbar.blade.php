<nav class="fixed w-full bg-gray-100 z-10" x-data="{ showMenu: false }">
  <div class="container p-4">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button type="button" @click="showMenu = !showMenu" class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-primary hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
         <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
           <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex flex-1 items-center justify-center sm:items-center sm:justify-start">
        
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

            <a href="/" class="ef {{ Route::is('rezultate') ? 'navbar-selected' : 'navbar-hovered' }} px-3 py-2 rounded-md text-base font-medium text-primary opacity-50">Rezultate școlare</a>

            <a href="/lista" class="ef {{ Route::is('index') ? 'navbar-selected' : 'navbar-hovered' }} px-3 py-2 rounded-md text-base font-medium text-primary opacity-50">Listă școli</a>

            <a href="/harta" class="ef {{ Route::is('harta') ? 'navbar-selected' : 'navbar-hovered' }} px-3 py-2 rounded-md text-base font-medium text-primary opacity-50" >Hartă școli</a>

           
          </div>
        </div>
      </div>
      <div class="flex flex-shrink-0 items-center">
        <a href="/">
          <img class="block h-20 w-auto" src="/logo2.png" draggable="false" alt="logo">
        </a>
      </div>
      <div class="flex flex-1 items-center justify-center sm:items-center sm:justify-start">
        
        <div class="hidden sm:mr-6 sm:ml-auto sm:block">
          <div class="flex space-x-4">

           
            <a href="/despre" class="ef {{ Route::is('despre') ? 'navbar-selected' : 'navbar-hovered' }} px-3 py-2 rounded-md text-base font-medium text-primary opacity-50">Despre proiect</a>

            <a href="/feedback" class="ef {{ Route::is('feedback') ? 'navbar-selected' : 'navbar-hovered' }} px-3 py-2 rounded-md text-base font-medium text-primary opacity-50">Feedback</a>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div x-show="showMenu"  id="mobile-menu">
    <div class="space-y-1 px-2 pt-2 pb-3">

      <a href="/" class="{{ Route::is('index') ? 'text-primary font-black opacity-100' : 'hover:text-primary hover:opacity-100' }} block px-3 py-2 rounded-md text-base font-medium">Listă școli</a>

      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
      <a href="/harta" class="{{ Route::is('harta') ? 'text-primary font-black opacity-100' : 'hover:text-primary hover:opacity-100' }} block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Hartă școli</a>
      
      

      <a href="/rezultate" class="{{ Route::is('rezultate') ? 'text-primary font-black opacity-100' : 'hover:text-primary hover:opacity-100' }} block px-3 py-2 rounded-md text-base font-medium">Rezultate școlare</a>


      <a href="/despre" class="{{ Route::is('despre') ? 'text-primary font-black opacity-100' : 'hover:text-primary hover:opacity-100' }} block px-3 py-2 rounded-md text-base font-medium">Despre proiect</a>

      <a href="/feedback" class="{{ Route::is('feedback') ? 'text-primary font-black opacity-100' : 'hover:text-primary hover:opacity-100' }} block px-3 py-2 rounded-md text-base font-medium">Feedback</a>


    </div>
  </div>

  <div class="hidden border rounded-xl border-primary hover:border-secondary text-red-600 text-green-600"></div>
</nav>