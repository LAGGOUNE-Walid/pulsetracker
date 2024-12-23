<?php

namespace App\Http\Controllers;

use App\Actions\CreateAppAction;
use App\Models\App;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function __construct(
        public CreateAppAction $createAppAction
    ) {}

    public function index(): View
    {
        return view('dashboard.apps.index');
    }

    public function create(Request $request): RedirectResponse
    {
        if ($request->user()->cannot('create', App::class)) {
            return redirect()->back()->with('error', "You've reached the limit for creating apps on your current plan. Please upgrade to add more apps and unlock additional features.");
        }
        $request->validate(['name' => 'required']);

        $this->createAppAction->create($request->user(), $request->name);

        return redirect("dashboard/apps");
    }
}
