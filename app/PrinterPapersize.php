<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrinterPapersize extends Model
{
    use HasFactory;

    protected $table = 'printer_papersize';

    protected $fillable = ['printer_id', 'papersize_id'];
}
