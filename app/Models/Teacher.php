<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teachers';
    protected $fillable = ['teacher_name', 'phone_number', 'subject_id'];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id'); // Assuming 'id' is the primary key of the subject
    }

    public function students()
    {
        return $this->hasMany(student::class);
    }
    
}
