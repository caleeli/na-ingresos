<?php

namespace Na\Ingresos\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

/**
 * Recibo model
 *
 * Swagger definition:
 *
 *  @OA\Schema(
 *      schema="TestEditable",
 *      @OA\Property(
 *          property="attributes",
 *          type="object",
 *          @OA\Property(property="data", type="object"),
 *          @OA\Property(property="status", type="string", enum={"ACTIVE", "COMPLETED"}),
 *      )
 *  )
 *
 *  @OA\Schema(
 *      schema="Test",
 *      allOf={
 *          @OA\Schema(
 *              @OA\Property(property="id", type="string", format="id"),
 *          ),
 *          @OA\Schema(ref="#/components/schemas/TestEditable"),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="attributes",
 *                  type="object",
 *                  @OA\Property(property="created_at", type="string", format="date-time"),
 *                  @OA\Property(property="updated_at", type="string", format="date-time"),
 *                  @OA\Property(property="id", type="string", format="id"),
 *              )
 *          )
 *      }
 *  )
 */
class Recibo extends Model
{
    protected $attributes = [
        'numero' => '',
        'tipo' => '',
        'fecha' => '',
        'ingreso' => 0,
        'egreso' => 0,
        'persona' => '',
        'detalle' => '',
        'telefono' => '',
        'usuario_id' => '',
        'ingreso_acumulado' => 0,
        'egreso_acumulado' => 0,
    ];
    protected $fillable = [
        'numero',
        'tipo',
        'fecha',
        'ingreso',
        'egreso',
        'persona',
        'detalle',
        'telefono',
        'usuario_id',
        'ingreso_acumulado',
        'egreso_acumulado',
    ];
    protected $casts = [
        'fecha' => 'date',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function siguiente()
    {
        return $this->max('numero') + 1;
    }
}
