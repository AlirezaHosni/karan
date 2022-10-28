<?php

namespace App\Services\abrarvan;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class Actions
{
    public static $channelId = '34696f5d-dc28-482c-a6f5-bafc721aaad5';

    public static function getVideos()
    {
        $url = 'https://napi.arvancloud.com/vod/2.0/channels/' . self::$channelId . '/videos';

        return Http::withHeaders(['Authorization' => Config::get('app.arvan_cloud_api_key')])->get($url);
    }

    public static function createVideo($extension, $fileName, $fileSize,  $path)
    {
        $url = 'https://napi.arvancloud.com/vod/2.0/channels/34696f5d-dc28-482c-a6f5-bafc721aaad5/files';
//        $fileSize = $file->getSize();
        $fileNameBase64 = base64_decode($fileName);
        $fileTypeBase64 = base64_decode('video/' . $extension);
        $key = Str::random();

        $client = new \TusPhp\Tus\Client($url, [
            'headers' => [
                'Authorization' => Config::get('app.arvan_cloud_api_key'),
                'tus-resumable' => '1.0.0',
                'upload-length' => $fileSize,
                'upload-metadata' => "filename $fileNameBase64=,filetype $fileTypeBase64"
            ]
        ]);
        $client->setKey($key);

        $result = $client->file($path, 'karanEx.mp4')->upload();
        dd($result);
    }

    public static function getVideo(){}
    public static function updateVideo(){}
    public static function deleteVideo(){}

}
