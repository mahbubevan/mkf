<?php

use Carbon\Carbon;

function getYardsOfPants()
{
    return 1.15;
}

function getTrx($length = 10)
{
    $string = 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,0,1,2,3,4,5,6,7,8,9';
    $stringArr = explode(',', $string);
    $trx = '';
    for ($i = 0; $i < $length; $i++) {
        $trx .= $stringArr[array_rand($stringArr, 1)];
    }

    return $trx;
}

function getProductionCode($fabric, $qty)
{
    $code = $fabric . '-' . Carbon::now()->format('dmy') . '-' . $qty;
    return $code;
}

function uploadImage($file, $location, $size = null, $old = null, $thumb = null)
{
    $path = makeDirectory($location);
    if (!$path) throw new Exception('File could not been created.');

    if (!empty($old)) {
        removeFile($location . '/' . $old);
    }

    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $image = Image::make($file);


    if (!empty($size)) {
        $size = explode('x', strtolower($size));
        $image->resize($size[0], $size[1], function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
    }
    $image->save($location . '/' . $filename);

    if (!empty($thumb)) {

        $thumb = explode('x', $thumb);
        Image::make($file)->resize($thumb[0], $thumb[1], function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($location . '/thumb_' . $filename);
    }

    return $filename;
}

function uploadFile($file, $location, $size = null, $old = null)
{
    $path = makeDirectory($location);
    if (!$path) throw new Exception('File could not been created.');

    if (!empty($old)) {
        removeFile($location . '/' . $old);
    }

    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $file->move($location, $filename);
    return $filename;
}

function makeDirectory($path)
{
    if (file_exists($path)) return true;
    return mkdir($path, 0755, true);
}


function removeFile($path)
{
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}
