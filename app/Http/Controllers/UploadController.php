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
    public function people(Request $request) {
        $people = simplexml_load_file($request->file);
        if(!isset($people->person)) {
            throw new \Exception('Error parser');
        }
        
        DB::beginTransaction();
        try {
            foreach($people as $personXml) {
                $person = new Person();
                $person->id = intval($personXml->personid);
                $person->name = strval($personXml->personname);
                $phones = array();
                $person->save();
                foreach($personXml->phones->phone as $phoneXml) {
                    $phone = new Phone();
                    $phone->phone = strval($phoneXml);
                    $phone->person_id = $person->id;
                    $phone->save();
                    $phones[] = $phone;
                }
            }

            // DB::rollback();
            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            dd($e);
        }

        return redirect()->route('home');
    }

    public function orders(Request $request) {
        $shiporders = simplexml_load_file($request->file);
        if(!isset($shiporders->shiporder)) {
            throw new \Exception('Error parser');
        }
        
        DB::beginTransaction();
        try {
            foreach($shiporders as $shiporder) {
                $order = new Order();
                $order->id = intval($shiporder->orderid);
                $order->person_id = intval($shiporder->orderperson);
                $order->save();
                $address = new Address();
                $address->name = strval($shiporder->shipto->name);
                $address->address = strval($shiporder->shipto->address);
                $address->city = strval($shiporder->shipto->city);
                $address->country = strval($shiporder->shipto->country);
                $address->order_id = $order->id;
                $address->save();

                foreach($shiporder->items->item as $itemXml) {
                    $item = new Item();
                    $item->title = strval($itemXml->title);
                    $item->note = strval($itemXml->note);
                    $item->quantity = intval($itemXml->quantity);
                    $item->price = floatval($itemXml->price);
                    $item->order_id = $order->id;
                    $item->save();
                }
            }

            // DB::rollback();
            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            dd($e);
        }

        return redirect()->route('home');

    }
}
