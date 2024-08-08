<?php

namespace App\Livewire;


use App\Models\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;


class EventosDataTable extends DataTableComponent
{
    protected $model = Event::class;


    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row){
                return route('admin.avisos.edit', ['aviso' => $row->slug]);
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
            ButtonGroupColumn::make('Action')
                ->buttons([
                    LinkColumn::make('Action')
                    ->title(fn() => 'Ver')
                    ->location(fn($row) => route('eventos.show', ['evento' => $row->slug]))
                    ->attributes(fn() => [
                        'class' => 'btn-edit btn-red'
                    ]),
                    LinkColumn::make('Action')
                    ->title(fn() => 'Editar')
                    ->location(fn($row) => route('admin.eventos.edit', ['evento' => $row->slug]))
                    ->attributes(fn() => [
                        'class' => 'btn-edit btn-blue'
                    ])
                ])     
                ->unclickable(),           

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

    // public function reorder(array $items): void
    // {
    //     Log::info('Reordering items', $items);

    //     foreach ($items as $item) {
    //         Post::find($item[$this->getPrimaryKey()])->update([
    //             'sort' => (int)$item[$this->getDefaultReorderColumn()]
    //         ]);
    //     }

    //     // Despachar un evento para notificar que el reordenamiento ha sido guardado
    //     $this->dispatch('reorderSaved');
    // }
}
