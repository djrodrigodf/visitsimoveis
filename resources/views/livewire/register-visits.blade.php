<div>
    <h1>Visita Agendada</h1>
    <h4>{{$dataSchedule->schedule}}</h4>
    <h5>{{$dataSchedule->address}}</h5>
    <hr>
    <div class="mt-3">

        <div class="card">
            <div class="card-body">
                <h4>Corretor</h4>
                <p><b>Nome:</b> {{$dataSchedule->broker}}</p>
                <p><b>E-mail:</b> {{$dataSchedule->boker_mail}}</p>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h4>Comprador</h4>
                <p><b>Nome:</b> {{$dataSchedule->buyer}}</p>
                <p><b>E-mail:</b> {{$dataSchedule->buyer_mail}}</p>
            </div>
        </div>

        @if(count($dataSchedule->partners) > 0)
            <div class="card mt-3">
                <div class="card-body">
                    <h4>Acompanhantes</h4>
                    @foreach($dataSchedule->partners as $partner)
                        <p><b>Nome:</b> {{$partner->name}}</p>
                        <p><b>CPF:</b> {{$partner->cpf}}</p>
                        @if(!$loop->last)
                            <hr>
                        @endif


                    @endforeach

                </div>
            </div>
        @endif



    </div>
    <div style="margin: 0;position:absolute; top: 0; left: 0; right: 0; bottom: 0; background: #FFF; display: {{$addModal}}" class="p-4">
        <p>Nome: <input class="form-control" type="text" wire:model="partner.name"></p>
        <p>CPF: <input class="form-control" type="text" wire:model="partner.cpf"></p>
        <button class="btn btn-secondary" wire:click="add">Adicionar</button>
        <button class="btn btn-danger" wire:click="adicionar">Cancelar</button>
    </div>
    <div class="my-2">
        <button class="btn btn-lg btn-warning w-100" wire:click="adicionar">Adicionar Acompanhantes</button>
    </div>
    <div>
        <button class="btn btn-lg btn-success w-100" wire:click="start">Iniciar Visita</button>
    </div>


@push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Livewire.on('scroll', () => {
                    const targetDiv = document.querySelector(".iphone-simulator");
                    if (targetDiv) {
                        targetDiv.scrollTo({
                            top: 0,
                            behavior: "smooth"
                        });
                    }
                });
            });
        </script>
@endpush

</div>
