@extends('theme.default.website')

@section('content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ url('') }}">{{ _lang('Home') }}<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="">{{ _lang('Order Details') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Checkout -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (\Session::has('success'))
                        <div class="alert alert-success mt-4">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <span>{!! xss_clean(session('success')) !!}</span>
                        </div>
                    @endif

                    @if (\Session::has('error'))
                        <div class="alert alert-danger mt-4">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <span>{!! xss_clean(session('error')) !!}</span>
                        </div>
                    @endif
                </div>

                <div class="col-lg-12">

                    <div class="receipt-content" id="customer-invoice">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="invoice-wrapper">

                                        @if ($order->getPaymentStatus(false) == 1)
                                            <div class="payment-info">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <span>{{ _lang('Order ID') }}: <b>{{ $order->id }}</b></span><br>
                                                        <span>{{ _lang('Order Date') }}:
                                                            <b>{{ $order->created_at }}</b></span><br>
                                                        <span>{{ _lang('Status') }}:
                                                            <b>{!! xss_clean($order->getStatus()) !!}</b></span><br>

                                                        <span><u>{{ _lang('Transaction ID') }}</u></span>
                                                        <strong>{{ $order->transaction->transaction_id }}</strong>
                                                    </div>
                                                    <div class="col-lg-6 text-right">
                                                        <span>{{ _lang('Payment Method') }}</span>
                                                        <strong>{{ $order->payment_method }}</strong>

                                                        <span>{{ _lang('Payment Date') }}</span>
                                                        <strong>{{ $order->transaction->created_at }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="payment-info">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <span>{{ _lang('Order ID') }}:
                                                            <b>{{ $order->id }}</b></span><br>
                                                        <span>{{ _lang('Order Date') }}:
                                                            <b>{{ $order->created_at }}</b></span><br>
                                                        <span>{{ _lang('Status') }}:
                                                            <b>{!! xss_clean($order->getStatus()) !!}</b></span><br>
                                                    </div>
                                                    <div class="col-lg-6 text-right-print">
                                                        <span>{{ _lang('Payment Status') }}</span>
                                                        <strong>{!! xss_clean($order->getPaymentStatus()) !!}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="payment-details">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <span>{{ _lang('Customer Details') }}</span>
                                                    <strong>
                                                        {{ $order->customer_name }}
                                                    </strong>
                                                    <p>
                                                        {{ $order->customer_email }}<br>
                                                        {{ $order->customer_phone }}<br>
                                                        {{ $order->billing_address }}<br>
                                                        {{ $order->billing_state }}<br>
                                                        {{ $order->billing_city }}, {{ $order->billing_post_code }} <br>
                                                        {{ $order->billing_country }}
                                                    </p>
                                                </div>

                                                <div class="col-lg-4">
                                                    <span>{{ _lang('Shipping Address') }}</span>
                                                    <p>
                                                        {{ $order->shipping_address }}<br>
                                                        {{ $order->shipping_state }}<br>
                                                        {{ $order->shipping_city }}, {{ $order->shipping_post_code }} <br>
                                                        {{ $order->shipping_country }}
                                                    </p>
                                                </div>

                                                <div class="col-lg-4 text-right-print">
                                                    <span>{{ _lang('Payment To') }}</span>
                                                    <strong>
                                                        {{ get_option('company_name') }}
                                                    </strong>
                                                    <p>
                                                        {{ get_option('email') }}<br>
                                                        {{ get_option('phone') }}<br>
                                                        {!! xss_clean(get_option('address')) !!} <br>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="line-items">
                                            {{-- <div class="headers clearfix">
                                                <div class="row">
                                                    <div class="col-lg-4">{{ _lang('Description') }}</div>
                                                    <div class="col-lg-3 text-right">{{ _lang('Unit Price') }}</div>
                                                    <div class="col-lg-2">{{ _lang('Quantity') }}</div>
                                                    <div class="col-lg-3 text-right">{{ _lang('Amount') }}</div>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="items">

                                                @foreach ($order->products as $product)
                                                    <div class="row item">
                                                        <div class="col-lg-4 desc">
                                                            {{ $product->product->translation->name }}
                                                        </div>
                                                        <div class="col-lg-3 unit_price">
                                                            {{ $product->unit_price }}
                                                        </div>
                                                        <div class="col-lg-2 qty">
                                                            {{ $product->qty }}
                                                        </div>
                                                        <div class="col-lg-3 amount">
                                                            {{ $product->line_total }}
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div> --}}
                                              {{-- <div class="container"> --}}
                                                <h2>My Order</h2>
                                                <table class="d-block table table-responsive">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Product Image</th>
                                                            <th scope="col">Product name</th>
                                                            <th scope="col">Unit Price</th>
                                                            <th scope="col">Shoe Size</th>
                                                            <th scope="col">Quantity</th>
                                                            <th scope="col">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order->products as $product)
                                                            <tr>
                                                                <th scope="row">
                                                                    {{ $loop->index + 1 }}
                                                                </th>
                                                                <td>
                                                                    <img src="{{ asset('storage/app/' . $product->image) }}"
                                                                        style="width: 50px;height:50px;" class="me-4 border"
                                                                        alt="NO PAYMENT MADE" />
                                                                </td>
                                                                <td>{{ $product->product->translation->name }}</td>
                                                                <td> {{ $product->unit_price }}</td>
                                                                <td>{{ $product->product_attributes }}</td>
                                                                <td> {{ $product->qty }}</td>
                                                                <td> {{ $product->line_total }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                        {{-- </div> --}}

                                            <div class="total text-right">
                                                @if ($order->note != '')
                                                    <p class="extra-notes">
                                                        <strong>{{ _lang('Extra Notes') }}</strong>
                                                        {{ $order->note }}
                                                    </p>
                                                @endif
                                                <div class="field">
                                                    {{ _lang('Shipping fee') }}
                                                    <span>+{!! xss_clean(decimalPlace($order->shipping_cost)) !!}</span>
                                                </div>

                                                <div class="field">
                                                    {{ _lang('Discount') }} <span>-{!! xss_clean(decimalPlace($order->discount)) !!}</span>

                                                </div>

                                                @foreach ($order->taxes as $tax)
                                                    <div class="field">
                                                        {{ $tax->translation->name }}<span>+{!! xss_clean(decimalPlace($tax->order_tax->amount)) !!}</span>
                                                    </div>
                                                @endforeach

                                                <div class="field grand-total">
                                                    {{ _lang('Total') }} <span>{!! xss_clean(decimalPlace($order->total)) !!}</span>
                                                </div>
                                            </div>
											</a>
                                            
                                        </div>






                                         {{-- <div class="container"> 
                                            <h2>Orders</h2>
                                                <table class="table table-responsive">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Product Image</th>
                                                            <th scope="col">Product name</th>
                                                            <th scope="col">Unit Price</th>
                                                            <th scope="col">Shoe Size</th>
                                                            <th scope="col">Quantity</th>
                                                            <th scope="col">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order->products as $product)
                                                            <tr>
                                                                <th scope="row">
                                                                    {{ $loop->index + 1 }}
                                                                </th>
                                                                <td>
                                                                    <img src="{{ asset('storage/app/' . $product->image) }}"
                                                                        style="width: 50px;height:50px;" class="me-4 border"
                                                                        alt="NO PAYMENT MADE" />
                                                                </td>
                                                                <td>{{ $product->product->translation->name }}</td>
                                                                <td> {{ $product->unit_price }}</td>
                                                                <td>{{ $product->product_attributes }}</td>
                                                                <td> {{ $product->qty }}</td>
                                                                <td> {{ $product->line_total }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                         </div>  --}}







                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End col-lg-12-->

            </div>
        </div>
    </section>
@endsection
