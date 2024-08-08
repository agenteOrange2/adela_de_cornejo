<?php

namespace App\Livewire;

use App\Models\Pdf;
use App\Models\Plantel;
use App\Models\SchoolCycle;
use App\Models\MenuCafeteria;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class MenuCafeteriaDataTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrlTarget(fn() => '_blank')
            ->setDefaultSort('created_at', 'desc')
            ->setSingleSortingDisabled()
            ->setPerPageAccepted([10, 25, 50, 100, -1])
            ->setPerPage(10)
            ->setBulkActions([
                'deleteSelected' => 'Eliminar',
            ]);
    }

    public function columns(): array
    {
        return [
            Column::make('Mes', 'month')
                ->sortable()
                ->format(fn($value) => \Carbon\Carbon::create()->month($value)->translatedFormat('F')),
            Column::make('Plantel', 'plantel_name')
                ->sortable()
                ->searchable(),
            Column::make('Ciclo Escolar', 'school_cycle_name')
                ->sortable()
                ->searchable(),
            Column::make('Nombre del PDF', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Creado', 'created_at')
                ->sortable()
                ->format(fn($value) => $value->format('d/m/Y')),
            Column::make('Actualizado', 'updated_at')
                ->sortable()
                ->format(fn($value) => $value->format('d/m/Y')),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Plantel')
                ->options(Plantel::all()->pluck('name', 'id')->toArray())
                ->filter(fn(Builder $query, $value) => $query->where('plantel_id', $value)),

            SelectFilter::make('Mes')
                ->options([
                    '' => 'Todos',
                    '1' => 'Enero',
                    '2' => 'Febrero',
                    '3' => 'Marzo',
                    '4' => 'Abril',
                    '5' => 'Mayo',
                    '6' => 'Junio',
                    '7' => 'Julio',
                    '8' => 'Agosto',
                    '9' => 'Septiembre',
                    '10' => 'Octubre',
                    '11' => 'Noviembre',
                    '12' => 'Diciembre',
                ])
                ->filter(fn(Builder $query, $value) => $query->where('month', $value)),
        ];
    }

    public function builder(): Builder
    {
        return Pdf::query()
            ->where('pdfable_type', MenuCafeteria::class)
            ->join('menu_cafeteria_pdf', 'pdfs.id', '=', 'menu_cafeteria_pdf.pdf_id')
            ->join('plantels', 'menu_cafeteria_pdf.plantel_id', '=', 'plantels.id')
            ->join('school_cycles', 'menu_cafeteria_pdf.school_cycle_id', '=', 'school_cycles.id')
            ->select('pdfs.*', 'menu_cafeteria_pdf.month', 'plantels.name as plantel_name', 'school_cycles.name as school_cycle_name');
    }

    public function deleteSelected()
    {
        if ($this->getSelected()) {
            Pdf::whereIn('id', $this->getSelected())->delete();
            $this->clearSelected();
        } else {
            $this->dispatch('error', ['message' => 'No hay Registros Seleccionados']);
        }
    }
}
