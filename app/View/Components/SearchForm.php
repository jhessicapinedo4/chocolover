<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchForm extends Component
{
  public $action;
  public $searchValue;
  public $showAddButton;
  public $addButtonRoute;
  public $fieldName;

  // El constructor acepta parámetros
  public function __construct($action, $searchValue = null, $showAddButton = false, $addButtonRoute = null, $fieldName = 'search')
  {
    $this->action = $action;
    $this->searchValue = $searchValue;
    $this->showAddButton = $showAddButton;
    $this->addButtonRoute = $addButtonRoute;
    $this->fieldName = $fieldName; // Nombre del campo de búsqueda
  }

  public function render()
  {
    return view('components.search-form');
  }
}
