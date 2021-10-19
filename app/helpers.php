<?php

function getFilterValues(string $filter): ?array
{
    if (array_key_exists('filter', request()->query->all()) && array_key_exists($filter, request()->query->all()['filter'])) {
        $values = request()->query->all()['filter'][$filter];

        return explode(',', $values);
    }

    return null;
}

function flashMessageLevelToSemanticUiClass(string $level): string
{
    switch ($level) {
        case 'info':
            return 'blue';
        case 'success':
            return 'green';
        case 'error':
            return 'red';
        case 'warning':
            return 'yellow';
        case 'default':
            return '';
    }
}
