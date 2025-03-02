<?php

namespace app\models;

use yii\base\Model;

class ModelsCalculadora extends Model
{
    public $numero1;
    public $numero2;
    public $resultado;
    public $operacion;
    public $historial = [];

    public function rules()
    {
        return [
            [['numero1', 'numero2', 'operacion'], 'required'], // Campos obligatorios
            [['numero1', 'numero2'], 'number'], // Validación de tipo numérico
        ];
    }

    public function calcular()
    {
        if ($this->validate()) {
            // Array asociativo con las operaciones
            $operaciones = [
                '+' => fn($a, $b) => $a + $b,
                '-' => fn($a, $b) => $a - $b,
                '*' => fn($a, $b) => $a * $b,
                '/' => fn($a, $b) => $b != 0 ? $a / $b : 'Error: División por cero',
            ];

            // Validar si la operación está en el array
            if (isset($operaciones[$this->operacion])) {
                $this->resultado = $operaciones[$this->operacion]($this->numero1, $this->numero2);
            } else {
                $this->resultado = 'Operación no válida';
            }

            $this->guardarHistorial();
            return true;
        }

        return false;
    }

    private function guardarHistorial()
    {
        $this->historial[] = "{$this->numero1} {$this->operacion} {$this->numero2} = {$this->resultado}";
    }
}
