<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class StorageController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('dashboard.storage.index', ['user' => $user]);
    }

    public function ldps(Request $request): RedirectResponse
    {
        if ($request->has('save_locations_input') and $request->save_locations_input == 'on') {
            $request->user()->update(['save_locations_enabled' => true]);
        } else {
            $request->user()->update(['save_locations_enabled' => false]);
        }

        return redirect()->back();
    }
}
