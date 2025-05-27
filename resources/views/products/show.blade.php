
<div class="modal-header">
    <h5 class="modal-title fs-2">Product Details : {{ $productInfo->product_name }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Column Name</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Category</td>
                        <td>{{ $productInfo->category_id ? $productInfo->category->name : 'No Category Found' }}</td>
                    </tr>
                   
                    <tr>
                        <td>Product Name</td>
                        <td>{{ $productInfo->product_name }}</td>
                    </tr>
                    
                    <tr>
                        <td>Product Image</td>
                        <td>
                                  @if($productInfo->product_image)
                                        <div class="col-md-12 text-center my-3">
                                            <strong>Product Image:</strong><br>
                                            <img src="{{ asset('storage/products/' . $productInfo->product_image) }}" alt="Product Image" style="max-width: 300px; height: auto; border-radius: 5px;">
                                        </div>
                                  @endif

        
                        </td>
                    </tr>

                    <tr>
                        <td>Product short description</td>
                        <td>{{ $productInfo->product_short_description }}</td>
                    </tr>

                    <tr>
                        <td>Product long description</td>
                        <td>{{ $productInfo->product_long_description }}</td>
                    </tr>

                    <tr>
                        <td>Product Price</td>
                        <td>{{ $productInfo->product_price }}</td>
                    </tr>

                    <tr>
                        <td>Product review star</td>
                        <td>{{ $productInfo->product_review_star }}</td>
                    </tr>
                 
                   
                 
                   
                </tbody>
            </table>
        </div>
    </div>        
</div>

<div class="modal-footer d-flex justify-content-between align-items-center">
    <small>Created At: {{ $productInfo->created_at->format('d M, Y h:i A') }}</small>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

