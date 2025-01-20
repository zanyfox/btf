<?php

namespace App\Enums;

enum PaymentStatus: string {
  case Paid = 'paid';
  case NotPaid = 'not_paid';
}
