<div class="bg-gray-100  mx-4 lg:mx-0">
    <div class="container bg-white py-8 lg:p-8 rounded-custom  rezultate-table">
        <p class="mb-3 px-4 lg:px-0"><b> VAR % </b> = Variația procentuală între rezultatele din anul <b>{{ config('utils')['currentYear'] }}</b> și <b> {{ config('utils')['currentYear'] -1 }} </b> </p>
            {{-- <A href="#" class="bg-blue-500  text-red text-green hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded hidden">test</a> --}}
            <livewire:school-result-table class="mt-1"/>
    </div>
</div>