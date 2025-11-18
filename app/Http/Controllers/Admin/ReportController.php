<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Animal;
use App\Models\Donation;
use App\Models\Vaccine;
use App\Models\AdoptionRequest;
use App\Models\Raffle;
use App\Models\Event;

class ReportController extends Controller
{
    /**
     * Tela inicial com os filtros de relatórios
     */
    public function index()
    {
        return view('admin.reports.index');
    }

    /**
     * Gera o arquivo CSV de acordo com o tipo escolhido e o intervalo de datas
     */
  public function generate(Request $request)
{
    $request->validate([
        'type'       => 'required|string',
        'start_date' => 'nullable|date',
        'end_date'   => 'nullable|date',
    ]);

    $type  = $request->input('type');
    $start = $request->start_date ? Carbon::parse($request->start_date)->startOfDay() : null;
    $end   = $request->end_date ? Carbon::parse($request->end_date)->endOfDay() : null;

    // Escolhe o modelo de acordo com o tipo
    $query = match ($type) {
        'animals'   => Animal::query(),
        'donations' => Donation::query(),
        'vaccines'  => Vaccine::query(),
        'adoptions' => AdoptionRequest::query(),
        'raffles'   => Raffle::query(),
        'events'    => Event::query(),
        default     => null,
    };

    if (!$query) {
        return back()->with('error', 'Tipo de relatório inválido.');
    }

    // Filtro de datas (created_at)
    if ($start) {
        $query->where('created_at', '>=', $start);
    }

    if ($end) {
        $query->where('created_at', '<=', $end);
    }

    $rows = $query->get();

    $filename = 'relatorio_' . $type . '_' . date('Y-m-d_His') . '.csv';

    $csv = fopen('php://temp', 'w');

    // Excel PT-BR → ponto e vírgula
    $delimiter = ';';

    // BOM pra acentuação sair certa
    fprintf($csv, chr(0xEF) . chr(0xBB) . chr(0xBF));

    if ($rows->isEmpty()) {
        fputcsv($csv, ['Nenhum dado encontrado para os filtros informados.'], $delimiter);
    } else {
        // ---------- MAPEAMENTO DE CABEÇALHO PT-BR ----------
        $headerMap = [
            // comuns de animais
            'id'              => 'ID',
            'name'            => 'Nome',
            'species'         => 'Espécie',
            'breed'           => 'Raça',
            'age'             => 'Idade',
            'gender'          => 'Sexo',
            'size'            => 'Porte',
            'color'           => 'Cor',
            'status'          => 'Status',
            'castrated'       => 'Castrado',
            'vaccinated'      => 'Vacinado',
            'dewormed'        => 'Vermifugado',
            'special_needs'   => 'Necessidades especiais',
            'description'     => 'Descrição',
            'health_status'   => 'Saúde',
            'health_notes'    => 'Observações de saúde',
            'photo'           => 'Foto',
            'created_at'      => 'Criado em',
            'updated_at'      => 'Atualizado em',

            // alguns genéricos que podem aparecer em doações, rifas etc.
            'amount'          => 'Valor',
            'type'            => 'Tipo',
            'date'            => 'Data',
            'payment_method'  => 'Forma de pagamento',
            'donor_name'      => 'Doador',
            'donor_email'     => 'E-mail doador',
            'title'           => 'Título',
            'start_date'      => 'Data inicial',
            'end_date'        => 'Data final',
        ];

        $first = $rows->first()->toArray();
        $keys  = array_keys($first);

        // Traduz cabeçalhos; se não tiver no map, gera um nome decente
        $headersPtBr = array_map(function ($key) use ($headerMap) {
            if (isset($headerMap[$key])) {
                return $headerMap[$key];
            }

            // fallback: "special_needs_description" -> "Special needs description"
            $pretty = str_replace('_', ' ', $key);
            return ucfirst($pretty);
        }, $keys);

        // Cabeçalho em PT-BR
        fputcsv($csv, $headersPtBr, $delimiter);

        // Linhas
        foreach ($rows as $row) {
            $data = $row->toArray();

            // Ajustes simples de apresentação (opcional)
            if (isset($data['created_at']) && $data['created_at']) {
                $data['created_at'] = Carbon::parse($data['created_at'])->format('d/m/Y H:i');
            }
            if (isset($data['updated_at']) && $data['updated_at']) {
                $data['updated_at'] = Carbon::parse($data['updated_at'])->format('d/m/Y H:i');
            }

            // Mantém a ordem dos campos igual ao cabeçalho
            $ordered = [];
            foreach ($keys as $k) {
                $ordered[] = $data[$k] ?? null;
            }

            fputcsv($csv, $ordered, $delimiter);
        }
    }

    rewind($csv);

    return response()->streamDownload(function () use ($csv) {
        fpassthru($csv);
    }, $filename, [
        'Content-Type' => 'text/csv; charset=UTF-8',
    ]);
}

    // Essas 3 abaixo são opcionais (pra manter compatível com as rotas antigas)
    public function animals(Request $request)
    {
        $request->merge(['type' => 'animals']);
        return $this->generate($request);
    }

    public function donations(Request $request)
    {
        $request->merge(['type' => 'donations']);
        return $this->generate($request);
    }

    public function vaccines(Request $request)
    {
        $request->merge(['type' => 'vaccines']);
        return $this->generate($request);
    }
}
