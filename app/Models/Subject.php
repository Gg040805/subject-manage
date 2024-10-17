<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subjects'; 
    protected $table1= 'students';
    protected $table2= 'teachers';
    protected $fillable = ['subject_name'];
    public function teacher()
    {
        return $this->hasMany(Teacher::class, 'subject_id'); // This will reference the singular 'teacher' table
    }
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
    public function student()
    {
        return $this->hasMany(student::class, 'subject_id'); // This will reference the singular 'teacher' table
    }
    public function students()
    {
        return $this->hasMany(student::class);
    }
}
