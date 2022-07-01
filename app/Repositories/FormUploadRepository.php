<?php

namespace App\Repositories;

use App\Models\FormUpload;
use App\Models\PurchaseRequest;
use App\Repositories\Interfaces\FormUploadRepositoryInterface;
use App\Repositories\HasCrud;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $year = date("Y");
        $month = date("m");
        $uuid = "";
        switch ($type) {
            case 'purchase_request':
                $form = (new PurchaseRequestRepository)->getById($id);
                $uuid = $form->uuid;
                $year = $form->created_at->format('Y');
                $month = $form->created_at->format('m');
                break;
            case 'procurement_plan':
                $form = (new ProcurementPlanRepository)->getById($id);
                $uuid = $form->uuid;
                $year = $form->created_at->format('Y');
                $month = $form->created_at->format('m');
                break;
            case 'requisition_issue':
                $form = (new RequisitionIssueRepository())->getById($id);
                $uuid = $form->uuid;
                $year = $form->created_at->format('Y');
                $month = $form->created_at->format('m');
                break;
            
            default:
                # code...
                break;
        }
        $disk = env('APP_ENV') == "local" ? "local" : "sftp";
        $disk = "google";
        $file_uuid_array = explode("-", Str::uuid());
        $filename = Str::slug($file->getClientOriginalName(), '-')."-".last($file_uuid_array).".".$file->getClientOriginalExtension();
        $path = Storage::disk($disk)->putFileAs("", $file, $filename);
        $url = Storage::url($path);
        $createdFile = $this->create([
            'upload_type' => "file",
            'form_type' => $type,
            'disk' => $disk,
            'title' => request('meta.description'),
            'filename' => $filename,
            'filesize' => $file->getSize(),
            'file_directory' => $path,
            'user_id' => $user->id,
            'is_removable' => 1,
            'form_uploadable_id' => $id,
            'form_uploadable_type' => get_class($form),
        ]);
        return $path;
        return $url;
    }

    public function deleteFile()
    {
        // PurchaseRequestItem::where('id', $removed_item_id)->first()->delete();
    }

    public function download($uuid)
    {
        $uploads = $this->getByUuid($uuid);
        if(Storage::disk($uploads->disk)->exists($uploads->file_directory)){
            return Storage::disk($uploads->disk)->download($uploads->file_directory);
            return $uploads;
        }
        abort(404);
        
    }
}