<?php

namespace App\Livewire;

use App\Models\Notification;
use App\Models\User;
use Livewire\Component;

class NewEditAdmin extends Component
{

    public $showModal = false;
    public $name = '';
    public $email = '';
    public $password = '';

    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->resetFields();
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.new-edit-admin');
    }


    public function saveAdmin()
    {
        // Validate fields
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',  // Password must be at least 8 characters long
        ]);

        // Save the admin user, ensuring the password is hashed
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),  // Use bcrypt to hash the password
        ]);

        // Close the modal and flash a success message
        $this->closeModal();

        return redirect()->to('admins')->with('success', 'Admin created successfully.');
    }
}
