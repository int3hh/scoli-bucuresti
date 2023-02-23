<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Models\School;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class SchoolsTable extends DataTableComponent
{
    protected $model = School::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([50, 100]);
        $this->setPerPage(50);
        $this->setColumnSelectDisabled();
        $this->setSearchStatus(true);
        $this->setSearchDebounce(1000);
        $this->setDefaultSort('total_rating', 'desc');
      

        // $this->setPerPageVisibilityStatus(false);
    }

    public function filters() : array {
        return [
            SelectFilter::make('Zona')
            ->options([
                '' => 'Toate',
                '1' => 'Sector 1',
                '2' => 'Sector 2',
                '3' => 'Sector 3',
                '4' => 'Sector 4',
                '5' => 'Sector 5',
                '6' => 'Sector 6',
                '0' => 'Ilfov',
            ])->filter(function (Builder $builder, string $value) {
                if ($value != '') {
                    $builder->where('sector', $value);
                }
            }),
            SelectFilter::make('Tip')
            ->options([
                '' => 'Toate',
                '1' => 'Privat',
                '0' => 'Stat',
            ])->filter(function (Builder $builder, string $value) {
                if ($value != '') {
                    $builder->where('privat', $value);
                }
            }),
            SelectFilter::make('Nivel')
            ->options([
                '' => 'Toate',
                '0' => 'Primar',
                '1' => 'Gimnazial',
                '2' => 'Liceal',
            ])->filter(function (Builder $builder, string $value) {
                if ($value != '') {
                    $nivel = School::Nivele[(int) $value];
                    $builder->whereRaw("nivel & $nivel = $nivel");
                }
            }),            
        ];
    }


    public function columns(): array
    {
        return [
            Column::make('Nume', 'name')->sortable()->searchable(),
            Column::make('lon', 'lon')->hideIf(true),
            Column::make('Rating','total_rating')->sortable()->collapseOnTablet()->format(function($value) {
                $stars = '';
                if ($value != null) {
                    for ($i = 0; $i < (int) $value; $i++) {
                        $stars .= '<a href="#" class="fas fa-star text-yellow-500"></a>';
                    }
                } else {
                    $stars = '-';
                }
                return $stars;
            })->html(),
            Column::make('Sector', 'sector')->sortable()->collapseOnTablet(),
            Column::make('Nivel studii', 'nivel')->format(function ($value, $row, $column) {
                switch ($value) {
                    case 0 :
                        return '-';
                    case 1 :
                        return 'Primar';
                    case 2 :
                        return 'Gimnazial';
                    case 3 :
                        return 'Liceal';
                }
            })->collapseOnTablet(),
            Column::make('Maps', 'place_id')->format(function($value, $row, Column $column) {
              $result = "<a href='https://www.google.com/maps/search/?api=1&query={$row->name}&query_place_id={$row->place_id}' class='ml-0 mr-auto ' target='_blank'> <svg class='h-8 hover:fill-secondary fill-primary' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><path d='M 16 3 C 15.23 3 14.457 3.293 13.875 3.875 L 13.75 4.03125 L 4.03125 13.75 L 3.875 13.875 C 2.711 15.039 2.711 16.961 3.875 18.125 L 13.875 28.125 C 15.039 29.289 16.961 29.289 18.125 28.125 L 28.125 18.125 C 29.289 16.961 29.289 15.039 28.125 13.875 L 18.125 3.875 C 17.543 3.293 16.77 3 16 3 z M 16 5 C 16.254 5 16.51975 5.08225 16.71875 5.28125 L 26.71875 15.28125 C 27.11675 15.67925 27.11675 16.31975 26.71875 16.71875 L 16.71875 26.71875 C 16.32075 27.11675 15.68025 27.11675 15.28125 26.71875 L 5.28125 16.71875 C 4.88325 16.32075 4.88325 15.68025 5.28125 15.28125 L 15.28125 5.28125 C 15.48025 5.08225 15.746 5 16 5 z M 17 11 L 17 14 L 13 14 C 11.895 14 11 14.895 11 16 L 11 19 L 13 19 L 13 16 L 17 16 L 17 19 L 21 15 L 17 11 z'/></svg> </a>";
            //   if ($row->website != null) {
            //     $result .= "<a href='{{ $row->website }}' class='bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded' target='_blank'> <i class='fa-regular fa-globe'></i> </a>";
            //   }
              return $result;
            })->html()
                ->collapseOnTablet(),
        ];
    }
}
