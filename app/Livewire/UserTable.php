<?php

namespace App\Livewire;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('admin.users.edit', ['user' => $row->id]);
            })
            ->setTableRowUrlTarget(function ($row) {
                return '_blank';
            });
        $this->setDefaultSort('id', 'desc');
        $this->setSingleSortingDisabled();
        $this->setPerPageAccepted([10, 25, 50, 100, -1]);
        $this->setPerPage(10);

        $this->setBulkActions([
            'deleteSelected' => 'Eliminar',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->unclickable(),
            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(fn($query, $searchTerm) => $query->orWhere('users.name', 'like', '%' . $searchTerm . '%')),
            Column::make("Apellido", "last_name")
                ->sortable()
                ->searchable(fn($query, $searchTerm) => $query->orWhere('users.last_name', 'like', '%' . $searchTerm . '%')),
            Column::make("Email", "email")
                ->sortable()
                ->collapseOnTablet()
                ->searchable(fn($query, $searchTerm) => $query->orWhere('users.email', 'like', '%' . $searchTerm . '%'))
                ->unclickable(),
            Column::make("Telefono", "phone")
                ->sortable()
                ->collapseOnTablet()
                ->unclickable(),
            Column::make("Plantel", "plantel.name")
                ->sortable()
                ->collapseOnTablet()
                ->unclickable(),
            Column::make("Nivel educativo", "educationLevel.name")
                ->sortable()
                ->collapseOnTablet()
                ->unclickable(),
            Column::make("Grado", "grade.name")
                ->sortable()
                ->collapseOnTablet()
                ->unclickable(),
            Column::make("Grupo", "group.name")
                ->sortable()
                ->collapseOnTablet()
                ->unclickable(),
            Column::make("Created at", "created_at")
                ->format(fn($value) => $value->format('d/m/Y'))
                ->collapseOnTablet()
                ->sortable()
                ->unclickable(),
            Column::make("Updated at", "updated_at")
                ->format(fn($value) => $value->format('d/m/Y'))
                ->collapseOnTablet()
                ->sortable()
                ->unclickable(),
            Column::make('Acciones')
                ->label(
                    fn($row, Column $column) => view('components.actionsdatatables.action-tables-users')->with([
                        'user' => $row,
                    ])
                )
                ->html()
                ->unclickable(), // No permite clics ni ordenación en esta columna
        ];
    }

    public function deleteSelected()
    {
        if ($this->getSelected()) {
            User::whereIn('id', $this->getSelected())->delete();
            $this->clearSelected();
        } else {
            $this->dispatch('error', 'No hay Usuarios Seleccionados');
        }
    }
}
