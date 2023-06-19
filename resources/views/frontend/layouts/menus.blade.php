<div class="mobileNav d-sm-none">
 <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
  <i class="bi bi-list"></i>
 </a>

 <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
   <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
   <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
   <div class="mobileMenus">
    @empty(!CustomHelper::NaveMenu('main',[]))
    {!! CustomHelper::NaveMenu('main',['menuClass'=>'mobileMenusUl list-unstyled m-0 p-0','listClass'=>'nav-item','linkClass'=>'nav-link px-2', 'listParentClass'=>'dropdown','subMenuClass'=>'dropdown-menu','listParentLinkClass'=>'dropdown-toggle']) !!}
    @endempty
   </div>
  </div>
 </div>
</div>