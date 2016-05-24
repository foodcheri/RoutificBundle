<?php
/**
 * User: floran
 * Date: 24/05/2016
 * Time: 11:44
 */

namespace Foodcheri\SDKRoutificBundle\Routific;


abstract class Endpoint
{

    /** @var array $data */
    protected $data;

    /**
     * VehicleRoutingProblem constructor.
     */
    public function __construct()
    {
        $this->data = [
            'visits' => [],
            'fleet' => [],
            'options' => []
        ];
    }

    public function addVisit($id, $visit)
    {
        $this->data['visits'][$id] = $visit;
    }

    public function addVehicle($id, $vehicle)
    {
        $this->data['fleet'][$id] = $vehicle;
    }

    public function addOption($id, $option)
    {
        $this->data['options'][$id] = $option;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    abstract public function getRoutingShortEndpoint();
}