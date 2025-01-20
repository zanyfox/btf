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

}
