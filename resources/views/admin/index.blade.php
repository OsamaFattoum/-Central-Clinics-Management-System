@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
				Empty</span>
		</div>
	</div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row row-sm">

    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <a href="{{route('product.index')}}">
            <div class="card bg-primary-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fa fa-box projec mx-auto text-white tx-40 "></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">PRODUCTS</span>
                                <h2 class="text-white mb-0">{{$products}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </a>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <a href="{{route('invoice.index')}}">
            <div class="card bg-danger-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fa fa-receipt projec mx-auto text-white tx-40 "></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">INVOICES</span>
                                <h2 class="text-white mb-0">{{$invoices}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </a>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <a href="{{route('invoice.index',['type'=>2])}}">
            <div class="card bg-success-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fa fa-university projec mx-auto text-white tx-40 "></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">PAID INVOICE</span>
                                <h2 class="text-white mb-0">{{$invoices_paid}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </a>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <a href="{{route('invoice.index',['type'=>1])}}">
            <div class="card bg-warning-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fa fa-money-bill projec mx-auto text-white tx-40 "></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">UNPAID INVOICE</span>
                                <h2 class="text-white mb-0">{{$invoices_unpaid}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </a>
    </div>

</div>

<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection