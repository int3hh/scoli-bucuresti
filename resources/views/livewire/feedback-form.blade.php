@if (!$submited)
<form class="flex justify-center" wire:submit.prevent="submit">
  <div class="w-1/2">
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 text-primary" for="grid-password">
        E-mail
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" name="mailu" wire:model="email">
      @error('email')  <span class="text-danger">{{ $message }}</span> @enderror
    </div>
  </div>
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 text-primary" for="grid-password">
        Mesaj
      </label>
      <textarea class=" no-resize appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-48 resize-none" id="message" name="mesaj" wire:model="message"></textarea>
      @error('message') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
  </div>
  <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-indigo-800 active:shadow-lg transition duration-150 ease-in-out">
  <i class="fa fa-envelope" aria-hidden="true"></i>    
  Trimite
</button>
  </div>
</form>
@else
    <div class="flex flex-col justify-center items-center mt-10">
            <i class="fa-solid fa-check text-8xl text-primary"></i>
            <p class="text-4xl mt-10"> Multumim pentru feedback </p>
    </div>
@endif