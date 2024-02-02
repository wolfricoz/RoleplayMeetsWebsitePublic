<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rules extends Model
{
  use HasFactory;

  protected $guarded = [];

  protected $table = 'rules';
  protected $primaryKey = 'id';

  public function moveOrderUp()
  {
    if ($this->position == 1) {
      return;
    }
    $this->decrement('position');
    $this->newQuery()
      ->where('position', $this->position)
      ->where('id', '!=', $this->id)
      ->increment('position');
  }

  public function moveOrderDown()
  {
    if ($this->position == Rules::count()) {
      return;
    }
    $this->increment('position');
    $this->newQuery()
      ->where('position', $this->position)
      ->where('id', '!=', $this->id)
      ->decrement('position');
  }

}

