<?php

namespace App\Support;

use App\Models\Post;
use RuntimeException;

class AutoMod
{
  public static function check_for_words(string $text, array $words): bool|array
  {
    $text = strtolower($text);
    $matches = [];
    $matchFound = preg_match_all('/\b('.implode('|' , $words).')\b/i', $text, $matches);
    if ($matchFound) {
      return $matches[0];
    }
    return false;
  }

  public static function check_duplicates(array $attributes): null|array
  {
    $required_attributes = ['user_id', 'content'];
    if (count(array_intersect($required_attributes, array_keys($attributes))) !== count($required_attributes)) {
      throw new RuntimeException('Missing required attributes');
    }
    $posts = Post::where('user_id', $attributes['user_id'])->where('content', 'like', '%' .  $attributes['content'] . '%')->get();
    $attributes['content'] = RemoveHtmlFromText::removeHtmlFromText(trim(Helpers::trim_extra_spaces($attributes['content'])));
    foreach ($posts as $post) {
      $post_content = RemoveHtmlFromText::removeHtmlFromText(trim(Helpers::trim_extra_spaces($post->content)));
      $levenshtein = (1 - levenshtein($post_content, $attributes['content'])/max(strlen($post_content), strlen($attributes['content'])))*100;
      if ( $levenshtein > 70) {
        return ['post' => $post, 'similarity' => round($levenshtein, 2)];
      }
    }
    return null;
  }
}
