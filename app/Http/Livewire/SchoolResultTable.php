<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SchoolResult;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class SchoolResultTable extends DataTableComponent
{
    protected $model = SchoolResult::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([50, 100]);
        $this->setPerPage(50);
        $this->setColumnSelectDisabled();
        $this->setDefaultSort('avg', 'desc');
        $this->setSearchStatus(true);
        $this->setSearchDebounce(1000);
    }

    public function builder() : Builder {
        return SchoolResult::query()->where('year', config('utils')['currentYear']);
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
                    $builder->where('schools.sector', $value);
                }
            }),
            SelectFilter::make('Tip')
            ->options([
                '' => 'Toate',
                '1' => 'Privat',
                '0' => 'Stat',
            ])->filter(function (Builder $builder, string $value) {
                if ($value != '') {
                    $builder->where('schools.privat', $value);
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
                    $builder->where('schools.nivel', $value);
                }
            }),
            
        ];
    }

    public function columns(): array
    {
        return [
           Column::make('Școala', 'school.name')->sortable()->searchable(),
           Column::make('Media', 'avg')->sortable()->collapseOnMobile(),
           Column::make('Var %', 'var')->sortable()->format(function ($value, $row, $column) {
             if ($value == 0.00) return '-';
             if ($value < 0) {
                $floc = $value * -1;
                return "<p class='text-red-600'><i class='fa-solid fa-arrow-down'></i> {$floc} </p>";
             } else {
                return "<p class='text-green-600'><i class='fa-solid fa-arrow-up'></i> {$value} </p>";
             }
           })->html()->collapseOnTablet(),
           Column::make('Candidați', 'students')->sortable()->collapseOnTablet(),
           Column::make('Medii peste 9', 'over_nine')->sortable()->collapseOnTablet(),
           Column::make('Medii peste 9 (%)', 'percent_over_nine')->sortable()->collapseOnTablet(),
           Column::make('Absenți', 'missing')->sortable()->collapseOnTablet(),
           Column::make('lat', 'school.lat')->hideIf(true),
           Column::make('lon', 'school.lon')->hideIf(true),
           Column::make('school_id', 'school_id')->hideIf(true),
     /*      Column::make('Detalii', 'created_at')->format(fn($value, $row, Column $column) => "<a href='https://www.google.com/maps?saddr=My+Location&daddr=@{$row->{'school.lat'}},{$row->{'school.lon'}}' class='bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded' target='_blank'> <i class='fa-regular fa-map'></i> </a>")->html()
                               ->collapseOnTablet(), */
        ];
    }
}
