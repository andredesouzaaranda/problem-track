<?php

namespace App\Models;

class Problem
{
  const DB = '/var/www/database/problems.txt';
  private $errors = [];

  public function __construct(
    private int $id = -1,
    private string $title = '',
  ) {}

  public function getId(): int
  {
    return $this->id;
  }

  public function setId(int $id): void
  {
    $this->id = $id;
  }

  public function getTitle(): string
  {
    return $this->title;
  }

  public function setTitle(string $title): void
  {
    $this->title = $title;
  }

  public function save(): bool
  {
    if ($this->isValid()) {
      if ($this->newRecord()) {
        $this->id = count(file(self::DB));
        file_put_contents(self::DB, $this->title . PHP_EOL, FILE_APPEND);
      } else {
        $problems = file(self::DB, FILE_IGNORE_NEW_LINES);
        $problems[$this->id] = $this->title;
        $data = implode(PHP_EOL, $problems);
        file_put_contents(self::DB, $data . PHP_EOL);
      }
      return true;
    }
    return false;
  }

  public function destroy(): void
  {
    $problems = file(self::DB, FILE_IGNORE_NEW_LINES);
    unset($problems[$this->id]);
    $data = implode(PHP_EOL, $problems);
    file_put_contents(self::DB, $data . PHP_EOL);
  }

  public function isValid(): bool
  {
    $this->errors = [];
    if (empty($this->title)) {
      $this->errors['title'] = 'O título é obrigatório';
    }
    return empty($this->errors);
  }

  public function newRecord(): bool
  {
    return $this->id === -1;
  }

  public function hasErrors(): bool
  {
    return empty($this->errors);
  }

  public function errors($index): string|null
  {
    if (isset($this->errors[$index])) {
      return $this->errors[$index];
    }
    return null;
  }

  public static function all(): array
  {
    $problems = file(self::DB, FILE_IGNORE_NEW_LINES);
    return array_map(function ($index, $problem) {
      return new self($index, $problem);
    }, array_keys($problems), $problems);
  }

  public static function findById(int $id): Problem|null
  {
    $problems = self::all();
    foreach ($problems as $problem) {
      if ($problem->getId() === $id) {
        return $problem;
      }
    }
    return null;
  }
}
