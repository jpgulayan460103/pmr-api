<?php

namespace App\Repositories;

use App\Models\NoStockCertificate;
use App\Repositories\Interfaces\NoStockCertificateRepositoryInterface;
use App\Repositories\HasCrud;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NoStockCertificateRepository implements NoStockCertificateRepositoryInterface
{
    use HasCrud {
        create as mCreate;
        update as mUpdate;
    }
    public function __construct(NoStockCertificate $noStockCertificate = null)
    {
        if(!($noStockCertificate instanceof NoStockCertificate)){
            $noStockCertificate = new NoStockCertificate;
        }
        $this->model($noStockCertificate);
        $this->perPage(200);
    }

    public function getLastNumber()
    {
        $year = date("Y");
        $start_year = Carbon::parse("$year-01-01");
        $end_year = Carbon::parse("$year-01-01")->addYear()->subSecond();

        $last_number = 0;
        $last_no_stock_certificate = $this->model
        ->whereBetween('created_at', [$start_year, $end_year])
        ->limit(1)
        ->orderBy('id', 'desc')
        ->first();
        if($last_no_stock_certificate){
            $cnas_number_exploded = explode("-", $last_no_stock_certificate->cnas_number);
            $last_number = end($cnas_number_exploded);
        }
        return (integer) $last_number;
    }
}