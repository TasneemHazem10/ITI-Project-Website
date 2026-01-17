<?php

namespace App\Models\Instructor;

use Illuminate\Database\Eloquent\Model;

class instructor extends Model
{
    protected $table = 'instructors';   // لو مش كاتبها، Laravel بيفترضها من الاسم
    protected $primaryKey = 'national_id'; // هنا التغيير الأساسي
    public $incrementing = false;         // لو national_id مش auto increment
    protected $keyType = 'string';        // لو national_id نص (char/varchar)، خليها 'int' لو رقم
}
