<?php

class Validate
{

    /**
     * Devuelve los cambos requeridos que no fueron completados.
     * Si es vacio, es que no hay errores
     */
    static function required(array $values, array $required): array
    {
        $errors = [];
        foreach ($required as $name) {
            if (!isset($values[$name]) || $values[$name] === '') {
                array_push($errors, 'El campo ' . $name . ' es obligatorio');
            }
        }
        return $errors;
    }
}
