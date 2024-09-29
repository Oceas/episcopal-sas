<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;

class NewNotification extends Component
{
    public $showModal = false;
    public $title = '';
    public $body = '';
    public $scheduled_datetime;

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function resetFields()
    {
        $this->title = '';
        $this->body = '';
        $this->scheduled_datetime = now()->format('Y-m-d\TH:i'); // Default to current date and time
    }

    public function saveNotification()
    {
        // Validate fields
        $this->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'scheduled_datetime' => 'required|date_format:Y-m-d\TH:i',
        ]);

        // Logic to save the notification
        // For example, inserting it into the database
        Notification::create([
            'title' => $this->title,
            'body' => $this->body,
            'scheduled_at' => $this->scheduled_datetime, // Assuming your table has a 'scheduled_at' column
        ]);

        // Close the modal and flash a success message
        $this->closeModal();

        return redirect()->to('notifications');

    }

    public function render()
    {
        return view('livewire.new-notification');
    }
}
