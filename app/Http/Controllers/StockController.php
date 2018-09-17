<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function __construct()
    {
        //
    }

    public function create()
    {
        return view('stock');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'quantity_in_stock' => 'required|numeric',
            'price_per_item' => 'required|numeric'
        ]);

        $jsonString = file_get_contents(base_path('database.json'));
        $data = json_decode($jsonString, true);

        $newData = array_except($request->all(), '_token');
        $id = is_array($data) ? count($data) + 1 : 1;

        $newData = array_prepend($newData, $id, 'id');
        $newData = array_add($newData, 'total_value_number', $request->quantity_in_stock * $request->price_per_item);
        $newData = array_add($newData, 'created_at', Carbon::now()->toDateTimeString());

        if (is_array($data)) {
            array_push($data, $newData);
        }else {
            $data = [$newData];
        }
        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);

        if (file_put_contents(base_path('database.json'), stripslashes($newJsonString))) {
            $jsonString = file_get_contents(base_path('database.json'));
            $data = json_decode($jsonString, true);

            return response()->json($data);
        }
    }

    public function index()
    {
        $jsonString = file_get_contents(base_path('database.json'));
        $data = json_decode($jsonString, true);

        return response()->json($data);
    }

    public function updateStock($id, Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'quantity_in_stock' => 'required|numeric',
            'price_per_item' => 'required|numeric'
        ]);

        $jsonString = file_get_contents(base_path('database.json'));
        $data = json_decode($jsonString, true);

        foreach ($data as $key => $entry) {
            if (array_get($entry, 'id') == $id) {
                $entry['product_name'] = $request->product_name;
                $entry['quantity_in_stock'] = $request->quantity_in_stock;
                $entry['price_per_item'] = $request->price_per_item;
                $entry['total_value_number'] = $request->quantity_in_stock * $request->price_per_item;
                $data[$key] = $entry;

                $newJsonString = json_encode($data, JSON_PRETTY_PRINT);

                if (file_put_contents(base_path('database.json'), stripslashes($newJsonString))) {
                    //
                }
            }
        }

        $jsonString = file_get_contents(base_path('database.json'));
        $data = json_decode($jsonString, true);

        return response()->json($data);
    }
}
