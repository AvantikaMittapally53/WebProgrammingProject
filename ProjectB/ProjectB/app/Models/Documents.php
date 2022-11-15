<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Documents extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $table = "documents";
  
    // protected $fillable = [
    //     'user_id',
    //     'code',
    // ];
}