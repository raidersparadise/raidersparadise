@php
    $salida = match ($tipo) {
        'money' => \App\Support\Formato::cop($v),
        'int' => is_numeric($v) ? number_format($v, 0, ',', '.') : $v,
        'pct' => is_numeric($v) ? number_format($v * 100, 1, ',', '.').'%' : $v,
        'date' => $v ? \Carbon\Carbon::parse($v)->format('d/m/Y') : '',
        default => $v,
    };
@endphp
@if ($tipo === 'estado')
<span class="badge badge-{{ \Illuminate\Support\Str::slug($v) }}">{{ $v }}</span>
@else
{{ $salida }}
@endif
