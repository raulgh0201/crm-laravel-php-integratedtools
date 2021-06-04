<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [ 
    	'project_id','user_id', 'task_title', 'task' , 'priority', 'duedate'
     ] ;


     public function project() {
     	return $this->belongsTo('App\Models\Project') ;
     }

     public function user() {
         return $this->belongsTo('App\Models\User') ;
     }

     public function taskfiles() {
         return $this->hasMany('App\TaskFiles\Models') ;
     }

}
