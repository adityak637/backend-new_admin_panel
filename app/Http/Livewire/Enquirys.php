<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Enquiry;
use Livewire\WithPagination;

class Enquirys extends Component
{
    use WithPagination;
    

   protected $paginationTheme = 'bootstrap';

   public $searchTerm;

    public function render()
    {
         $searchTerm = '%'.$this->searchTerm.'%';
        $Enquiry=Enquiry::with('user','trip')->where('title','LIKE',$searchTerm)->orWhere('query', 'like', $searchTerm)->paginate(5);
        return view('livewire.enquirys',[
            'Enquiry'=>$Enquiry
        ]);
    }
}