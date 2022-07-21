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

    protected $queryString = [
        'searchTerm' => ['as' => 'q'],
        'sortBy', 
        'sortDirection'
    ];

    /**
     * Query Strings
     */
    public $sortBy = 'ID';
    public $sortDirection = 'ASC';

    public $promodiser_id, $Firstname, $Lastname, $Mobilenumber,$Location_code, $promodiser_edit_id, $promodiser_delete_id;
    public $view_promodiser_id, $view_promodiser_Firstname, $view_promodiser_Lastname, $view_promodiser_Mobilenumber, $view_promodiser_Location_code;
    public $searchTerm; 
    
    public $selectedPromodiser;
    public $assigned_location; // Used for assigning promodiser's location

    public $locations = [];
    public $selectedPromodiserLocationCode = '';

    /**
     * Modal Variables
     */
    public $showPromodiserImport = false;
    public $showPromodiserEdit = false;
    public $showPromodiserAssign = false;
    public $showPromodiserCreate = false;
    public $confirmingUserDeletion = false;

    protected $listeners = [
        'tempDataUploaded' => 'render'
    ];

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

    /**
     * Show Create Promodiser Modal
     *
     * @return void
     */
    public function createPromodiser()
    {
        $this->showPromodiserCreate = true;
    }

    /**
     * Create new promodiser
     *
     * @return void
     */
    public function storePromodiserData() 
    {
        try {
            $this->validate([
                'Firstname'=> 'required|max:255',
                'Lastname'=> 'required|max:255',
                'Mobilenumber'=> 'required|numeric',
            ]); 

            //Add Promodiser Data

            DB::beginTransaction();

            $promodiser = new Promodisers();
            $promodiser->Firstname = $this->Firstname;
            $promodiser->Lastname = $this->Lastname;
            $promodiser->Mobilenumber = $this->Mobilenumber;
            
            $promodiser->save();

            DB::commit();
            
            session()->flash('flash.banner','New Promo merchandiser has been added successfully');
            session()->flash('flash.bannerStyle', 'success');

            $this->reset();
            $this->resetValidation();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function cancelAdd ()
    {
        $this->showPromodiserCreate = false;
    }
    /**
     * Edit Promodiser Data
     *
     * @param $id
     * @return void
     */
    public function editPromodiser($id)
    {
        $this->showPromodiserEdit = true;

        $promodiser = Promodisers::findOrFail($id);

        $this->promodiser_id = $promodiser->id;
        $this->Firstname = $promodiser->Firstname;
        $this->Lastname = $promodiser->Lastname;
        $this->Mobilenumber = $promodiser->Mobilenumber;
    }    

    /**
     * Submit edit for promodiser
     *
     * @return void
     */
    public function editPromodiserData()
    {
        try {
            $this->validate([  
                'promodiser_id' => ['required'] ,
                'Firstname'=> ['required', 'max:191'],
                'Lastname'=> ['required', 'max:191'],
                'Mobilenumber'=> ['required', 'numeric']
            ]);

            $promodiser = Promodisers::where('id',$this->promodiser_id)->firstOrFail(); 
            
            // dd($promodiser);
            
            $promodiser->Firstname = $this->Firstname;
            $promodiser->Lastname = $this->Lastname;
            $promodiser->Mobilenumber = $this->Mobilenumber;
            $promodiser->save();

            $this->showPromodiserEdit = false;

            session()->flash('flash.banner', 'Saved.');
            session()->flash('flash.bannerStyle', 'success');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Cancel Edit
     *
     * @return void
     */
    public function cancelEdit()
    {
        $this->showPromodiserEdit = false;

        $this->reset();
    }

    /**
     * Confirm Deletion of Promodiser
     *
     * @param $id
     * @return void
     */
    public function deleteConfirmation($id)
    {
        $this->confirmingUserDeletion = true;
        $this->promodiser_delete_id = $id;
    }

    /**
     * Initiate deletion of Promodiser
     *
     * @return void
     */
    public function confirmDelete()
    {
        $promodiser = Promodisers::where('id', $this->promodiser_delete_id)->first();
        // $promodiser->assignments()->delete();
        $promodiser->delete();
        
        
        session()->flash('message','Promodiser has been deleted successfully');

        $this->reset();
        $this->resetValidation();
    }

    /**
     * Cancel Deletion modal
     *
     * @return void
     */
    public function cancelDelete()
    {
        $this->confirmingUserDeletion = false;
        $this->promodiser_delete_id = null;
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

    /**
     * Show Assign Promodiser Modal
     *
     * @param $id
     * @return void
     */
    public function assignPromodiser($id)
    {
        $this->showPromodiserAssign = true;

        $promodiser = Promodisers::with('latest_assignment.location')->find($id);

        $this->locations = LocationCode::get()->pluck('LocationCode', 'id');

        $this->selectedPromodiserLocationCode = $promodiser && $promodiser->latest_assignment ? $promodiser->latest_assignment->location->LocationCode : 'none';

        $this->selectedPromodiser = $promodiser;
    }

    /**
     * Assign Promodiser to a Store
     *
     * @param [type] $id
     * @return void
     */
    public function assignPromodiserData()
    {
        $this->validate([
            'assigned_location' => ['required']
        ]);

        $location = LocationCode::find($this->assigned_location);

        try {
            DB::beginTransaction();

            $promodiserAssignment = $this->selectedPromodiser->assignments()->create([
                'location_codes_id' => $location->id
            ]);

            // $promodiserAssignment = PromodiserAssignation::create([
            //     'promodisers_id' => Promodisers::find($id)->id,
            //     'location_codes_id' => $location->id
            // ]);

            DB::commit();

            $this->showPromodiserAssign = false;

            $this->reset();

            session()->flash('flash.banner', 'Promodiser assigned succesfully!');
            session()->flash('flash.bannerStyle', 'success');

        } catch (\Exception $e) {
            DB::rollback();

            dd($e->getMessage());
            return $this->addError('assigned_location', 'Something went wrong.');
        }
    }

    public function cancelAssign()
    {
        $this->reset();
        $this->resetValidation();

        $this->showPromodiserAssign = false;
    }

    public function setSort($query, $direction)
    {
        $this->sortBy = $query;
        $this->sortDirection = $direction;

        // dd(Promodisers::with('latest_assignment')->first());
    }

    public function render()
    {
        $promodisers = Promodisers::with('latest_assignment.location')
            ->where('Firstname','like', '%'.$this->searchTerm.'%')
            ->orWhere('Lastname', 'like','%' .$this->searchTerm.'%')
            ->orWhere('Mobilenumber','like', '%' .$this->searchTerm.'%');

        if($this->sortBy === 'LocationCode') {
            $promodisers = $promodisers->select('promodisers.*')
                ->leftJoin('promodiser_assignations', 'promodiser_assignations.promodisers_id', '=', 'promodisers.id')
                ->whereNull('promodiser_assignations.promodisers_id')
                ->orderBy('promodiser_assignations.promodisers_id', $this->sortDirection);
        } else {
            $promodisers = $promodisers->orderBy($this->sortBy, $this->sortDirection);
        }

        $promodisers = $promodisers->paginate(4);

        return view('livewire.promodisers-component', compact('promodisers'))
            ->layout('livewire.layouts.base');
    }
}




