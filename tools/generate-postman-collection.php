<?php

declare(strict_types=1);

$resources = [
    'rol',
    'usuario',
    'reporte',
    'cliente',
    'pqr',
    'categoria',
    'marca',
    'proveedor',
    'producto',
    'carrito',
    'detalle_carrito',
    'inventario',
    'pedido',
    'detalle_pedido',
    'factura',
];

$resourceLabel = static function (string $resource): string {
    return mb_convert_case(str_replace('_', ' ', $resource), MB_CASE_TITLE, 'UTF-8');
};

$request = static function (string $name, string $method, string $path, string $description, bool $withBody = false): array {
    $definition = [
        'name' => $name,
        'request' => [
            'method' => $method,
            'header' => [
                [
                    'key' => 'Accept',
                    'value' => 'application/json',
                    'type' => 'text',
                ],
            ],
            'description' => $description,
            'url' => [
                'raw' => '{{base_url}}/api/' . $path,
                'host' => ['{{base_url}}'],
                'path' => array_merge(['api'], explode('/', $path)),
            ],
        ],
        'response' => [],
    ];

    if ($withBody) {
        $definition['request']['header'][] = [
            'key' => 'Content-Type',
            'value' => 'application/json',
            'type' => 'text',
        ];
        $definition['request']['body'] = [
            'mode' => 'raw',
            'raw' => "{}",
            'options' => [
                'raw' => [
                    'language' => 'json',
                ],
            ],
        ];
    }

    $definition['event'] = [[
        'listen' => 'test',
        'script' => [
            'type' => 'text/javascript',
            'exec' => [
                "pm.test('La respuesta tiene un estado HTTP válido', function () {",
                '    pm.expect(pm.response.code).to.be.within(200, 499);',
                '});',
            ],
        ],
    ]];

    return $definition;
};

$collectionItems = [];
foreach ($resources as $resource) {
    $label = $resourceLabel($resource);
    $collectionItems[] = [
        'name' => $label,
        'description' => "Operaciones CRUD para el recurso {$resource}.",
        'item' => [
            $request("Listar {$label}", 'GET', $resource, 'Obtiene todos los registros.'),
            $request("Crear {$label}", 'POST', $resource, 'Crea un registro. Completa el body JSON según las reglas de validación del recurso.', true),
            $request("Consultar {$label} por ID", 'GET', $resource . '/{{id}}', 'Obtiene un registro por su identificador.'),
            $request("Actualizar {$label}", 'PUT', $resource . '/{{id}}', 'Actualiza un registro. Completa el body JSON según las reglas de validación del recurso.', true),
            $request("Eliminar {$label}", 'DELETE', $resource . '/{{id}}', 'Elimina un registro por su identificador.'),
        ],
    ];
}

$collection = [
    'info' => [
        '_postman_id' => 'd96a4b3d-5b82-4a4d-9a4e-7a7b7f3c0e12',
        'name' => 'Raiders Paradise API',
        'description' => 'Colección generada desde las rutas apiResource de Laravel. Base URL: http://127.0.0.1:8000',
        'schema' => 'https://schema.getpostman.com/json/collection/v2.1.0/collection.json',
    ],
    'event' => [[
        'listen' => 'prerequest',
        'script' => [
            'type' => 'text/javascript',
            'exec' => [
                "pm.request.headers.upsert({ key: 'Accept', value: 'application/json' });",
            ],
        ],
    ]],
    'variable' => [
        [
            'key' => 'base_url',
            'value' => 'http://127.0.0.1:8000',
            'type' => 'string',
        ],
        [
            'key' => 'id',
            'value' => '1',
            'type' => 'string',
        ],
    ],
    'item' => $collectionItems,
];

$outputPath = __DIR__ . '/../postman/raiders-paradise.postman_collection.json';
if (!is_dir(dirname($outputPath))) {
    mkdir(dirname($outputPath), 0777, true);
}

file_put_contents(
    $outputPath,
    json_encode($collection, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . PHP_EOL
);

echo "Colección generada en {$outputPath}" . PHP_EOL;