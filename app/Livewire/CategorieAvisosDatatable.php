<?php

namespace App\Livewire;

use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use App\Models\CategoryAviso; // Asegúrate de tener el modelo correcto para categorías

class CategorieAvisosDataTable extends DataTableComponent
{
    protected $model = PostCategory::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row){
                return route('admin.categories-avisos.edit', ['categories_aviso' => $row->id]);
            })            
            ->setDefaultSort('id', 'desc')
            ->setSingleSortingDisabled()
            ->setPerPageAccepted([10, 25, -1])            
            ->setBulkActions([
                'deleteSelected' => 'Eliminar',
            ]);
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),
            Column::make('Nombre', 'name')
                ->sortable()
                ->searchable(fn($query, $searchTerm) => $query->orWhere('name', 'like', '%' . $searchTerm . '%')),
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
                        ->title(fn() => 'Editar')
                        ->location(fn($row) => route('admin.categories-avisos.edit', ['categories_aviso' => $row->id]))
                        ->attributes(fn() => ['class' => 'btn-edit btn-blue'])
                ])->unclickable(),
        ];
    }

    public function builder(): Builder
    {
        return PostCategory::query()
            ->select('post_categories.*'); // Ajusta el nombre de la tabla según sea necesario
    }

    public function deleteSelected()
    {
        if ($this->getSelected()) {
            PostCategory::whereIn('id', $this->getSelected())->delete();
            $this->clearSelected();
        } else {
            $this->dispatch('error', 'No hay Registros Seleccionados');
        }
    }
}
