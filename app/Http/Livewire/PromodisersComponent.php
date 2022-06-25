<?php

namespace App\Http\Livewire;

use Livewire\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Promodisers;
use App\Models\LocationCode;
use App\Models\PromodiserAssignation;
use Illuminate\Support\Facades\DB;

class PromodisersComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $promodiser_id, $Firstname, $Lastname, $Mobilenumber,$Location_code, $promodiser_edit_id, $promodiser_delete_id;
    public $view_promodiser_id, $view_promodiser_Firstname, $view_promodiser_Lastname, $view_promodiser_Mobilenumber, $view_promodiser_Location_code;
    public $searchTerm; 
    
    public $selectedPromodiser;
    public $assigned_location; // Used for assigning promodiser's location

    //Input fields on update validation
    public function updated($fields)
    {
        $this->validateOnly($fields, [
           'promodiser_id' => 'required|unique:promodisers,promodiser_id,' .$this->promodiser_edit_id.'', 
            'Firstname'=> 'required|max:255',
            'Lastname'=> 'required|max:255',
            'Mobilenumber'=> 'required|numeric',
            // 'Location_code' => 'required|numeric',
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
       ]); 
    

    //Add Promodiser Data
    $promodiser =new Promodisers();
    $promodiser->promodiser_id = $this->promodiser_id;
    $promodiser->Firstname = $this->Firstname;
    $promodiser->Lastname = $this->Lastname;
    $promodiser->Mobilenumber = $this->Mobilenumber;
    
     
    $promodiser->save();
     
    session()->flash('message','New Promo merchandiser has been added successfully');

    $this->promodiser_id ='';
    $this->Firstname ='';
    $this->Lastname ='';
    $this->Mobilenumber ='';
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
        ]);

       $promodiser = Promodisers::where('id',$this->promodiser_edit_id)->first(); 
       $promodiser->promodiser_id = $this->promodiser_id;
       $promodiser->Firstname =$this->Firstname;
       $promodiser->Lastname =$this->Lastname;
       $promodiser->Mobilenumber =$this->Mobilenumber;

       $promodiser->save();

       session()->flash('message', 'Promodiser has been updated successfully');

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
        $promodiser = Promodisers::with('latest_assignment.location')
            ->find($id);

        $this->selectedPromodiser = $promodiser;

        $this->dispatchBrowserEvent('show-view-promodiser-modal');
    }

    public function closeViewPromodiserModal()
    {
      $this->view_promodiser_id = '';
      $this->view_promodiser_Firstname = '';
      $this->view_promodiser_Lastname = '';
      $this->view_promodiser_Mobilenumber = '';
     
    }

    public function showAssignPromodiser($id)
    {
        $promodiser = Promodisers::with('latest_assignment.location')->find($id);

        // dd($promodiser->latest_assignment->location->LocationCode);

        $this->selectedPromodiser = $promodiser;

        $this->dispatchBrowserEvent('assign-promodiser-modal');
    }

    public function assignPromodiser($id)
    {
        // Reset values
        $this->resetValidation();

        $location = LocationCode::where('LocationCode', $this->assigned_location)->first();

        $this->assigned_location = null;

        if(!$location) {
            return $this->addError('assigned_location', 'The location code is invalid.');
        }

        try {
            DB::beginTransaction();

            $promodiserAssignment = PromodiserAssignation::create([
                'promodisers_id' => Promodisers::find($id)->id,
                'location_codes_id' => $location->id
            ]);

            DB::commit();

            $this->dispatchBrowserEvent('hide-assign-promodiser-modal');
            $this->selectedPromodiser = null;
        } catch (\Exception $e) {
            DB::rollback();

            dd($e->getMessage());
            return $this->addError('assigned_location', 'Something went wrong.');
        }
    }


    public function render()
    {
        //Get all students
       $promodisers = Promodisers::where('Firstname','like', '%'.$this->searchTerm.'%')
            ->orWhere('Lastname', 'like','%' .$this->searchTerm.'%')
            ->orWhere('Mobilenumber','like', '%' .$this->searchTerm.'%')
            ->orWhere('promodiser_id','like', '%'.$this->searchTerm.'%')
            // ->orWhere('Location_code','like', '%' .$this->searchTerm.'%')
            ->paginate(2); 

        return view('livewire.promodisers-component', compact('promodisers'))
            ->layout('livewire.layouts.base');
    }
}


