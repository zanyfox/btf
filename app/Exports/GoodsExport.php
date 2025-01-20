<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\Good;

class GoodsExport implements FromCollection, WithHeadings {
  /**
  * @return \Illuminate\Support\Collection
  */
  public function collection() {
    return Good::select('id','name','price','oldprice','quantity')->get();
  }

  public function headings(): array {
    return [
      '#','Name','Price','Old Price','Qty'
    ];
  }

}
