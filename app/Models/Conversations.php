<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversations extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */

     protected $table = 'conversations';

     /**
      * The primary key associated with the table.
      *
      * @var string
      */
 
     protected $primaryKey = 'id';
 
     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
         'user_input',
         'ai_response',
         'user_id'
     ];
 
}
