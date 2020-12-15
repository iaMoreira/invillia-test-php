<?php

namespace App\Services;

use App\Mail\ProcessOrdersMail;
use App\Mail\ProcessPeopleMail;
use App\Models\Address;
use App\Models\Item;
use App\Models\Order;
use App\Models\Person;
use App\Models\Phone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UploadService
{

    public function uploadPeople($people, ?string $email)
    { 
        DB::beginTransaction();
        try {
            $people->person = is_array($people->person) ? $people->person : array($people->person);
            foreach ($people->person as $personXml) {
                $person = Person::updateOrCreate(
                    array('name' => $personXml->personname),
                    array('id' => intval($personXml->personid))
                );
                $personXml->phones->phone = is_array($personXml->phones->phone) ? $personXml->phones->phone : array($personXml->phones->phone);
                foreach ($personXml->phones->phone as $phoneXml) {
                    Phone::updateOrCreate(
                        array('phone' => strval($phoneXml)),
                        array('person_id' => $person->id)
                    );
                }
            }
            if(!is_null($email)) {
                Mail::to($email)->send(new ProcessPeopleMail(count($people->person)));
            }
            DB::commit();
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
        }
    }

    public function uploadOrders($shiporders, ?string $email)
    { 
        DB::beginTransaction();
        try {
            Mail::to($email)->send(new ProcessPeopleMail(3));

            $shiporders->shiporder = is_array($shiporders->shiporder) ? $shiporders->shiporder : array($shiporders->shiporder);
            foreach ($shiporders->shiporder as $shiporder) {
                $order = Order::updateOrCreate(
                    array('person_id' => intval($shiporder->orderperson)), // TODO validation
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

                $shiporder->items->item = is_array($shiporder->items->item) ? $shiporder->items->item : array($shiporder->items->item);
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

            if(!is_null($email)) {
                Mail::to($email)->send(new ProcessOrdersMail(count($shiporders->shiporder)));
            }
            DB::commit();
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
        }
    }
}