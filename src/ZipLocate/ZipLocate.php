<?php
namespace ZipLocate;

use ZipLocate\Response\Response;

class ZipLocate
{
    static $apiVersion = 'v1';
    static $apiEndpoint = 'http://ziplocate.us/api';

    /**
     * Get Response from API
     *
     * @param $data
     * @return bool|Response
     * @throws \Exception
     */
    static private function getResponse($data)
    {
        $jsonData = json_decode($data);
        if( ! $jsonData )
        {
            throw new \Exception('ziplocate.us answered with an unknown response');
        } else {
            $response = new Response();
            $response->setLat($jsonData->lat);
            $response->setLng($jsonData->lng);
            $response->setZip($jsonData->zip);
            return $response;
        }

        return false;
    }

    /**
     * Query the API
     *
     * @param $resource
     * @return bool|Response
     */
    static private function callApi($resource)
    {
        $url = sprintf('%s/%s%s', self::$apiEndpoint, self::$apiVersion, $resource);

        // check 404
        $headers = get_headers($url);
        if( ! $headers || !isset($headers[0]) )
            return false;

        $responseCode = substr($headers[0], 9, 3);
        if( $responseCode != 200 )
            return false;

        $data = file_get_contents($url);
        if( ! $data )
            return false;

        return self::getResponse($data);
    }

    /**
     * Get Geo Cords from ZipCode
     *
     * @param $zipCode
     * @return bool|Response
     */
    static public function fromZipCode($zipCode)
    {
        return self::callApi('/' . $zipCode );
    }
}