<?php

namespace App\Http\Livewire;

use App\Mail\SendDoc;
use App\Models\Partner;
use App\Models\Schedule;
use App\Services\Bry;
use Carbon\Carbon;
use ConvertApi\ConvertApi;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\TemplateProcessor;
use Ramsey\Uuid\Uuid;

class FinishVisits extends Component
{

    public $schedule;
    public $dataSchedule;
    public $AssinaturaCorretor;
    public $AssinaturaComprador;
    public $concluido = false;
    public $loading = 'none';

    public function render()
    {
        $this->dataSchedule = Schedule::with('partners')->find($this->schedule);
        return view('livewire.finish-visits');
    }

    public function finish() {
        $this->emit('scroll', true);
        $this->gerarPDF();
    }
    public function gerarPDF()
    {
        $this->loading = 'block';

        if (empty($this->AssinaturaComprador)) {
            $this->emit('error', ['error' => 'Assinatura do Comprador em falta!']);
            return;
        }

        if (empty($this->AssinaturaCorretor)) {
            $this->emit('error', ['error' => 'Assinatura do Corretor em falta!']);
            return;
        }


        $templateProcess = new TemplateProcessor('word-template/relatorio.docx');

        $AssinaturaClientebase64Image = $this->AssinaturaComprador;
        $AssinaturaOperadorbase64Image = $this->AssinaturaCorretor;


// Decodificar as imagens Base64
        $image1Data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $AssinaturaClientebase64Image));
        $image2Data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $AssinaturaOperadorbase64Image));

// Criar arquivos temporários
        $tempImage1Path = tempnam(sys_get_temp_dir(), 'assinatura_cliente_');
        $tempImage2Path = tempnam(sys_get_temp_dir(), 'assinatura_operador_');

        file_put_contents($tempImage1Path, $image1Data);
        file_put_contents($tempImage2Path, $image2Data);

// Carregar as imagens usando o Intervention Image
        $image1 = Image::make($tempImage1Path);
        $image2 = Image::make($tempImage2Path);

// Redimensionar as imagens para 300px de largura mantendo a proporção
        $image1->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $image2->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $nome1 = Carbon::now()->format('YmdHiS').'_assinatura_cliente.png';
        $nome2 = Carbon::now()->format('YmdHiS').'_assinatura_operador.png';

        $resizeImage1Path = public_path($nome1);
        $resizeImage2Path = public_path($nome2);

        $image1->save($resizeImage1Path);
        $image2->save($resizeImage2Path);

        $urlImage1 = base_path('public/'.$nome1);
        $urlImage2 = base_path('public/'.$nome2);

        $templateProcess->setImageValue('AssinaturaCliente', $urlImage1);
        $templateProcess->setImageValue('AssinaturaOperador', $urlImage2);
        $templateProcess->setValue('comprador', $this->dataSchedule->buyer);
        $templateProcess->setValue('corretor', $this->dataSchedule->broker);

        $acompanhantes = $this->dataSchedule->partners->map(function ($item) {
            return [
                'acompanhanteId' => $item['id'],
                'name' => $item['name'],
                'cpf' => $item['cpf'],
            ];
        })->toArray();


        $templateProcess->cloneRowAndSetValues('acompanhanteId', $acompanhantes);

        $name = Uuid::uuid4();
        $templateProcess->saveAs($name.'.docx');

        ConvertApi::setApiSecret('GNSNabyq1lFVHWGn');
        $result = ConvertApi::convert('pdf', [
            'File' => $name . '.docx',
        ], 'docx');
        $result->saveFiles($name . '.pdf');



        $this->dataSchedule->file = $name . '.pdf';
        $this->dataSchedule->buyer_signature = $nome1;
        $this->dataSchedule->broker_signature = $nome2;
        $this->dataSchedule->save();
        $this->start();
        $this->concluido = true;

        Mail::to('your_email@gmail.com')->send(new SendDoc($this->dataSchedule->toArray()));



    }

    public function start() {
        $bry = new Bry();
        $hashDoDocumento = hash('sha256', Carbon::now());
        $bry->signatureDoc($this->schedule, $hashDoDocumento);
    }
}
