                        <div class="topheading d-flex justify-content-between">
                            <h1>{{ucfirst($category->category_name)}} <span>{{$productCount}} PRODUCTS</span></h1>
                            <input type="hidden" name="category_id" value="{{$category->id}}">
                            <input type="hidden" name="category_type" value="{{$category_type}}">
                            <div class="sortby">
                                <select id="sortby">
                                    <option value="">Sort By</option>
                                    <option  value="low_to_high">Low to High</option>
                                    <option value="high_to_low">High to Low</option>
                                    <option value="new_arrivals">New Arrivals</option>
                                    <option value="popularity">Popularity</option>
                                </select>
                            </div>
                        </div>