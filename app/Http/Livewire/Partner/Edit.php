<?php

namespace App\Http\Livewire\Partner;

use App\Models\Partner;
use Livewire\Component;

class Edit extends Component
{
    public Partner $partner;

    public function mount(Partner $partner)
    {
        $this->partner = $partner;
    }

    public function render()
    {
        return view('livewire.partner.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->partner->save();

        return redirect()->route('admin.partners.index');
    }

    protected function rules(): array
    {
        return [
            'partner.name' => [
                'string',
                'required',
            ],
            'partner.cpf' => [
                'string',
                'required',
            ],
        ];
    }
}
