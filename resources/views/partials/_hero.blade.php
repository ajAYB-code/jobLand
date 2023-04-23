

<section class="hero mt">
    <div class="container hero-inner py-2 position-relative">
        <div class="hero-inner-content w-100 position-absolute start-0">
            <h3 class="hero-leader text-white ms-5 fs-2 mb-3 text-capitalize">Find your dream job without <span style="color: var(--color-primary);">hassle</span></h3>
            <div class="search-container">
             <form action="">
                <div class="row align-items-center mx-4 rounded-pill bg-white py-3 pe-3">
                     <div class="col-3">
                         <div class="input-group">
                            <span for="" class="input-group-text bg-transparent border-0">
                             <i class="fa fa-search-location"></i>
                            </span>
                             <input type="text" name="location" value="{{request()->location}}" id="" class="form-control form-control-plaintext shadow-none border-0 rounded-0" placeholder="Location: United states.."> 
                         </div>
                     </div>
                     <div class="col-6">
                         <div class="input-group">
                            <span for="" class="input-group-text bg-transparent border-0">
                             <i class="fa fa-search"></i>
                            </span>
                             <input type="text" name="search_for"  value="{{request()->search_for}}" id="" class="form-control form-control-plaintext shadow-none border-0 rounded-0" placeholder="Title: Junior laravel developer.."> 
                         </div>
                     </div>
                     <div class="col-3 text-end">
                         <x-primary-button class="find-job-btn btn-lg rounded-pill">
                             <x-slot name='content'>
                                 Find job
                             </x-slot>
                         </x-primary-button>
                     </div>
                 </div>
             </form>
            </div>
        </div>
    </div>
</section>