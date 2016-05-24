<?php
/**
 * User: floran
 * Date: 24/05/2016
 * Time: 11:17
 */

namespace Foodcheri\SDKRoutificBundle\Controller;

use Foodcheri\SDKRoutificBundle\Routific\Endpoint;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Unirest;

class RoutificClient extends Controller
{
    /** @var string $baseUrl */
    private $baseUrl = "https://api.routific.com/v1";

    /** @var string $token */
    private $token;

    /**
     * ClientController constructor.
     *
     */
    public function __construct()
    {
        $this->baseUrl = $this->container->getParameter('routific.api_url');
        $this->token = $this->container->getParameter('routific.token_key');
    }

    /**
     * @param Endpoint $endpoint
     *
     * @return mixed
     * @throws Unirest\Exception
     */
    public function route(Endpoint $endpoint)
    {
        //the base uri for api requests
        $queryBuilder = $this->baseUrl;

        //prepare query string for API call
        $queryBuilder = $queryBuilder.$endpoint->getRoutingShortEndpoint();

        //validate and preprocess url
        $queryUrl = $this->cleanUrl($queryBuilder);


        $body = Unirest\Request\Body::Json($endpoint->getData());
        $headers = array(
            'Content-Type' => 'application/json',
            'Authorization' => 'bearer ' . $this->token,
        );

        $response = Unirest\Request::post($queryUrl, $headers, $body);

        //Error handling using HTTP status codes
        if (($response->code < 200) || ($response->code > 206)) {
            throw new Unirest\Exception("HTTP Response Not OK", $response->code);
        }

        return $response->body;
    }

    /**
     * Validates and processes the given Url
     *
     * @param    string $url The given Url to process
     *
     * @return string Pre-processed Url as string
     * @throws InvalidArgumentException
     */
    public static function cleanUrl($url)
    {
        //perform parameter validation
        if(is_null($url) || !is_string($url)) {
            throw new InvalidArgumentException('Invalid Url.');
        }
        //ensure that the urls are absolute
        $matchCount = preg_match("#^(https?://[^/]+)#", $url, $matches);
        if ($matchCount == 0) {
            throw new InvalidArgumentException('Invalid Url format.');
        }
        //get the http protocol match
        $protocol = $matches[1];

        //remove redundant forward slashes
        $query = substr($url, strlen($protocol));
        $query = preg_replace("#//+#", "/", $query);

        //return process url
        return $protocol.$query;
    }
}