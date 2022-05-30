<?php

namespace App\Http\Livewire;

use App\Models\Promodisers;
use Livewire\Component;
use Livewire\Livewire;

class PromodisersComponent extends Component
{
   public $promodiser_id, $Firstname, $Lastname, $Mobilenumber,$Location_code, $promodiser_edit_id, $promodiser_delete_id;
   public $view_promodiser_id, $view_promodiser_Firstname, $view_promodiser_Lastname, $view_promodiser_Mobilenumber, $view_promodiser_Location_code;
   public $searchTerm; 

    //Input fields on update validation
    public function updated($fields)
    {
        $this->validateOnly($fields, [
           'promodiser_id' => 'required|unique:promodisers,promodiser_id,' .$this->promodiser_edit_id.'', 
            'Firstname'=> 'required|max:255',
            'Lastname'=> 'required|max:255',
            'Mobilenumber'=> 'required|numeric',
            'Location_code' => 'required|numeric',
        ]);
    }

    public function storePromodiserData() 
    {
        //on-form submit validation
       $this->validate([
        'promodiser_id' => 'required|unique:promodisers',
        'Firstname'=> 'required|max:255',
        'Lastname'=> 'required|max:255',
        'Mobilenumber'=> 'required|numeric',
        'Location_code' => 'required|numeric',
       ]); 
    

    //Add Promodiser Data
    $promodiser =new Promodisers();
    $promodiser->promodiser_id = $this->promodiser_id;
    $promodiser->Firstname = $this->Firstname;
    $promodiser->Lastname = $this->Lastname;
    $promodiser->Mobilenumber = $this->Mobilenumber;
    $promodiser->Location_code = $this->Location_code;
     
    $promodiser->save();
     
    session()->flash('message','New Promo merchandiser has been added successfilly');

    $this->promodiser_id ='';
    $this->Firstname ='';
    $this->Lastname ='';
    $this->Mobilenumber ='';
    $this->Location_code = '';
    $this->promodiser_edit_id ='';
     
    //For hide moadal after add promodiser successs
    $this->dispatchBrowserEvent('close-modal');
    }

    public function resetInputs()
    {
        $this->promodiser_id ='';
        $this->Firstname ='';
        $this->Lastname ='';
        $this->Mobilenumber ='';
        $this->Location_code = '';
        $this->promodiser_edit_id ='';
    }

    public function close()
    {
        $this->resetInputs();
    }
  
    public function editPromodisers($id)
    {
        $promodiser = Promodisers::where('id',$id)->first();

        $this->promodiser_edit_id = $promodiser->id;
        $this->promodiser_id = $promodiser->promodiser_id;
        $this->Firstname = $promodiser->Firstname;
        $this->Lastname = $promodiser->Lastname;
        $this->Mobilenumber = $promodiser->Mobilenumber;
        $this->Location_code = $promodiser->Location_code;

        $this->dispatchBrowserEvent('show-edit-promodiser-modal');
    }    

    public function editPromodiserData()
    {
        //on-form submit validation
        $this->validate([
         'promodiser_id'=> 'required|unique:promodisers,promodiser_id,'.$this->promodiser_edit_id.'',   
         'Firstname'=> 'required|max:255',
         'Lastname'=> 'required|max:255',
         'Mobilenumber'=> 'required|numeric',   
         'Location_code' => 'required|numeric',
        ]);

       $promodiser = Promodisers::where('id',$this->promodiser_edit_id)->first(); 
       $promodiser->promodiser_id = $this->promodiser_id;
       $promodiser->Firstname =$this->Firstname;
       $promodiser->Lastname =$this->Lastname;
       $promodiser->Mobilenumber =$this->Mobilenumber;
       $promodiser->Location_code = $this->Location_code;

       $promodiser->save();

       session()->flash('message', 'Promodiser gas been updated successfully');

       //For hide modal after add promodiser success
       $this->dispatchBrowserEvent('close-modal');
    } 

    //Delete Confirmation
    public function deleteConfirmation($id)
    {
        $this->promodiser_delete_id = $id;

        $this->dispatchBrowserEvent('show-delete-confirmation-modal');
    }

    public function deletePromodiserData()
    {
        $promodiser = Promodisers::where('id', $this->promodiser_delete_id)->first();
        $promodiser->delete();
        
        
        session()->flash('message','Promodiser has been deleted successfully');

        $this->dispatchBrowserEvent('close-modal');

        $this->promodiser_delete_id = '';
    }

    public function cancel()
    {
        $this->promodiser_delete_id ='';
    }

    public function viewPromodiserDetails($id)
    {
        $promodiser = Promodisers::where('id', $id)->first();

        $this->view_promodiser_id = $promodiser->promodiser_id;
        $this->view_promodiser_Firstname = $promodiser->Firstname;
        $this->view_promodiser_Lastname = $promodiser->Lastname;
        $this->view_promodiser_Mobilenumber = $promodiser->Mobilenumber;
        $this->view_promodiser_Location_code = $promodiser->Location_code;

        $this->dispatchBrowserEvent('show-view-promodiser-modal');
    }

    public function closeViewPromodiserModal()
    {
      $this->view_promodiser_id = '';
      $this->view_promodiser_Firstname = '';
      $this->view_promodiser_Lastname = '';
      $this->view_promodiser_Mobilenumber = '';
      $this->view_promodiser_Location_code = '';
    }


    public function render()
    {
        //Get all students
       $promodisers = Promodisers::where('Firstname','like', '%'.$this->searchTerm.'%')->orwhere('Lastname', 'like','%' .$this->searchTerm.'%')
       ->orwhere('Mobilenumber','like', '%' .$this->searchTerm.'%')->orwhere('promodiser_id','like', '%'.$this->searchTerm.'%')->orwhere('Location_code','like', '%' .$this->searchTerm.'%')->get(); 

        return view('livewire.promodisers-component', ['promodisers'=>$promodisers])->layout('Livewire.layouts.base');
    }
}


