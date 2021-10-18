<div class="col-lg-3 col-md-4">
    <div class="filter-part">
        <h2 class="d-flex align-items-center justify-content-between">Filters <a href="#">Clear
                All</a></h2>
        <div id="accordion" class="mt-4">
            <div class="card">
                <div class="card-header" id="headingTwo" data-toggle="collapse"
                    data-target="#collapseTwo" aria-controls="collapseTwo">
                    Category
                </div>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                    data-parent="#accordion">
                    <div class="card-body">
                        @php $subcategories = App\Model\Admin\Category::where(['category_type' => 'sub_category','status'=>'1'])->get(); @endphp
                        @forelse($subcategories as $subcat)
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input filtercategory" name="filtercategory[]" value="{{$subcat->id}}">
                            <label class="form-check-label" for="daywear" >{{$subcat->category_name}}</label>
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree" data-toggle="collapse"
                    data-target="#collapseThree" aria-controls="collapseThree">
                    Price Filter
                </div>

                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                    data-parent="#accordion">
                    <div class="card-body">
                        <div class="form-group form-check">
                            <input type="radio" name="filterprice" class="form-check-input filterprice" value="under_500">
                            <label class="form-check-label" >Rs. 499 to Rs. 500</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="radio" name="filterprice" class="form-check-input filterprice" value="between_501_to_1000">
                            <label class="form-check-label" >Rs. 501 to Rs. 1000</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="radio" name="filterprice" class="form-check-input filterprice" value="between_1001_to_1500">
                            <label class="form-check-label" >Rs. 1001 to Rs. 1500</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="radio" name="filterprice" class="form-check-input filterprice" value="between_1501_to_2000">
                            <label class="form-check-label" >Rs. 1501 to Rs. 2000</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="radio" name="filterprice" class="form-check-input filterprice" value="above_2000">
                            <label class="form-check-label" >Above Rs. 2001</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>