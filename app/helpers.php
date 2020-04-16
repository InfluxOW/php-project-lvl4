<?php

function getDefaultFiltrationValues($name)
{
    if (array_key_exists('filter', request()->query->all())) {
        if (array_key_exists($name, request()->query->all()['filter'])) {
            $filtrationValues = request()->query->all()['filter'][$name];
            return explode(',', $filtrationValues);
        }
    }
    return null;
}

function flashMessageLevelToSemanticUi($level)
{
    switch ($level) {
        case 'info':
            return 'blue';
            break;
        case 'success':
            return 'green';
            break;
        case 'error':
            return 'red';
            break;
        case 'warning':
            return 'yellow';
            break;
        case 'default':
            return '';
            break;
    }
}
