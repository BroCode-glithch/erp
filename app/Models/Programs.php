<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'programs';
    protected $fillable = [
        'name',
    ];

    public function department()
    {
        return $this->belongsTo(Departments::class, 'department_id');
    }

}
