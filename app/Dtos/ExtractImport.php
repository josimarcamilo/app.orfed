<?php

namespace App\Dtos;

use App\Models\Extract;
use Carbon\Carbon;

class ExtractImport
{
    public $id;
    public $date;
    public $value;
    public $description;
    public $type;

    public function setDate($date, $format)
    {
        $this->date = Carbon::createFromFormat($format,$date);
    }

    public function setValue(float $value)
    {
        $this->type = Extract::ENTRY;
        $this->value = $value * 100;

        if($value < 0){
            $this->type = Extract::EXIT;
            $this->value = $this->value * -1;
        }

        $this->value = (int) $this->value;
    }
}