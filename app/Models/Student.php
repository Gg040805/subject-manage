<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    protected $table = 'students'; // This should point to the students table

    protected $fillable = ['student_name', 'phone_number', 'subject_id', 'teacher_id'];


    // Relationship with Teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id','id');
    }

    // Relationship with Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id','id');
    }
    public function teachers()
{
    return $this->hasMany(Teacher::class);
}

}
