<?php
namespace App\Orchid\Filters;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Selection;

class ServiceRequestStatusFilter extends Filter
{
    /**
     * The parameters used to filter.
     *
     * @var array
     */
    public $parameters = ['status'];

    /**
     * @return string
     */
    public function name(): string
    {
        return 'Status';
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('status', $this->request->get('status'));
    }

    /**
     * Display filter field.
     *
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Select::make('status')
                ->title('Filter by Status')
                ->options([
                    'approved' => 'Approved',
                    'pending'  => 'Pending',
                    'rejected' => 'Rejected',
                ])
                ->empty('Select a status')
                ->value($this->request->get('status')),
        ];
    }
}
