<?php

namespace App\Http\Livewire\Admin\ClientUploads;

use Livewire\Component;
use App\Models\Code;

class Edit extends Component
{
    public $uploadId;
    public $fields = [];
    public $consistentFields = [];

    public function mount($id)
    {
        $this->uploadId = decrypt($id);
        $this->consistentFields = $this->getRepetitiveFields($this->uploadId);
        $this->fields = $this->consistentFields;
    }

    // Function to identify keys with consistent values across the same upload_id
    private function getRepetitiveFields($uploadId)
    {
        $entries = Code::where('upload_id', $uploadId)->get();
        $jsonFields = [];

        foreach ($entries as $entry) {
            $data = json_decode($entry->code_data, true);
            foreach ($data as $key => $value) {
                if (!isset($jsonFields[$key])) {
                    $jsonFields[$key] = ['value' => $value, 'consistent' => true];
                } elseif ($jsonFields[$key]['value'] !== $value) {
                    $jsonFields[$key]['consistent'] = false;
                }
            }
        }

        // Filter fields to keep only those with consistent values
        $consistentFields = array_filter($jsonFields, fn($field) => $field['consistent']);
        // Return an array in format suitable for binding to the edit form
        return array_map(fn($field, $key) => ['key' => $key, 'value' => $field['value']], $consistentFields, array_keys($consistentFields));

    }


    public function saveChanges()
    {
        $fieldsToUpdate = $this->fields;
        $entries = Code::where('upload_id', $this->uploadId)->get();

        foreach ($entries as $entry) {
            $data = json_decode($entry->code_data, true);

            foreach ($fieldsToUpdate as $field) {
            // Access the key from the field array directly
                $keyToUpdate = $field['key'];

            // Check if the key exists in data before updating
                if (array_key_exists($keyToUpdate, $data)) {
                unset($data[$keyToUpdate]); // Remove the old key
                $data[$field['key']] = $field['value']; // Add the new key-value pair
            } else {
                // Optional: Log or handle the case where the key is missing in data
                \Log::warning("Key '{$keyToUpdate}' not found in data for entry ID {$entry->id}");
            }
        }

        // Save the updated data back to the entry
        $entry->code_data = json_encode($data);
        $entry->save();
    }

    session()->flash('message', 'Code data updated successfully.');
    return redirect()->route('admin-client-uploads');
}

public function render()
{
    return view('livewire.admin.clientuploads.edit', [
        'consistentFields' => $this->consistentFields
    ]);
}
}