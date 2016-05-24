<?php
/**
 * User: floran
 * Date: 24/05/2016
 * Time: 11:38
 */

namespace Foodcheri\SDKRoutificBundle\Routific;


class VehicleRoutingProblem extends Endpoint
{

    private $routingShortEndpoint = '/vrp';
    private $routingLongEndpoint = '/vrp-long';

    /**
     * @return string
     */
    public function getRoutingShortEndpoint()
    {
        return $this->routingShortEndpoint;
    }

    /**
     * @return string
     */
    public function getRoutingLongEndpoint()
    {
        return $this->routingLongEndpoint;
    }
}