

<section class="hero mt">
    <div class="container hero-inner">
       <h3 class="hero-leader text-white ms-4 mb-3 text-capitalize">Find your dream job without hassle</h3>
       <div class="search-container">
        <form action="">
           <div class="row align-items-center mx-4 rounded-pill bg-white py-3 pe-3">
                <div class="col-3">
                    <div class="input-group">
                       <span for="" class="input-group-text bg-transparent border-0">
                        <i class="fa fa-search-location"></i>
                       </span>
                        <input type="text" name="location" value="{{request()->location}}" id="" class="form-control form-control-plaintext rounded-0" placeholder="Location: United states.."> 
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group">
                       <span for="" class="input-group-text bg-transparent border-0">
                        <i class="fa fa-search"></i>
                       </span>
                        <input type="text" name="search_for"  value="{{request()->search_for}}" id="" class="form-control form-control-plaintext rounded-0" placeholder="Title: Junior laravel developer.."> 
                    </div>
                </div>
                <div class="col-3">
                    <button class="find-job-btn btn btn-lg ms-auto d-block rounded-pill">Find job</button>
                </div>
            </div>
        </form>
       </div>
    </div>
</section>