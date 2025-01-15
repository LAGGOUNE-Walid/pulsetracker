<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class UserGeofencesTable extends Component
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
        $geofences = auth()->user()->geofences()->with('app');
        if ($this->app and $this->app !== '') {
            $geofences = $geofences->where('app_id', $this->app);
        }
        if ($this->search and $this->search !== '') {
            $geofences = $geofences->where('name', 'LIKE', "%$this->search%");
        }
        $geofences = $geofences->orderByDesc('id')->paginate(20);

        return view('livewire.user-geofences-table', ['geofences' => $geofences]);
    }

    public function deleteGeofence(int $geofenceId): void
    {
        auth()->user()->geofences()->where('id', $geofenceId)->firstOrFail()->delete();
    }
}
