<div class="wg-box">
    <div class="flex items-center justify-between gap10 flex-wrap">
        <div class="wg-filter flex-grow">
            <form class="form-search" method="GET" action="{{ $action }}">
                <fieldset class="name">
                    <input type="text" placeholder="Search here..." class="" name="{{ $fieldName }}" 
                           value="{{ request($fieldName) }}" tabindex="2" aria-required="true">
                </fieldset>
                <div class="button-submit">
                    <button class="" type="submit"><i class="icon-search"></i></button>
                </div>
            </form>
        </div>

        @if($showAddButton)
            <a class="tf-button style-1 w208" href="{{ $addButtonRoute }}">
                <i class="icon-plus"></i> Agregar nuevo
            </a>
        @endif
    </div>
</div>
