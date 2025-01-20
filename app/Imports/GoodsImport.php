<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use App\Models\Good;




class GoodsImport implements ToCollection, WithHeadingRow {

  public function collection(Collection $rows) {
    
    $rowsArray = $rows->toArray();
    
    foreach ($rowsArray as $key => $row) {

      $good = Good::where('external_id', $row['id'])->first();
      if(!$good) {
        $good = new Good();
        $good->external_id = $row['id'];
      }
      print_r($row); die;

      //print_r($key);die;
      
      
      
      //$good->type = $row['type'];
      //$good->available = $row['available'];
      //$good->model = $row['model'];
      $good->name = $row['name'];
      
      $good->slug = Str::slug($good->name);
      //$good->categoryId = $row['categoryId'];
      //$good->category = $row['category'];
      //$good->country_of_origin = $row['country_of_origin'];
      //$good->weight = $row['weight'];
      $good->price = isset($row['price']) ? (int)$row['price'] : 0;
      
      //$good->oldprice = $row['oldprice'];
      //$good->url = $row['url'];
      //$good->typePrefix = $row['typePrefix'];
      //$good->vendor = $row['vendor'];
      //$good->vendorCode = $row['vendorCode'];
      $good->description = isset($row['description']) ? $row['description'] : '';
      //$good->barcode = $row['barcode'];
      //$good->picture = $row['picture'];
      //$good->dimensions = $row['dimensions'];
      //$good->manufacturer_warranty = $row['manufacturer_warranty'];
      //$good->cbid = $row['cbid'];
      //$good->bid = $row['bid'];
      //$good->purchase_price = $row['purchase_price'];
      //$good->enable_auto_discounts = $row['enable_auto_discounts'];
      //$good->currencyId = $row['currencyId'];
      //$good->delivery = $row['delivery'];
      //$good->pickup = $row['pickup'];
      //$good->store = $row['store'];
      //$good->sales_notes = $row['sales_notes'];
      //$good->min_quantity = $row['min-quantity'];
      //$good->adult = $row['adult'];
      //$good->vat = $row['vat'];
      //$good->expiry = $row['expiry'];
      //$good->downloadable = $row['downloadable'];
      //$good->group_id = $row['group_id'];
      //$good->deliveryOptionCost = $row['deliveryOptionCost'];
      //$good->deliveryOptionDays = $row['deliveryOptionDays'];
      //$good->deliveryOptionOrderBefore = $row['deliveryOptionOrderBefore'];
      //$good->pickupOptionCost = $row['pickupOptionCost'];
      //$good->pickupOptionDays = $row['pickupOptionDays'];
      //$good->pickupOptionOrderBefore = $row['pickupOptionOrderBefore'];
      //$good->color = $row['Цвет'];
      //$good->power = $row['Мощность'];
      $good->save();
    }

  }
}
