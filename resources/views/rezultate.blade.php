<x-app-layout>
<div class="container-fluid p-4">
<p class="mb-3"><b> VAR % </b> = Variația procentuală între rezultatele din anul <b>{{ config('utils')['currentYear'] }}</b> și <b> {{ config('utils')['currentYear'] -1 }} </b> </p>
    <A href="#" class="bg-blue-500  text-red text-green hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded hidden">test</a>
    <livewire:school-result-table class="mt-1"/>
    
</div>


</x-app-layout>
