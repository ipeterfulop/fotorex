<?php

namespace App\Http\Controllers;

use App\Contactmessage;
use App\Http\Requests\SaveContactmessageRequest;
use Illuminate\Http\Request;

class ContactmessagesController extends Controller
{
    public function submit(SaveContactmessageRequest $request)
    {
        $result = Contactmessage::create($request->getDataset());
        if ($result != null) {
            session()->put('message', 'Üzenetét rögzítettük, köszönjük a megkeresést. Kollégáink hamarosan felveszik önnel a kapcsolatot.');
        } else {
            session()->put('message', 'Üzenetét nem sikerült rögzítenünk, kérjük, próbálja meg később.');
        }

        return redirect(route('contactmessage_index'));
    }
}
