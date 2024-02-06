<?php

namespace App\Support;

use Exception;
use RuntimeException;

class ConfigEditor
{
  public mixed $config_data;
  protected string $config_name;

  /**
   * @throws Exception
   */
  public function __construct(string $config = 'site_settings')
  {
    $this->config_name = $config;
    $this->config_data = config($config) ?? throw new Exception('Config file not found');
  }

  public function __call(string $name, array $arguments)
  {
    return $this->config_data;
  }

  public function get($key = null)
  {
    return $this->config_data[$key] ?? $this->config_data;
  }

  public function set(string|array $key, $value = null): ConfigEditor
  {
    if (is_array($key)) {
      $this->config_data = array_replace_recursive($this->config_data, $key);

      return $this;
    }
    if (is_null($value)) {
      throw new RuntimeException('Value cannot be null');
    }
    $this->config_data[$key] = $value;
    return $this;
  }

  public function save($file_name = null): void
  {
    if (is_null($file_name)) {
      $file_name = $this->config_name . '.php';
    }
    $config = $this->config_data;
    $config = var_export($config, true);
    $config = "<?php\n\nreturn " . $config . ';';
    file_put_contents(config_path($file_name), $config);
  }

}
