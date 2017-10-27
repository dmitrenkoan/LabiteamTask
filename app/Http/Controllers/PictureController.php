<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picture;
use File;
use Illuminate\Support\Facades\Input;

// include composer autoload
require '../vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class PictureController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    static public function add(Request $request) {

        // открываем файл
        $image = Input::file('picture');

        $publicPath = 'upload/images/notes/';
        $filename  = time() . '.' . $image->getClientOriginalExtension();

        $path = public_path($publicPath . $filename);

        // Задаем значение ширины и высоты при привешении которой будет выполнятся ресайз
        $maxWidth = 100;
        $maxHeight = 100;

        // Получаем размеры текущей картинки
        list($width,$height) = getimagesize($image);

        if($width>$maxWidth || $height>$maxHeight) {
            // Получаем новые размеры картинки
            $arPictureSize = PictureController::calcResize($width,$height, $maxWidth, $maxHeight);
            // Делаем ресайз
            $img = Image::make($image->getRealPath())->resize($arPictureSize['width'],$arPictureSize['height'])->save($path);
        }
        else{
            // Сохраняем файл без ресайза
            $img = Image::make($image->getRealPath())->save($path);
        }


        $picture = Picture::create([
            'path' => $publicPath . $filename,
        ]);

        return $picture->id;
    }

    static public function remove($id) {
        // Находим соответсвующую запись //
        $picture = Picture::find($id);
        // Удаляем файл физически с сервера , а также удаляем запись//
        if(File::delete($picture->path) && $picture->delete()) {
            return true;
        }
    }

    static public function calcResize($width, $height, $maxWidth, $maxHeight) {
        // Вычисляем базовую и текущую пропорции
        $baseProportion = $maxWidth/$maxHeight;
        $curProportion = $width/$height;
        // Сравниваем пропорции картинок и исходя из этого формируем будущие размеры
        if($curProportion>$baseProportion) {
            $result = [
              'width' => $maxWidth,
              'height' => round($maxWidth/$curProportion),
            ];
        } elseif($curProportion<$baseProportion) {
            $result = [
                'width' => round($maxHeight*$curProportion),
                'height' => $maxHeight,
            ];
        } else {
            $result = [
                'width' => $maxWidth,
                'height' => $maxHeight,
            ];
        }
        return $result;

    }
}
