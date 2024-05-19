<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable =['image','task_id'];


    public function tasks()
    {
        return $this->belongsTo(Task::class);
    }

}
