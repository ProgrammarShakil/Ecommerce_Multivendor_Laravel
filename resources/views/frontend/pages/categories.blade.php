@extends('frontend.layouts.app')

@section('frontend_content')
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Just Arrived</span></h2>

            <div class="row px-xl-5 pb-3">
                @if ($category->products->count() == 0)
                    <div>No Products in this Category.</div>
                @else
                    @foreach ($category->products as $product)
                        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div
                                    class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    @if ($product->product_image_path == "default.jpg")
                                    <img class="img-fluid w-100" src="{{ asset('uploads/products/images/default.jpg') }}"
                                        width="50px">
                                @else
                                    <img class="img-fluid w-100" src="{{ asset('uploads/products/images/' . $product->product_image_path) }}"
                                        width="50px">
                                @endif
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3"> {{ $product->title }}</h6>
                                    <div class="d-flex justify-content-center">
                                        <h6>$123.00</h6>
                                        <h6 class="text-muted ml-2"><del>$123.00</del></h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="" class="btn btn-sm text-dark p-0"><i
                                            class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                    <a href="" class="btn btn-sm text-dark p-0"><i
                                            class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>

    </div>
@endsection
