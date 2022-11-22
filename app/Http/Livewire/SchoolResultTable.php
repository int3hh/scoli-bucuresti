<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SchoolResult;
use Illuminate\Database\Eloquent\Builder;

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
    }

    public function builder() : Builder {
        return SchoolResult::query()->where('year', config('utils')['currentYear']);
    }

    public function columns(): array
    {
        return [
           Column::make('Scoala', 'school.name')->sortable()->searchable(),
           Column::make('Media', 'avg')->sortable()->collapseOnMobile(),
           Column::make('Candidati', 'students')->sortable()->collapseOnTablet(),
           Column::make('Medii peste 9', 'over_nine')->sortable()->collapseOnTablet(),
           Column::make('Medii peste 9 (%)', 'percent_over_nine')->sortable()->collapseOnTablet(),
        ];
    }
}
