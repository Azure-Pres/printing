<?php

namespace App\Http\Livewire\Client\UploadData;

use App\Exports\Client\Samples\UploadSample;
use App\Imports\Client\UploadData\Upload as UploadCode;
use App\Models\ClientUpload;
use Auth;
use Excel;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;

    public $file;

    public function render()
    {
        return view('livewire.client.upload-data.upload')->layout('layouts.client');
    }

    public function modify()
    {
        $this->validate();

        ini_set('max_execution_time', 6000);

        $progress_id = uniqid();

        $data = [
            'client_id'   => Auth::id(),
            'progress_id' => $progress_id
        ];

        $client_upload = new ClientUpload;
        $client_upload->client_id  = Auth::id();
        $client_upload->file_url   = $this->file->store('import');
        $client_upload->progress_id= $progress_id;
        $client_upload->status     = '0';
        $client_upload->save();

        $import = Excel::queueImport(new UploadCode($data), $this->file->store('temp'));
        session()->flash('message', 'Upload progress started. Please check status here.');

        userlog('Code','Code Uploaded');
        return redirect('client/upload-data');
    }

    public function rules(){
        return [
            'file'       => getRule('excel',true)
        ];
    }

    public function sample()
    {
        return Excel::download(new UploadSample(), 'upload-data-sample.xlsx');
    }
}
