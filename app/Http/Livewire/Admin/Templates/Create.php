<?php

namespace App\Http\Livewire\Admin\Templates;

use App\Models\Template;
use App\Models\User;
use Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use Carbon\Carbon;

class Create extends Component
{
    use WithFileUploads;

    public $master_image;
    public $client ='';
    public $name   ='';
    public $data_list = [];

    public $page_data = [
        'margin_left'       => '0', 
        'margin_top'        => '0', 
        'margin_right'      => '0', 
        'margin_bottom'     => '0', 
        'width'             => '0', 
        'height'            => '0',
        'font_style'        => '',
    ];

    public $master_layout = [
        'width' => '0', 
        'height' => '0', 
    ];

    public $qr_code = [
        'left' => '0', 
        'top' => '0', 
        'width' => '0', 
        'height' => '0', 
        'field' => ''
    ];

    public $base_data = [
        'applicable' => false,
        'top'        => '0',
        'left'       => '0',
        'width'      => '0', 
        'height'     => '0', 
        'font_size'  => '1',
        'data_one'   => '',
        'data_two'   => '',
        'data_three' => '',
        'data_four'  => '',
        'data_five'  => '',
        'vendor_code' => ''
    ];

    public $side_data = [
        'applicable' => false,
        'top'        => '0',
        'left'       => '0',
        'width'      => '0', 
        'height'     => '0', 
        'font_size'  => '1',
        'rotate'     => '270',
        'data_one'   => '',
        'data_two'   => '',
        'data_three' => '',
        'data_four'  => ''
    ];

    public function render()
    {
        $clients = User::where('type','Client')->get();
        return view('livewire.admin.templates.create')->with('clients',$clients);
    }

    public function modify()
    {
        $path = '';

        if ($this->master_image) {
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . uniqid() . '-' . str_replace([' ', ':'], '-', $this->master_image->getClientOriginalName());
            Storage::putFileAs('public/master_image', $this->master_image, $name);
            $path = Storage::url('master_image/'.$name);
        }

        $template = Template::create([
            'name' => $this->name,
            'client_id' => $this->client,
            'status' => 'Active',
            'created_by' => Auth::id(),
            'data' => json_encode([
                'page_data' => $this->page_data,
                'master_layout' => $this->master_layout,
                'master_image' => $path,
                'qr_code' => $this->qr_code,
                'base_data' => $this->base_data,
                'side_data' => $this->side_data
            ])
        ]);

        userlog('Template','Template '.$template->name.' Added');
        return redirect('admin/templates');
    }

    public function getDataList()
    {
        $this->data_list = [];
        
        if ($this->client) {
            $client = User::find($this->client);
            $data_list = $client->getClientAttributes;

            foreach ($data_list as $key => $data) {
                array_push($this->data_list, $data->getCodeAttribute->name);
            }

            if ($client->id==4) {
                array_push($this->data_list, 'lot_serial_combined');
                array_push($this->data_list, 'vendor_code');
            }

            if ($client->id==5) {
                array_push($this->data_list, 'azure_with_tnc');
                array_push($this->data_list, 'urban');
                array_push($this->data_list, 'rural');
            }
        }
    }
}
