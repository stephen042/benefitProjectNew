<?php

namespace App\Livewire\Admin\EditUser;

use Livewire\Component;

class EditProgressBar extends Component
{
    public $user;

    public $progress_bar_status;

    public function updateProgressBar(){
        $this->validate([
            'progress_bar_status' => 'required',
        ]);
        $this->user->progress_bar_status = $this->progress_bar_status;
        $this->user->save();

        $this->dispatch('notify', 'User Trade progress bar has been updated', 'success');
        // return redirect()->route('admin.user.edit', $this->user->id);
    }
    public function render()
    {
        return view('livewire.admin.edit-user.edit-progress-bar');
    }
}
