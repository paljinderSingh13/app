<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['name', 'type', 'address', 'country', 'state', 'city', 'phone', 'sub_domain','email', 'password', 'status'];
}
