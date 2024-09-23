<?php

namespace App\Livewire;

use App\Models\App;
use Livewire\Component;
use Livewire\WithPagination;

class UserDevicesTable extends Component
{
    use WithPagination;

    public $search;

    public $app;

    protected $queryString = [
        'app',
    ];

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $devices = auth()->user()->devices();
        if ($this->app and $this->app !== '') {
            $app = App::where('key', $this->app)->firstOrFail();
            $devices = $devices->where('app_id', $app->id);
        }
        if ($this->search and $this->search !== '') {
            $devices = $devices->where('name', 'LIKE', "%$this->search%");
        }
        $devices = $devices->with([
            'app',
            'deviceType',
            'locationsCounts' => function ($query) {
                return $query->where('year', now()->year)->where('month', now()->month);
            },
        ])->orderByDesc('id');

        $devices = $devices->paginate(20);

        return view('livewire.user-devices-table', [
            'devices' => $devices,
        ]);
    }

    public function deleteDevice(int $deviceId): void
    {
        auth()->user()->devices()->findOrFail($deviceId)->delete();
    }
}
