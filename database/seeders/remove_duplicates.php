<?php

namespace Database\Seeders;

use App\Support\ConfigEditor;
use Illuminate\Database\Seeder;

class remove_duplicates extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $nsfw = config('site_settings.nsfw_words');
    $extreme = config('site_settings.extreme_words');
    $new_nsfw = [];
    foreach ($nsfw as $kink) {
      $result = in_array($kink, $extreme, true);
        if ($result === false) {
          echo trim($kink);
          echo "\n";
        }
      }

  }
}
