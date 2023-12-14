<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('schedule_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Schedule" format="csv" />
                <livewire:excel-export model="Schedule" format="xlsx" />
                <livewire:excel-export model="Schedule" format="pdf" />
            @endif




        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="w-full sm:w-1/3 inline-block" />
        </div>
    </div>
    <div wire:loading.delay>
        Loading...
    </div>

    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.schedule.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.schedule.fields.broker') }}
                            @include('components.table.sort', ['field' => 'broker'])
                        </th>
                        <th>
                            {{ trans('cruds.schedule.fields.boker_mail') }}
                            @include('components.table.sort', ['field' => 'boker_mail'])
                        </th>
                        <th>
                            {{ trans('cruds.schedule.fields.buyer') }}
                            @include('components.table.sort', ['field' => 'buyer'])
                        </th>
                        <th>
                            {{ trans('cruds.schedule.fields.buyer_mail') }}
                            @include('components.table.sort', ['field' => 'buyer_mail'])
                        </th>
                        <th>
                            {{ trans('cruds.schedule.fields.schedule') }}
                            @include('components.table.sort', ['field' => 'schedule'])
                        </th>
                        <th>
                            {{ trans('cruds.schedule.fields.address') }}
                            @include('components.table.sort', ['field' => 'address'])
                        </th>
                        <th>
                            {{ trans('cruds.schedule.fields.buyer_signature') }}
                            @include('components.table.sort', ['field' => 'buyer_signature'])
                        </th>
                        <th>
                            {{ trans('cruds.schedule.fields.broker_signature') }}
                            @include('components.table.sort', ['field' => 'broker_signature'])
                        </th>
                        <th>
                            {{ trans('cruds.schedule.fields.file') }}
                            @include('components.table.sort', ['field' => 'file'])
                        </th>
                        <th>
                            {{ trans('cruds.schedule.fields.time_stamp') }}
                            @include('components.table.sort', ['field' => 'time_stamp'])
                        </th>
                        <th>
                            {{ trans('cruds.schedule.fields.partners') }}
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schedules as $schedule)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $schedule->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $schedule->id }}
                            </td>
                            <td>
                                {{ $schedule->broker }}
                            </td>
                            <td>
                                <a class="link-light-blue" href="mailto:{{ $schedule->boker_mail }}">
                                    <i class="far fa-envelope fa-fw">
                                    </i>
                                    {{ $schedule->boker_mail }}
                                </a>
                            </td>
                            <td>
                                {{ $schedule->buyer }}
                            </td>
                            <td>
                                <a class="link-light-blue" href="mailto:{{ $schedule->buyer_mail }}">
                                    <i class="far fa-envelope fa-fw">
                                    </i>
                                    {{ $schedule->buyer_mail }}
                                </a>
                            </td>
                            <td>
                                {{ $schedule->schedule }}
                            </td>
                            <td>
                                {{ $schedule->address }}
                            </td>
                            <td>
                                {{ $schedule->buyer_signature }}
                            </td>
                            <td>
                                {{ $schedule->broker_signature }}
                            </td>
                            <td>
                                {{ $schedule->file }}
                            </td>
                            <td>
                                {{ $schedule->time_stamp }}
                            </td>
                            <td>
                                @foreach($schedule->partners as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('schedule_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.schedules.show', $schedule) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('schedule_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.schedules.edit', $schedule) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('schedule_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $schedule->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">No entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="pt-3">
            @if($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $schedules->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
    if (!confirm("{{ trans('global.areYouSure') }}")) {
        return
    }
@this[e.callback](...e.argv)
})
    </script>
@endpush