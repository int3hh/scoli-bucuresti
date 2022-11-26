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
    }

    public function filters() : array {
        return [
            SelectFilter::make('Sector')
            ->options([
                '' => 'Toate',
                '1' => 'Sector 1',
                '2' => 'Sector 2',
                '3' => 'Sector 3',
                '4' => 'Sector 4',
                '5' => 'Sector 5',
                '6' => 'Sector 6'
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
                    $builder->where('nivel', $value);
                }
            }),
            
        ];
    }


    public function columns(): array
    {
        return [
            Column::make('Nume', 'name')->sortable()->searchable(),
            Column::make('Rating','total_rating')->sortable()->format(function($value) {
                $stars = '';
                if ($value != null) {
                    for ($i = 0; $i < (int) $value; $i++) {
                        $stars .= '<a href="#" class="fas fa-star"></a>';
                    }
                } else {
                    $stars = '-';
                }
                return $stars;
            })->html(),
            Column::make('Sector', 'sector')->sortable()->collapseOnTablet(),
            Column::make('Nivel', 'nivel')->format(function ($value, $row, $column) {
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
            Column::make('Maps / Website', 'lat')->format(function($value, $row, Column $column) {
              $result = "<a href='https://www.google.com/maps?saddr=My+Location&daddr=@{$row->{'lat'}},{$row->{'lon'}}' class='bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded' target='_blank'> <i class='fa-regular fa-map'></i> </a>";
              if ($row->website != null) {
                $result .= "<a href='{{ $row->website }}' class='bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded' target='_blank'> <i class='fa-regular fa-globe'></i> </a>";
              }
              return $result;
            })->html()
                ->collapseOnTablet(),
        ];
    }
}
