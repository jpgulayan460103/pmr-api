<?php

namespace App\Repositories;

use App\Models\Supplier;
use App\Models\SupplierContact;
use App\Repositories\Interfaces\SupplierRepositoryInterface;
use App\Repositories\HasCrud;
use Illuminate\Support\Facades\DB;

class SupplierRepository implements SupplierRepositoryInterface
{
    use HasCrud {
        create as mCreate;
        update as mUpdate;
    }
    public function __construct(Supplier $supplier = null)
    {
        if(!($supplier instanceof Supplier)){
            $supplier = new Supplier;
        }
        $this->model($supplier);
        $this->perPage(200);
    }

    public function create($data)
    {
        $created_supplier = $this->mCreate($data);
        $contacts = $this->createContacts();
        $created_supplier->contacts()->saveMany($contacts);
        return $created_supplier;
    }

    public function createContacts()
    {
        $contacts = array();
        if(request()->has('contacts') && request('contacts') != array()){
            foreach (request('contacts') as $key => $contact) {
                $contacts[$key] = new SupplierContact($contact);
            }
        }
        return $contacts;
    }

    public function update($data, $id)
    {
        DB::beginTransaction();
        try {
            $new_contacts = $this->updateContacts($id);
            $supplier = $this->mUpdate($id, $data);
            $supplier->contacts()->saveMany($new_contacts);
            DB::commit();
            return $supplier;
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function updateContacts($id)
    {
        $contact_ids_form = array();
        $contact_ids = SupplierContact::where('supplier_id',$id)->pluck('id')->toArray();
        $new_contacts = array();
        if(request()->has('contacts') && request('contacts') != array()){
            foreach (request('contacts') as $key => $contact) {
                if(isset($contact['id'])){
                    SupplierContact::find($contact['id'])->update($contact);
                    $contact_ids_form[] = $contact['id']; 
                }else{
                    $new_contacts[$key] = new SupplierContact($contact);
                }
            }
            $this->removeContacts($contact_ids,$contact_ids_form);
        }
        return $new_contacts;
    }

    public function removeContacts($contact_ids,$contact_ids_form)
    {
        $removed_contact_ids = array_diff($contact_ids,$contact_ids_form);
        SupplierContact::whereIn('id', $removed_contact_ids)->delete();
    }
}