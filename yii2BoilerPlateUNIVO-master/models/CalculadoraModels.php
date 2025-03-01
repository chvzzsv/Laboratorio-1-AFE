<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Calculadora es el modelo que maneja las operaciones matemáticas.
 */
class CalculadoraModels extends Model
{
    public $numero1;
    public $numero2;
    public $resultado;
    public $operacion;

    // Definimos las reglas de validación
    public function rules()
    {
        return [
            [['numero1', 'numero2', 'operacion'], 'required'],// Los campos son obligatorios
            [['numero1', 'numero2'], 'number'],//Los números deben ser valores numéricos
        ];
    }

    // Método para realizar la operación
    public function calcular()
    {
        if ($this->validate()) {
            switch ($this->operacion) {// Verifica el tipo de operación seleccionada
                case 'suma':
                    $this->resultado = $this->numero1 + $this->numero2;
                    break;
                case 'resta':
                    $this->resultado = $this->numero1 - $this->numero2;
                    break;
                case 'multiplicacion':
                    $this->resultado = $this->numero1 * $this->numero2;
                    break;
                case 'division':
                    if ($this->numero2 != 0) {// Verifica que no haya división entre cero
                        $this->resultado = $this->numero1 / $this->numero2;
                    } else {
                        $this->resultado = 'Error: División por cero';
                    }
                    break;
                default:
                    $this->resultado = 'Operación no válida'; // Maneja operaciones desconocidas
            }
            return true;
        }
        return false;
    }
}
