<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = [
        'user_id',
        'score',
        'answers',
    ];

    protected $casts = [
        'answers' => 'array',
    ];
}
