# RoutificBundle
SDK Routific

## Installation

Install the bundle by addind the following lines into composer.json


```
"require": {
	...
	"foodcheri/routific-bundle": "dev-master"
},
"repositories": [{
	"type": "vcs",
        "url": "https://github.com/foodcheri/RoutificBundle.git"
}],
```

Update your vendors

```
composer update
```

Add the configuration in config.yml

```
...
routific:
    api_url: ~ #default: https://api.routific.com/v1
    token_key: routific_token
```

## Usage

Instantiate the Routific client :

```
$clientRoutific = new RoutificClient();
```

To resolve Vehicle Routing Problem, instantiate a VehicleRoutingProblem Enpoint object :

```
$problem = new VehicleRoutingProblem();
```

Add a visit to a problem endpoint :

```
$problem->addVisit("order_1", array(
	"location" => array(
        "name" => "Visit1 name",
        "lat" => 49.227607,
        "lng" => -123.1363085
    ),
    "start" => "19:00",
    "end" => "19:30",
    "duration" => 5,
    "load" => 1,
    "type" => "A",
    "priority" => "high"
	)
);
```

Add a vehicle to a problem endpoint :

```
$problem->addVehicle("vehicle_1", array(
	"start_location" => array(
		"id" => "hub id"
        "name" => "hub name",
        "lat" => 49.227607,
        "lng" => -123.1363085
    ),
    "end_location" => array(
		"id" => "hub id"
        "name" => "hub name",
        "lat" => 49.227607,
        "lng" => -123.1363085
    ),
    "shift_start" => "18:00",
    "shift_end" => "22:30",
    "min_visits" => 10,
    "capacity" => 20,
    "type" => ["A", "B"],
    "speed" => "bike"
    "strict_start" => true,
    "break_start" => "12:00",
    "break_end" => "13:30",
    "break_duration" => 30
	)
);
```

Add an option to a problem endpoint :

```
"options": {
   "traffic": "slow",
   "min_visits_per_vehicle": 5,
   "balance": true,
   "min_vehicles": true,
   "shortest_distance": true
}
```
```
$problem->addOption(array("traffic" => "slow"));
```

Finaly execute the route calculation for the endpoint problem :

```
$clientRoutific->route($problem);
```

## Response

```
{
  "status": "success",
  "total_travel_time": 31.983334,
  "total_idle_time": 0,
  "num_unserved": 0,
  "unserved": null,
  "solution": {
    "vehicle_1": [
      {
        "location_id": "depot",
        "location_name": "800 Kingsway",
        "arrival_time": "08:00"
      },
      {
        "location_id": "order_3",
        "location_name": "800 Robson",
        "arrival_time": "08:10",
        "finish_time": "08:20"
      },
      {
        "location_id": "order_2",
        "location_name": "3780 Arbutus",
        "arrival_time": "08:29",
        "finish_time": "09:10"
      },
      {
        "location_id": "order_1",
        "location_name": "6800 Cambie",
        "arrival_time": "09:19",
        "finish_time": "09:29"
      },
      {
        "location_id": "depot",
        "location_name": "800 Kingsway",
        "arrival_time": "09:39"
      }
    ]
  }
}
```
