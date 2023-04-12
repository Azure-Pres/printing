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
        $count = $this->getRows($this->file);

        if ($count<=0) {
            $this->addError('file','File is empty. Please upload file with appropriate data.');
            return false;
        }

        $progress_id = uniqid();
        $data = [
            'client_id'   => Auth::id(),
            'total_rows'  => $count,
            'progress_id' => $progress_id
        ];

        $client_upload = new ClientUpload;
        $client_upload->client_id = Auth::id();
        $client_upload->file_url   = $this->file->store('import');
        $client_upload->progress_id= $progress_id;
        $client_upload->total_rows = $count;
        $client_upload->status     = '0';
        $client_upload->save();

        $import = Excel::import(new UploadCode($data), $this->file);
        session()->flash('message', 'Upload progress started. Please check status here.');

        return redirect('client/upload-data');
    }

    public function rules(){
        return [
            'file'       => getRule('excel',true)
        ];

        // ['required', 'string', 'max:191',Rule::unique('client_uploads')->where(function ($query){
        //         return $query->where('client_id', Auth::id());
        //     })]
    }

    public function sample()
    {
        return Excel::download(new UploadSample(), 'upload-data-sample.xlsx');
    }

    public function getRows($file)
    {
        $fileExtension     = pathinfo($file, PATHINFO_EXTENSION);
        $temporaryFileFactory=new \Maatwebsite\Excel\Files\TemporaryFileFactory(
            config('excel.temporary_files.local_path', 
                config('excel.exports.temp_path', 
                    storage_path('framework/laravel-excel'))
            ),
            config('excel.temporary_files.remote_disk')
        );


        $temporaryFile = $temporaryFileFactory->make($fileExtension);
        $currentFile = $temporaryFile->copyFrom($file,null);            
        $reader = \Maatwebsite\Excel\Factories\ReaderFactory::make(null,$currentFile);
        $info = $reader->listWorksheetInfo($currentFile->getLocalPath());
        $totalRows = 0;
        foreach ($info as $sheet) {
            $totalRows+= $sheet['totalRows'];
        }
        $currentFile->delete();

        return $totalRows-1;
    }
}
