<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUsMessage extends Model
{
    protected $table = "contact_us_message";
    protected $fillable = ['name','email','subject','message'] ;

}
