<?php

namespace App\Http\Controllers;

use App\short_urls;
use Exception;
use Illuminate\Http\Request;

class ShortenerController extends Controller
{
    protected static $chars = "abcdfghjkmnpqrstvwxyz|ABCDFGHJKLMNPQRSTVWXYZ|0123456789";
    protected static $checkUrlExists = false;
    protected static $codeLength = 7;


    public function urlToShortCode($url)
    {
        if (empty($url)) {
            throw new Exception("No se indico una URL.");
        }

        if ($this->validateUrlFormat($url) == false) {
            throw new Exception("La URL no tiene un formato valido.");
        }

        if (self::$checkUrlExists) {
            if (!$this->verifyUrlExists($url)) {
                throw new Exception("La URL suministrada no existe.");
            }
        }

        $shortCode = $this->urlExistsInDB($url);
        if ($shortCode == false) {
            $shortCode = $this->createShortCode($url);
        }

        return $shortCode;
    }

    protected function validateUrlFormat($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    protected function verifyUrlExists($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return (!empty($response) && $response != 404);
    }

    protected function urlExistsInDB($url)
    {
        $result = short_urls::where('long_url', $url)->get()->first();
        return (empty($result)) ? false : $result->short_code;
    }

    protected function createShortCode($url)
    {
        $shortCode = $this->generateRandomString(self::$codeLength);
        $id = $this->insertUrlInDB($url, $shortCode);
        return $shortCode;
    }

    protected function generateRandomString($length = 6)
    {
        $sets = explode('|', self::$chars);
        $all = '';
        $randString = '';
        foreach ($sets as $set) {
            $randString .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for ($i = 0; $i < $length - count($sets); $i++) {
            $randString .= $all[array_rand($all)];
        }
        $randString = str_shuffle($randString);
        return $randString;
    }

    protected function insertUrlInDB($url, $code)
    {
        $su = new short_urls();
        $su->long_url = $url;
        $su->short_code = $code;
        $su->save();
        return $su->id;
    }

    public function shortCodeToUrl($code, $increment = true)
    {
        if (empty($code)) {
            throw new Exception("No se ha indicado una URL corta.");
        }

        if ($this->validateShortCode($code) == false) {
            throw new Exception("La URL corta no tiene el formato valido.");
        }

        $urlRow = $this->getUrlFromDB($code);

        if (empty($urlRow)) {
            throw new Exception("La URL corta no existe.");
        }

        if ($increment == true) {
            $this->incrementCounter($urlRow->id);
        }

        return $urlRow->long_url;
    }

    protected function validateShortCode($code)
    {
        $rawChars = str_replace('|', '', self::$chars);
        return preg_match("|[" . $rawChars . "]+|", $code);
    }

    protected function getUrlFromDB($code)
    {
        $result = short_urls::where('short_code', $code)->get()->first();
        return (empty($result)) ? false : $result;
    }

    protected function incrementCounter($id)
    {
        $su = short_urls::find($id);
        $su->hits = $su->hits + 1;
        $su->save();
    }

    public function urlStatistics($url)
    {
        if (empty($url)) {
            throw new Exception("No se indico una URL.");
        }

        if (($this->validateUrlFormat($url) == false) || ($this->validateShortCode($url) == false)) {
            throw new Exception("La URL no tiene un formato valido.");
        }

        $remove = 'https://' . env('SHORT_URL_PREFIX') . '/';
        $code = str_replace($remove, '', $url);
        $su = short_urls::where('long_url', $url)->orwhere('short_code', $code)->get()->first();

        if (empty($su)) {
            throw new Exception("La URL no esta registrada.");
        }

        return $su;
    }


    public function deleteUrl($url)
    {
        if (empty($url)) {
            throw new Exception("No se indico una URL.");
        }

        if (($this->validateUrlFormat($url) == false) || ($this->validateShortCode($url) == false)) {
            throw new Exception("La URL no tiene un formato valido.");
        }

        $remove = 'https://' . env('SHORT_URL_PREFIX') . '/';
        $code = str_replace($remove, '', $url);
        $su = short_urls::where('long_url', $url)->orwhere('short_code', $code)->get()->first();

        if (empty($su)) {
            throw new Exception("La URL no esta registrada.");
        }

        return $su->delete();
    }
}
