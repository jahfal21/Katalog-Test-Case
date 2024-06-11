<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestCase extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_domain',
        'function_apps',
        'test_case_name',
        'test_case_description',
        'test_case_type',
        'test_step',
        'expected_result',
    ];   
}
