<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Partner;
use App\Models\Schedule;
use Livewire\Component;

class Edit extends Component
{
    public Schedule $schedule;

    public array $partners = [];

    public array $listsForFields = [];

    public function mount(Schedule $schedule)
    {
        $this->schedule = $schedule;
        $this->partners = $this->schedule->partners()->pluck('id')->toArray();
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.schedule.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->schedule->save();
        $this->schedule->partners()->sync($this->partners);

        return redirect()->route('admin.schedules.index');
    }

    protected function rules(): array
    {
        return [
            'schedule.broker' => [
                'string',
                'required',
            ],
            'schedule.boker_mail' => [
                'email:rfc',
                'required',
            ],
            'schedule.buyer' => [
                'string',
                'required',
            ],
            'schedule.buyer_mail' => [
                'email:rfc',
                'required',
            ],
            'schedule.schedule' => [
                'required',
                'date_format:' . config('project.datetime_format'),
            ],
            'schedule.address' => [
                'string',
                'required',
            ],
            'schedule.buyer_signature' => [
                'string',
                'nullable',
            ],
            'schedule.broker_signature' => [
                'string',
                'nullable',
            ],
            'schedule.file' => [
                'string',
                'nullable',
            ],
            'schedule.time_stamp' => [
                'string',
                'nullable',
            ],
            'partners' => [
                'array',
            ],
            'partners.*.id' => [
                'integer',
                'exists:partners,id',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['partners'] = Partner::pluck('name', 'id')->toArray();
    }
}
