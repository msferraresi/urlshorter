<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function urlToShortCode(Request $request)
    {
        //dd($request->URL);
        //El siguiente código crea un shortcode y genera una URL corta.
        $shortener = new ShortenerController();
        // URL Larga
        $longURL = $request->URL;

        // Prefijo para URL corta
        $shortURL_Prefix = 'https://' . env('SHORT_URL_PREFIX') . '/';
        try {
            // Llamado a funcion para acortar URL
            $shortCode = $shortener->urlToShortCode($longURL);
            // Se agrega prefijo a la clave devuelta
            $shortURL = $shortURL_Prefix . $shortCode;
            // Se muestra la URL corta

            return 'Short URL: ' . $shortURL;
        } catch (Exception $e) {
            // En caso de error se muestra el mensaje del mismo.
            return $e->getMessage();
        }
    }

    public function shortCodeToUrl(Request $request)
    {
        //El siguiente código gestiona la redirección de URL corta a la URL original.        
        $shortener = new ShortenerController();
        // Se obtiene el codigo generado partiendo de la URL corta indicada
        $shortCode = explode('/', $request->URL);

        try {
            // Se obtiene la URL original
            $url = $shortener->shortCodeToUrl($shortCode[count($shortCode) - 1]);

            // Se redirecciona a la URL
            //return $url;
            header("Location: " . $url);
            exit;
        } catch (Exception $e) {
            // En caso de error se muestra el mensaje del mismo.
            return $e->getMessage();
        }
    }

    public function urlStatistics(Request $request)
    {
        //El siguiente código muestra las estadisticas de una url suministrada.       
        $shortener = new ShortenerController();

        // Se obtiene la URL del request
        $URL = $request->URL;

        try {
            // Se realiza la consulta a la base de datos.
            $urlData = $shortener->urlStatistics($URL);
            // Se muestran los datos obtenidos en formato json
            return  json_encode($urlData);
        } catch (Exception $e) {
            // En caso de error se muestra el mensaje del mismo.
            return $e->getMessage();
        }
    }

    public function delteUrl(Request $request)
    {
        //El siguiente código realiza la baja logica de una URL solicitada        
        $shortener = new ShortenerController();
        // Se recupera la URL del request
        $URL = $request->URL;

        try {
            // Se realiza la baja logica de la URL, puede recibir una URL corta o larga
            $result = $shortener->deleteUrl($URL);
            // Se muestra un mensaje indicando que se realizo el borrado o no
            $mensaje = '';
            if ($result) {
                $mensaje = 'La URL ' . $URL . ' ha sido eliminada.';
            } else {
                $mensaje = 'La URL ' . $URL . ' no ha podido ser eliminada.';
            }
            return json_encode($mensaje);
        } catch (Exception $e) {
            // En caso de error se muestra el mensaje del mismo.
            return $e->getMessage();
        }
    }
}
