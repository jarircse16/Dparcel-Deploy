<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
// import Exportable
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Exportable;
// import View  
use Illuminate\Contracts\View\View;
use App\Models\BulkDelivery;

class BulkDeliveryExport implements FromView, ShouldAutoSize
{
    use Exportable;

    private $bulkDelivery;

    public function __construct()
    {
        $this->bulkDelivery = BulkDelivery::all();
    }

    public function view() : View
    {
        return view('vendor.bulkDeliveries', [
            'bulkDelivery' => $this->bulkDelivery
        ]);
    }
}
