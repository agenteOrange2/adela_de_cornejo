<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Plantel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;


class EventosDataTable extends DataTableComponent
{
    protected $model = Event::class;


    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row){
                return route('admin.eventos.edit', ['evento' => $row->slug]);
            })
            ->setTableRowUrlTarget(function($row){
                return '_blank';
            });
        $this->setDefaultSort('id', 'desc');
        $this->setSingleSortingDisabled();     
        $this->setPerPageAccepted([10, 25, 50, 100, -1]);
        $this->setPerPage(10);

        $this->setBulkActions([
            'deleteSelected' => 'Eliminar',
        ]);

        // $this->setReorderStatus(true);
        // $this->setDefaultReorderSort('id', 'desc');

    }

    public function columns(): array
    {
        return [
            Column::make('id')
                ->sortable(),
            Column::make('Título', 'title')
            ->sortable()
            ->searchable(fn($query, $searhTerm) => $query->orWhere('title', 'like', '%' . $searhTerm . '%')),
            Column::make('Contenido', 'excerpt')       
            ->collapseOnTablet()
            ->unclickable(),            
            Column::make('Autor', 'user.name')
            ->collapseOnTablet()
            ->unclickable(),
            BooleanColumn::make('Publicado', 'is_published')
            ->collapseOnTablet()
            ->unclickable(),
            Column::make('Creado', 'created_at')
                ->sortable()
                ->format(fn($value) => $value->format('d/m/Y'))
                ->collapseOnTablet()
                ->unclickable(),
            Column::make('Actualizado', 'updated_at')
                ->sortable()
                ->format(fn($value) => $value->format('d/m/Y'))
                ->collapseOnTablet(),
                Column::make('Acciones')
                ->label(
                    fn ($row, Column $column) => view('components.actionsdatatables.action-tables-eventos')->with([
                        'evento' => $row,
                    ])
                )
                ->html()
                ->unclickable(), // No permite clics ni ordenación en esta columna           

        ];
    }

    public function builder(): Builder{
        return Event::query()
        ->with('user') // Asegúrate de cargar la relación 'user'
        ->select('events.*'); 
    }

    public function deleteSelected()
    {        
        if ($this->getSelected()) {            
            Event::whereIn('id', $this->getSelected())->delete();
            $this->clearSelected();
        } else {
            $this->dispatch('error', 'No hay Registros Seleccionados');
        }
    }


    public function filters(): array
    {
        return [
            SelectFilter::make('Publicado')
            ->options([
                '' => 'Todos',
                '1' => 'Publicado',
                '0' => 'No Publicado',
            ])
            ->filter(function($query, $value){
                if($value != ''){
                    $query->where('is_published', $value);                
                }
            }),
            SelectFilter::make('Plantel')
            ->options(
                Plantel::pluck('name', 'id')->prepend('Todos', '')->toArray()
            )
            ->filter(function($query, $value){
                if($value != ''){
                    $query->whereHas('planteles', function($query) use ($value) {
                        $query->where('plantel_id', $value);
                    });
                }
            }),

            DateFilter::make('Desde')
                ->filter(function($query, $value){
                    $query->whereDate('posts.created_at', '>=', $value);
                }),

            DateFilter::make('Hasta')
                ->filter(function($query, $value){
                    $query->whereDate('posts.created_at', '<=', $value);
                })
        ];
    }
}
