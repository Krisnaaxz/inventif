<?php

namespace App\View\Components\ManageUser;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormUser extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $name, $email, $role, $action;
    public function __construct($id = null)
    {
        if($id) {
            $user = User::findOrFail($id);
            $this->id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->role;
            $this->action = route('manage-user.update', $user->id);
        } else {
            $this->action = route('manage-user.store');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.manage-user.form-user');
    }
}
