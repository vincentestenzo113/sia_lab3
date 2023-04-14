<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class User extends Model{
protected $table = 'customers';
public $timestamps = false;
// column sa table
protected $fillable = [
'customer_first_name', 'customer_last_name','customer_phone_number'
];
}