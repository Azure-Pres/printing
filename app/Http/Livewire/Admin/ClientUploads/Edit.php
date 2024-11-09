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

    // Function to save changes made on the form
    public function saveChanges()
    {
        $fieldsToUpdate = $this->fields;
        $entries = Code::where('upload_id', $this->uploadId)->get();

        foreach ($entries as $entry) {
            $data = json_decode($entry->code_data, true);

            foreach ($fieldsToUpdate as $oldKey => $field) {
                if (isset($data[$oldKey])) {
                    unset($data[$oldKey]);
                    $data[$field['key']] = $field['value'];
                }
            }

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