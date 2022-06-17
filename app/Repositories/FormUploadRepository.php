<?php

namespace App\Repositories;

use App\Models\FormUpload;
use App\Models\PurchaseRequest;
use App\Repositories\Interfaces\FormUploadRepositoryInterface;
use App\Repositories\HasCrud;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function upload($type, $id)
    {
        $user = Auth::user();
        $file = request('file');
        $form = "";
        $yearMonth = date("Y-m");
        $uuid = "";
        switch ($type) {
            case 'purchase_request':
                $form = (new PurchaseRequestRepository)->getById($id);
                $uuid = $form->uuid;
                $yearMonth = $form->created_at->format('Y-m');
                break;
            case 'procurement_plan':
                $form = (new ProcurementPlanRepository)->getById($id);
                $uuid = $form->uuid;
                $yearMonth = $form->created_at->format('Y-m');
                break;
            case 'requisition_issue':
                $form = (new RequisitionIssueRepository())->getById($id);
                $uuid = $form->uuid;
                $yearMonth = $form->created_at->format('Y-m');
                break;
            
            default:
                # code...
                break;
        }
        $path = Storage::putFile("public/uploads/$type/$yearMonth/$uuid", $file);
        $url = Storage::url($path);
        $createdFile = $this->create([
            'upload_type' => $type,
            'title' => request('meta.description'),
            'filename' => $file->getClientOriginalName(),
            'filesize' => $file->getSize(),
            'file_directory' => $url,
            'user_id' => $user->id,
            'form_uploadable_id' => $id,
            'form_uploadable_type' => get_class($form),
        ]);
        return $url;
    }

    public function deleteFile()
    {
        // PurchaseRequestItem::where('id', $removed_item_id)->first()->delete();
    }
}