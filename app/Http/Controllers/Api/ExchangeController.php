<?php

namespace App\Http\Controllers\Api;

//require '../vendor/autoload.php';

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Dish;
use Illuminate\Support\Facades\File;

use ZipArchive;
use ArtemsWay\CommerceML\CommerceML;


class ExchangeController extends Controller {

  public function parse() {

    $importedProducts = [];
    $directory = public_path('import');
    $allowedExtensions = ['zip', 'rar', 'tar', 'gz', '7z', 'bz2'];

    // Находим все файлы в папке
    $files = File::files($directory);

    // Фильтруем только архивные файлы
    $archiveFiles = array_filter($files, function ($file) use ($allowedExtensions) {
      $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
      return in_array($extension, $allowedExtensions);
    });

    // Получаем имена файлов
    $archiveFileNames = array_map(function ($file) {
      return $file->getFilename();
    }, $archiveFiles);

    $archiveFileNames = array_values($archiveFileNames);

    $firstArchive = count($archiveFileNames) > 0 ? $archiveFileNames[0] : null;

    if ($firstArchive) {
      // Распаковка архива
      $zip = new ZipArchive();
      if ($zip->open(public_path("import/{$firstArchive}")) === TRUE) {
        $zip->extractTo(public_path('/import'));
        $zip->close();
      }
    }

    // Загружаем товары и опредложения
    $importFile = public_path('/import/import.xml');
    $offersFile = public_path('/import/offers.xml');

    $reader = new CommerceML($importFile, $offersFile);
    $data = $reader->getData();
    $products = $data['products'];
    if (!empty($products)) {
      foreach ($products as $product) {
        $importedProducts[$product->id] = $product->name;
      }
    }
    return response()->json(['products' => $importedProducts]);
  }

  public function exchange(Request $request) {

     $login = $_SERVER['PHP_AUTH_USER']; //$request->input('login');
     $password = $_SERVER['PHP_AUTH_PW']; //$request->input('password');

	 $mode = $request->input('mode');
	 $type = $request->input('type');
	 $isAuth = $login === 'admin' && $password === 'ZG3l43CrkpOwCnWRp';

	 if(!$isAuth) {
	 	echo 'fail'; die;
	 }

	 // Выгрузка на сайт
	 if ($type == 'catalog') {

	   switch($mode) {
		   // http://test.ce85862.tmweb.ru/api/1c_exchange.php?type=catalog&mode=checkauth
		 case 'checkauth':
 		    echo 'success';
		 	break;
			// http://test.ce85862.tmweb.ru/api/1c_exchange.php?type=catalog&mode=init
		 case 'init':
		 	echo "zip=yes\nfile_limit=0"; //104857600
		 	break;
			// http://test.ce85862.tmweb.ru/api/1c_exchange.php?type=catalog&mode=file&filename=catalog.zip
		 case 'file':

		 $filename = $request->input('filename');

		 $uploadDir = 'uploads/';

         if (!is_dir($uploadDir)) {
           mkdir($uploadDir, 0777, true);
         }

		 // Обработка бинарных данных
		 $data = file_get_contents('php://input');
		 if($data) {
			 $filePath = $uploadDir . $filename; // Или любое имя, которое вам нужно
			 file_put_contents($filePath, $data);
		 }



         if (isset($_FILES['file'])) {
        	 echo "Ошибка при загрузке файла.";
		   $uploadFile = $uploadDir . basename($_FILES['file']['name']);

		   if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
		           echo "Файл был успешно загружен.";
		       } else {
		           echo "Ошибка при загрузке файла.";
		       }

			   /*echo '<pre>';
			   print_r($_FILES);
			   echo '</pre>';*/

           /*$files = $_FILES['file'];

           $filesCount = count($files['name']);

           for ($i = 0; $i < $filesCount; $i++) {
             if ($files['error'][$i] === UPLOAD_ERR_OK) {

               // Оригинальное имя файла
               $originalName = basename($files['name'][$i]);
               // Генерация уникального имени файла для избежания конфликтов
               $fileName = $originalName;
               // Полный путь к файлу
               $uploadFile = $uploadDir . $fileName;

               // Перемещаем загруженный файл в указанную директорию
               if (move_uploaded_file($files['tmp_name'][$i], $uploadFile)) {
                   echo "Файл успешно загружен: " . $fileName . "<br>";
               } else {
                   echo "Ошибка при сохранении файла: " . $originalName . "<br>";
               }
             } else {
               echo "Ошибка загрузки файла: " . $files['name'][$i] . "<br>";
             }
           };*/
	      }
		  echo 'success';
		  break;
	   }
	}

	// Обмен информацией о заказах
	if($type == 'sale') {
		switch($mode) {
		   // http://test.ce85862.tmweb.ru/api/1c_exchange.php?type=sale&mode=checkauth
		 case 'checkauth':
 		    echo 'success';
		 	break;
			// http://test.ce85862.tmweb.ru/api/1c_exchange.php?type=sale&mode=init
		 case 'init':
		 	echo "zip=yes\nfile_limit=0"; //104857600
		 	break;
		 	// http://test.ce85862.tmweb.ru/api/1c_exchange.php?type=sale&mode=query
		 case 'query':

		 	/*$url = 'https://1c.example.com/orders/import';
$xmlData = file_get_contents('order12345.xml');

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/xml'
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);

$response = curl_exec($ch);
curl_close($ch);

if ($response === false) {
    die('Ошибка при отправке файла в 1С');
} else {
    echo 'Файл успешно отправлен в 1С';
}*/

		 	break;
		 	// http://test.ce85862.tmweb.ru/api/1c_exchange.php?type=sale&mode=success
		 case 'success':
		 	echo "zip=yes\nfile_limit=0"; //104857600
		 	break;
		}
	}

	exit();

    /*$login = $request->input('login');
    $password = $request->input('password');

    //http://localhost/api/import/store?login=admin&password=ZG3l43CrkpOwCnWRp

    if ($login === 'admin' && $password === 'ZG3l43CrkpOwCnWRp') {

      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['files'])) {

        $uploadDir = 'import/';
        if (!is_dir($uploadDir)) {
          mkdir($uploadDir, 0777, true);
        }

        $files = $_FILES['files'];

        $filesCount = count($files['name']);

        for ($i = 0; $i < $filesCount; $i++) {
          if ($files['error'][$i] === UPLOAD_ERR_OK) {

            // Оригинальное имя файла
            $originalName = basename($files['name'][$i]);
            // Генерация уникального имени файла для избежания конфликтов
            $fileName = $originalName;
            // Полный путь к файлу
            $uploadFile = $uploadDir . $fileName;

            // Перемещаем загруженный файл в указанную директорию
            if (move_uploaded_file($files['tmp_name'][$i], $uploadFile)) {
                //echo "Файл успешно загружен: " . $fileName . "<br>";
            } else {
                //echo "Ошибка при сохранении файла: " . $originalName . "<br>";
            }
          } else {
            //echo "Ошибка загрузки файла: " . $files['name'][$i] . "<br>";
          }
        }
        //$this->parse();
        echo "success";

      } else {
        echo "fail";
      }

    } else {
      echo "fail";
    }*/
  }

}
