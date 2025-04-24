<?php

namespace App\Enums;

enum OrderStatus: string {
  case New = 'new';
  case Error = 'error';
  case Pending = 'pending';
  case Cancelled = 'cancelled';
  case Delivered = 'delivered';
  case Shipped = 'shipped';
  case Complete = 'complete';
  case Done = 'done';

  // A utility method to get the enum values for Blade views
  public static function values(): array {
    return array_column(self::cases(), 'name', 'value');
  }

  public function color(): string {
    return match ($this) {
      self::New => 'blue',
      self::Error => 'red',
      self::Pending => 'yellow',
      self::Cancelled => 'gray',
      self::Delivered => 'green',
      self::Shipped => 'purple',
      self::Complete => 'teal',
      self::Done => 'indigo',
    };
  }

}
