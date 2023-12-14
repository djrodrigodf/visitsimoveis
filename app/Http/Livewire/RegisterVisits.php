<?php

namespace App\Http\Livewire;

use App\Models\Partner;
use App\Models\Schedule;
use App\Services\Bry;
use Carbon\Carbon;
use Livewire\Component;

class RegisterVisits extends Component
{
    public $schedule;
    public $dataSchedule;
    public $addModal = 'none';
    public $partner = [];
    public function adicionar() {
        $this->emit('scroll', true);
        if ($this->addModal == 'none') {
            $this->addModal = 'block';
        } else {
            $this->addModal = 'none';
        }
    }

    public function add() {
        $partner = Partner::create($this->partner);
        $this->dataSchedule->partners()->attach($partner->id);
        $this->partner = [];
        $this->addModal = 'none';
    }

    public function start() {
        $bry = new Bry();
        $hashDoDocumento = hash('sha256', Carbon::now());
        $bry->signatureHash($this->schedule, $hashDoDocumento);
    }

    public function verificar() {
        $bry = new Bry();
        dd($bry->verify($this->schedule));
    }

    public function render()
    {
        $this->dataSchedule = Schedule::with('partners')->find($this->schedule);
        return view('livewire.register-visits');
    }
}
