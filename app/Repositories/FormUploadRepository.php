<?php

namespace App\Repositories;

use App\Models\FormUpload;
use App\Repositories\Interfaces\FormUploadRepositoryInterface;
use App\Repositories\HasCrud;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FormUploadRepository implements FormUploadRepositoryInterface
{
    use HasCrud;
    public function __construct(FormUpload $formupload = null)
    {
        if(!($formupload instanceof FormUpload)){
            $formupload = new FormUpload;
        }
        $this->model($formupload);
        $this->perPage(200);
    }
}