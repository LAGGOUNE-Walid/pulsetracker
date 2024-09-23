<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class UserAppsTable extends Component
{
    use WithPagination;

    public $search;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $apps = auth()
            ->user()
            ->apps()
            ->with([
                'locationsCounts' => function ($query) {
                    return $query->where('month', now()->month)->where('year', now()->year);
                },
            ])
            ->withCount([
                'devices',
            ])
            ->orderByDesc('id');
        if ($this->search and $this->search !== '') {
            $apps = $apps->where('name', 'LIKE', "%$this->search%");
        }
        $apps = $apps->paginate(15);

        return view('livewire.user-apps-table', ['apps' => $apps]);
    }

    public function deleteApp(int $id): void
    {
        auth()->user()->apps()->findOrFail($id)->delete();
    }
}
