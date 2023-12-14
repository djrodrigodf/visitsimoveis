<div>
    <div wire:loading style="position:absolute; top: 0; left: 0; bottom: 0; right: 0; height: 100vh; background: #fff; z-index: 9999; overflow: hidden;">
        <img src="{{asset('loading.svg')}}" alt="">
    </div>
    @if(!$concluido)
        <div>
            <h1>Concluir Visita</h1>
            <h5>{{$dataSchedule->address}}</h5>
            <hr>
            <div class="mt-3">

                <div class="card">
                    <div class="card-body">
                        <h4>Corretor</h4>
                        <p><b>Nome:</b> {{$dataSchedule->broker}}</p>
                        <p><b>E-mail:</b> {{$dataSchedule->boker_mail}}</p>
                        <x-signature id="AssinaturaCorretor" wire:model="AssinaturaCorretor"></x-signature>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h4>Comprador</h4>
                        <p><b>Nome:</b> {{$dataSchedule->buyer}}</p>
                        <p><b>E-mail:</b> {{$dataSchedule->buyer_mail}}</p>
                        <x-signature id="AssinaturaComprador" wire:model="AssinaturaComprador"></x-signature>
                    </div>
                </div>




            </div>
            <div class="mt-3">
                <button class="btn btn-lg btn-success w-100" wire:click="gerarPDF">Concluir Visita</button>
            </div>
        </div>
    @else
        <h1>Vistoria Concluida</h1>
    @endif


    @push('scripts')

        <script>
            Livewire.on('error', r => {
                console.log(r);
                Swal.fire({
                    title: 'Atenção!',
                    text: r.error
                })
            })
        </script>

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
