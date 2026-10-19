<?php
declare(strict_types=1);

/** Biblioteca centralizada de casos. */
function obtenerCasos(): array
{
    return [
        1 => [
            'id'        => 1,
            'titulo'    => 'Superficie del cuadrado',
            'categoria' => 'Cuadriláteros',
            'enunciado' => 'Calcular la superficie del cuadrado dado el valor de uno de sus lados de 10 metros.',
            'funcion'   => 'calcularSuperficieCuadrado',
            'figura'    => 'cuadrado',
            'campos'    => [
                ['name' => 'lado', 'label' => 'Lado del cuadrado', 'unidad' => 'm', 'default' => 10],
            ],
            'ejecutar'  => function (array $v): array {
                $area = calcularSuperficieCuadrado($v['lado']);
                return [
                    'etiqueta' => 'Superficie calculada',
                    'valor'    => $area,
                    'unidad'   => 'm²',
                    'detalle'  => 'A = l² = ' . formatearNumero($v['lado']) . '² = ' . formatearNumero($area) . ' m²',
                ];
            },
        ],
        2 => [
            'id'        => 2,
            'titulo'    => 'Área del círculo',
            'categoria' => 'Circunferencia',
            'enunciado' => 'Calcular el área de un círculo cuyo radio mide 5 metros. Usar el valor de π que ofrece PHP.',
            'funcion'   => 'calcularAreaCirculo',
            'figura'    => 'circulo',
            'campos'    => [
                ['name' => 'radio', 'label' => 'Radio del círculo', 'unidad' => 'm', 'default' => 5],
            ],
            'ejecutar'  => function (array $v): array {
                $area = calcularAreaCirculo($v['radio']);
                return [
                    'etiqueta' => 'Área calculada',
                    'valor'    => $area,
                    'unidad'   => 'm²',
                    'detalle'  => 'A = π · r² = π · ' . formatearNumero($v['radio']) . '² = ' . formatearNumero($area) . ' m²',
                ];
            },
        ],
        3 => [
            'id'        => 3,
            'titulo'    => 'Hipotenusa de un triángulo rectángulo',
            'categoria' => 'Triángulos',
            'enunciado' => 'Un triángulo rectángulo tiene catetos de 3 y 4 metros. Calcular la longitud de su hipotenusa con el teorema de Pitágoras.',
            'funcion'   => 'calcularHipotenusa',
            'figura'    => 'triangulo',
            'campos'    => [
                ['name' => 'catetoA', 'label' => 'Cateto a', 'unidad' => 'm', 'default' => 3],
                ['name' => 'catetoB', 'label' => 'Cateto b', 'unidad' => 'm', 'default' => 4],
            ],
            'ejecutar'  => function (array $v): array {
                $c = calcularHipotenusa($v['catetoA'], $v['catetoB']);
                return [
                    'etiqueta' => 'Hipotenusa calculada',
                    'valor'    => $c,
                    'unidad'   => 'm',
                    'detalle'  => 'c = √(a² + b²) = √(' . formatearNumero($v['catetoA']) . '² + ' . formatearNumero($v['catetoB']) . '²) = ' . formatearNumero($c) . ' m',
                ];
            },
        ],
    ];
}

function obtenerCaso(int $id): ?array
{
    return obtenerCasos()[$id] ?? null;
}

/** @return array<string, array> Casos agrupados por categoría. */
function casosPorCategoria(): array
{
    $grupos = [];
    foreach (obtenerCasos() as $caso) {
        $grupos[$caso['categoria']][] = $caso;
    }
    return $grupos;
}

function casoAnterior(int $id): ?array
{
    return obtenerCaso($id - 1);
}

function casoSiguiente(int $id): ?array
{
    return obtenerCaso($id + 1);
}

function urlCaso(int $id): string
{
    return "caso{$id}.php";
}

function urlApp(int $id): string
{
    return "app_caso{$id}.php";
}

/** Valores por defecto de los campos de un caso. */
function valoresPorDefecto(array $caso): array
{
    $valores = [];
    foreach ($caso['campos'] as $campo) {
        $valores[$campo['name']] = (float) $campo['default'];
    }
    return $valores;
}
