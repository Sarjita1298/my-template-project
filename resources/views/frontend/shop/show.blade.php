<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div 
        class="modal-dialog modal-xl modal-dialog-scrollable" 
        style="max-width: 100vw; margin: 1rem auto; border: 3px solid #0a2c4e; border-radius: 12px; box-shadow: 0 0 12px rgba(13, 110, 253, 0.5);"
    >
        <div 
            class="modal-content" 
            style="border: 2px solid  #0a2c4e; border-radius: 10px;"
        >
            
            <!-- Modal Header -->
            <div 
                class="modal-header" 
                style="background-color: #0a2c4e; color: white; border-bottom: 3px solid #0a2c4e; border-top-left-radius: 10px; border-top-right-radius: 10px;"
            >
                <h3 class="modal-title fs-1">{{ 'Product Details : ' . $productInfo->product_name }}</h5>
                <button 
                    type="button" 
                    class="btn-close btn-close-white" 
                    data-bs-dismiss="modal" 
                    aria-label="Close"
                ></button>
            </div>

            <!-- Modal Body -->
            <div 
                class="modal-body" 
                style="max-height: 80vh; overflow-y: auto; padding: 1rem; border-bottom: 3px solid  #0a2c4e;"
            >
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-hover table-striped table-sm">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th style="width: 30%;" class="ot-btn btn-main-color">Column Name</th>
                                    <th style="width: 70%;" class="ot-btn btn-main-color">Value</th>
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
                                    <td class="text-center ot-btn btn-main-color">
                                        @if($productInfo->product_image)
                                            <img 
                                                src="{{ asset('storage/products/' . $productInfo->product_image) }}" 
                                                alt="Product Image" 
                                                style="max-width: 100%; height: auto; border-radius: 8px; max-height: 300px;" 
                                                class="img-fluid my-2 shadow-sm"
                                            >
                                        @else
                                            <span>No Image Available</span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td>Product Short Description</td>
                                    <td>{{ $productInfo->product_short_description }}</td>
                                </tr>

                                <tr>
                                    <td>Product Long Description</td>
                                    <td>{{ $productInfo->product_long_description }}</td>
                                </tr>

                                <tr>
                                    <td>Product Price</td>
                                    <td>₹{{ number_format($productInfo->product_price, 2) }}</td>
                                </tr>

                                <tr>
                                    <td>Product Review Star</td>
                                    <td>{{ $productInfo->product_review_star }} / 5</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>        
            </div>

            <!-- Modal Footer -->
            <div 
                class="modal-footer d-flex justify-content-between align-items-center" 
                style="background-color: #ffb600; border-top: 3px solid  #0a2c4e; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;"
            >
                <small class="text-muted">Created At: {{ $productInfo->created_at->format('d M, Y h:i A') }}</small>
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
