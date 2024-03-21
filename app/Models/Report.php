<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public static array $options = [
      "User is searching for / posting underage content",
      "User is posting personal information or another user's personal information",
      "User is posting content that is not theirs",
      "User is under the age of 18",
      "The content is not tagged as NSFW or Extreme",
      "The content is not in the correct category",
    ];
}
