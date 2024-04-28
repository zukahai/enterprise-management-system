<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Intervention\Image\ImageManagerStatic as Image;

class TestController extends Controller
{
    public function barCode()
    {
        // Tạo mã vạch
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode('123456789', $generator::TYPE_CODE_128);

        // Tạo hình ảnh trắng
        $image = Image::canvas(300, 50, '#FFFFFF'); // 300x150 là kích thước bạn muốn cho hình ảnh

        // Đặt mã vạch lên hình ảnh trắng
        $image->insert($barcode, 'center'); // Chèn mã vạch vào vị trí trung tâm của hình ảnh

        // Trả về hình ảnh dưới dạng response
        return $image->response('png');
    }
}