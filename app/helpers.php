<?php

function getDefaultFiltrationValues($name)
{
    if (array_key_exists('filter', request()->query->all())) {
        if (array_key_exists($name, request()->query->all()['filter'])) {
            $filtrationValues = [request()->query->all()['filter'][$name]];
            return explode(',', $filtrationValues[0]);
        }
    }
    return null;
}
