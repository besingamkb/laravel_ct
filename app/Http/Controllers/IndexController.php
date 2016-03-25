<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Storage;

class IndexController extends Controller
{
    public function Index()
    {
    	return view('index');
    }

    public function GetAll() 
    {
    	$data = json_decode(Storage::get('data.json'), true);
    	$return_data['data'] = [];

    	$date = new \DateTime();

    	foreach ($data as $key => $value) {
    		$date->setTimestamp($value['time_created']);
    		$vData = array(
    			"product_name" => $value['product_name'],
    			"product_quantity" => $value['product_quantity'],
    			"product_price" => $value['product_price'],
    			"date_submitted" => $date->format("d-m-y H:i:s"),
    			"total_value_number" => $value['product_quantity'] * $value['product_price']
    		);
    		array_push($return_data['data'], $vData);
    	}

    	header('Content-Type: application/json');
    	echo json_encode($return_data);
    }

    public function AddProduct(Request $request) 
    {
    	$data_json = [];
    	$data_get = Storage::get('data.json');

    	if (!empty($data_get)) {
    		$data_json = json_decode($data_get, true);
    	}

    	$date = new \DateTime();
    	$data['product_name'] = $request->get('product_name');
    	$data['product_quantity'] = $request->get('product_quantity');
    	$data['product_price'] = $request->get('product_price');
    	$data['time_created'] = $date->getTimestamp();

    	array_push($data_json, $data);

    	Storage::put('data.json', json_encode($data_json, true));
    }
}
