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

$sampleBodies = [
    'rol' => [
        'create' => [
            'nombre_rol' => 'Administrador',
            'descripcion' => 'Acceso total al sistema',
        ],
        'update' => [
            'nombre_rol' => 'Administrador',
            'descripcion' => 'Acceso total al sistema con permisos administrativos',
        ],
    ],
    'usuario' => [
        'create' => [
            'id_rol' => 1,
            'nombre_usuario' => 'Ana',
            'apellido_usuario' => 'García',
            'email_cliente' => 'ana.garcia@example.com',
            'password' => 'secret123',
        ],
        'update' => [
            'id_rol' => 1,
            'nombre_usuario' => 'Ana',
            'apellido_usuario' => 'García Pérez',
            'email_cliente' => 'ana.garcia@example.com',
            'password' => 'secret1234',
        ],
    ],
    'reporte' => [
        'create' => [
            'id_usuario' => 1,
            'tipo_reporte' => 'ventas',
            'fecha_generacion' => '2026-09-14',
        ],
        'update' => [
            'id_usuario' => 1,
            'tipo_reporte' => 'inventario',
            'fecha_generacion' => '2026-09-14',
        ],
    ],
    'cliente' => [
        'create' => [
            'nombre_cliente' => 'María',
            'apellido_cliente' => 'López',
            'email_cliente' => 'maria.lopez@example.com',
            'telefono_cliente' => '3001234567',
            'direccion_cliente' => 'Cra 1 #23-45',
        ],
        'update' => [
            'nombre_cliente' => 'María',
            'apellido_cliente' => 'López',
            'email_cliente' => 'maria.lopez@example.com',
            'telefono_cliente' => '3007654321',
            'direccion_cliente' => 'Cra 1 #23-45',
        ],
    ],
    'pqr' => [
        'create' => [
            'id_usuario' => 1,
            'id_cliente' => 1,
            'descripcion_pqr' => 'Solicito apoyo sobre un pedido.',
            'estado' => 'recibida',
            'fecha' => '2026-09-14',
        ],
        'update' => [
            'id_usuario' => 1,
            'id_cliente' => 1,
            'descripcion_pqr' => 'Solicito apoyo sobre un pedido pendiente.',
            'estado' => 'en proceso',
            'fecha' => '2026-09-14',
        ],
    ],
    'categoria' => [
        'create' => [
            'nombre_categoria' => 'Ropa',
            'descripcion_categoria' => 'Artículos de vestir y accesorios',
        ],
        'update' => [
            'nombre_categoria' => 'Ropa',
            'descripcion_categoria' => 'Artículos de vestir, accesorios y uniformes',
        ],
    ],
    'marca' => [
        'create' => [
            'nombre_marca' => 'Nike',
            'descripcion_marca' => 'Marca deportiva',
        ],
        'update' => [
            'nombre_marca' => 'Nike',
            'descripcion_marca' => 'Marca deportiva internacional',
        ],
    ],
    'proveedor' => [
        'create' => [
            'nombre_proveedor' => 'Distribuidora Central',
            'telefono_proveedor' => '3000000000',
            'direccion_proveedor' => 'Cra 99 #10-20',
            'email_proveedor' => 'proveedor@example.com',
        ],
        'update' => [
            'nombre_proveedor' => 'Distribuidora Central',
            'telefono_proveedor' => '3001111111',
            'direccion_proveedor' => 'Cra 99 #10-20',
            'email_proveedor' => 'proveedor@example.com',
        ],
    ],
    'producto' => [
        'create' => [
            'id_categoria' => 1,
            'id_marca' => 1,
            'id_proveedor' => 1,
            'nombre_producto' => 'Camiseta Raiders',
            'descripcion_producto' => 'Camiseta oficial del equipo.',
            'precio_producto' => 45000.00,
            'estado_producto' => 'activo',
            'imagen_producto' => 'https://example.com/camiseta.jpg',
            'comentario_producto' => 'Talla M disponible',
        ],
        'update' => [
            'id_categoria' => 1,
            'id_marca' => 1,
            'id_proveedor' => 1,
            'nombre_producto' => 'Camiseta Raiders',
            'descripcion_producto' => 'Camiseta oficial del equipo, edición 2026.',
            'precio_producto' => 47000.00,
            'estado_producto' => 'activo',
            'imagen_producto' => 'https://example.com/camiseta-edicion.jpg',
            'comentario_producto' => 'Talla M y L disponibles',
        ],
    ],
    'carrito' => [
        'create' => [
            'id_cliente' => 1,
            'fecha_agregado' => '2026-09-14',
        ],
        'update' => [
            'id_cliente' => 1,
            'fecha_agregado' => '2026-09-14',
        ],
    ],
    'detalle_carrito' => [
        'create' => [
            'id_carrito' => 1,
            'id_producto' => 1,
            'cantidad' => 2,
            'precio_unitario' => 45000.00,
            'subtotal' => 90000.00,
        ],
        'update' => [
            'id_carrito' => 1,
            'id_producto' => 1,
            'cantidad' => 3,
            'precio_unitario' => 45000.00,
            'subtotal' => 135000.00,
        ],
    ],
    'inventario' => [
        'create' => [
            'cantidad_disponible' => 10,
            'cantidad_minima' => 2,
            'id_producto' => 1,
        ],
        'update' => [
            'cantidad_disponible' => 12,
            'cantidad_minima' => 2,
            'id_producto' => 1,
        ],
    ],
    'pedido' => [
        'create' => [
            'fecha' => '2026-09-14',
            'estado' => 'programado',
            'total' => 90000.00,
            'id_cliente' => 1,
        ],
        'update' => [
            'fecha' => '2026-09-15',
            'estado' => 'en_curso',
            'total' => 100000.00,
            'id_cliente' => 1,
        ],
    ],
    'detalle_pedido' => [
        'create' => [
            'cantidad' => 2,
            'precio_unitario' => 45000.00,
            'sub_total' => 90000.00,
            'id_pedido' => 1,
            'id_producto' => 1,
        ],
        'update' => [
            'cantidad' => 3,
            'precio_unitario' => 45000.00,
            'sub_total' => 135000.00,
            'id_pedido' => 1,
            'id_producto' => 1,
        ],
    ],
    'factura' => [
        'create' => [
            'fecha_factura' => '2026-09-14',
            'total_factura' => 120000.00,
            'impuesto' => 10000.00,
            'estado_factura' => 'pagada',
            'pago' => 120000.00,
            'metodo_pago' => 'tarjeta',
            'id_pedido' => 1,
        ],
        'update' => [
            'fecha_factura' => '2026-09-14',
            'total_factura' => 125000.00,
            'impuesto' => 10000.00,
            'estado_factura' => 'pagada',
            'pago' => 125000.00,
            'metodo_pago' => 'tarjeta',
            'id_pedido' => 1,
        ],
    ],
];

$request = static function (string $name, string $method, string $path, string $description, bool $withBody = false, ?array $payload = null): array {
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
            'raw' => json_encode($payload ?? new stdClass(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
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
    $exampleCreate = $sampleBodies[$resource]['create'] ?? ['nombre' => 'ejemplo'];
    $exampleUpdate = $sampleBodies[$resource]['update'] ?? ['nombre' => 'ejemplo'];

    $collectionItems[] = [
        'name' => $label,
        'description' => "Operaciones CRUD para el recurso {$resource}.",
        'item' => [
            $request("Listar {$label}", 'GET', $resource, 'Obtiene todos los registros.'),
            $request("Crear {$label}", 'POST', $resource, 'Crea un registro. Completa el body JSON según las reglas de validación del recurso.', true, $exampleCreate),
            $request("Consultar {$label} por ID", 'GET', $resource . '/{{id}}', 'Obtiene un registro por su identificador.'),
            $request("Actualizar {$label}", 'PUT', $resource . '/{{id}}', 'Actualiza un registro. Completa el body JSON según las reglas de validación del recurso.', true, $exampleUpdate),
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