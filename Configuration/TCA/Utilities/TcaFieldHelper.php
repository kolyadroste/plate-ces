<?php
defined('TYPO3') or die();

$plateCheck = function(string $label, bool $exclude = false, int $default = 0): array {
    return [
        "label" => $label,
        "exclude" => $exclude,
        "config" => [
            "type" => "check",
            "renderType" => "checkboxToggle",
            "default" => $default,
            "items" => [
                [
                    0 => '',
                    1 => '',
                ]
            ],
        ],
    ];
};

$plateInput = function(string $label, bool $exclude = false, string $renderType = null): array {
    $def = [
        "label" => $label,
        "exclude" => $exclude,
        "config" => [
            "type" => "input",
            'description' => '',
        ],
    ];
    if($renderType){
        $def["config"]["renderType"] = $renderType;
    }
    return $def;
};

$plateSelect = function(string $label, bool $exclude = false, array $items = [['--- Standard ---', 0]],string $renderType = null): array {
    $def =  [
        "label" => $label,
        "exclude" => $exclude,
        "config" => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'description' => '',
            'items' => $items,
            'size' => 1,
        ],
    ];
    if($renderType){
        $def["config"]["renderType"] = $renderType;
    }
    return $def;
};

