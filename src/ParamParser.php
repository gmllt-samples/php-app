<?php
namespace App;

function parse_param(string $input, string $type = 'int', $default = null)
{
    $items = explode(',', $input);
    $choices = [];

    foreach ($items as $item) {
        if (strpos($item, '-') !== false) {
            [$start, $end] = explode('-', $item);
            $startVal = convert(trim($start), $type);
            $endVal = convert(trim($end), $type);
            for ($i = $startVal; $i <= $endVal; $i++) {
                $choices[] = $i;
            }
        } else {
            $choices[] = convert(trim($item), $type);
        }
    }

    return $choices[array_rand($choices)] ?? $default;
}

function convert(string $value, string $type)
{
    $value = strtoupper($value);
    $mult = 1;

    if (preg_match('/^([0-9.]+)([KMG])$/', $value, $matches)) {
        $num = (float) $matches[1];
        $unit = $matches[2];
        $mult = match($unit) {
            'K' => 1024,
            'M' => 1024 * 1024,
            'G' => 1024 * 1024 * 1024,
            default => 1,
        };
        $value = $num * $mult;
    }

    return $type === 'float' ? (float) $value : (int) $value;
}
