<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Item;
use App\Models\Order;
use App\Models\Person;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UploadController extends Controller
{
    public function people(Request $request)
    {
        $people = simplexml_load_file($request->file);
        if (!isset($people->person)) {
            throw new \Exception('Error parser');
        }

        DB::beginTransaction();
        try {
            foreach ($people as $personXml) {
                $person = Person::updateOrCreate(
                    array('name' => strval($personXml->personname)),
                    array('id' => intval($personXml->personid))
                );
                foreach ($personXml->phones->phone as $phoneXml) {
                    Phone::updateOrCreate(
                        array('phone' => strval($phoneXml)),
                        array('person_id' => $person->id)
                    );
                }
            }

            // DB::rollback();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }

        return redirect()->route('home');
    }

    public function orders(Request $request)
    {
        $shiporders = simplexml_load_file($request->file);
        if (!isset($shiporders->shiporder)) {
            throw new \Exception('Error parser');
        }

        DB::beginTransaction();
        try {
            foreach ($shiporders as $shiporder) {
                $order = Order::updateOrCreate(
                    array('person_id' => intval($shiporder->orderperson)),
                    array('id' => intval($shiporder->orderid))
                );

                Address::updateOrCreate(
                    array(
                        'name' => strval($shiporder->shipto->name),
                        'address' => strval($shiporder->shipto->address),
                        'city' => strval($shiporder->shipto->city),
                        'country' => strval($shiporder->shipto->country),
                    ),
                    array('order_id' => $order->id)

                );

                foreach ($shiporder->items->item as $itemXml) {
                    Item::updateOrCreate(
                        array(
                            'title' => strval($itemXml->title),
                            'note' => strval($itemXml->note),
                            'quantity' => intval($itemXml->quantity),
                            'price' => floatval($itemXml->price),
                        ),
                        array('order_id' => $order->id)
                    );
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }

        return redirect()->route('home');

    }
}
