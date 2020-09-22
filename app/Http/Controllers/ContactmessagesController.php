<?php

namespace App\Http\Controllers;

use App\Contactmessage;
use App\Http\Requests\SaveContactmessageRequest;
use Illuminate\Http\Request;

class ContactmessagesController extends Controller
{
    public function index()
    {
        $viewData = [];
        if (request()->has('subject')) {
            $viewData['defaultMessage'] = 'Tárgy: '.request()->get('subject');
        }

        return view('public.contactmessages.index', $viewData);
    }

    public function submit(SaveContactmessageRequest $request)
    {
        $result = $request->save();
        if ($result != null) {
            $message = 'Üzenetét rögzítettük, köszönjük a megkeresést. Kollégáink hamarosan felveszik önnel a kapcsolatot.';
        } else {
            $message = 'Üzenetét nem sikerült rögzítenünk, kérjük, próbálja meg később.';
        }
        if ($request->isXmlHttpRequest()) {
            return response($message);
        }
        session()->put('message', $message);

        return redirect(route('contactmessage_index'));
    }
}
