@extends('system-mgmt.tool-order.base')
@section('action-content')
    <section class="content">
        <div class="row">
                <div class="col-sm-12">

                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                          <!-- title row -->
                          <div class="row">
                            <div class="col-12">
                              <h4>
                                <i class="fa fa-globe"></i> Total Wealth Solution (Thailand) CO.,LTD.

                                <small class="float-right">Date: 2/10/2018</small>
                              </h4>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- info row -->
                          <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                              From
                              <address>
                                <strong>Total Wealth Solution (Thailand) CO.,LTD.</strong><br>
                                ชั้น 5 อาคาร ชาร์เตอร์เฮาส์ เลขที่ 23, ซอย ลาดพร้าว 124<br>
                                แขวง พลับพลา เขต วังทองหลาง กรุงเทพมหานคร 10310<br>
                                Phone: 02-539-2798 <br>
                                Email: admin@n-tech.co.th
                              </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                              To
                              <address>
                                <strong>{{$data->Person->name}} {{$data->Person->lname}}</strong><br>
                                Phone: {{$data->Person->mobile}}<br>
                                Email: {{$data->Person->email}}
                              </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                              <b>Invoice #{{$data->invoice_number}}</b><br>
                              <br>
                              <b>Order ID:</b> 4F3S8J<br>
                              <b>Payment Due:</b> 2/22/2014<br>
                              <b>Account:</b> 968-34567
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <!-- Table row -->
                          <div class="row">
                            <div class="col-12 table-responsive">
                              <table class="table table-striped">
                                <thead>
                                <tr>
                                  <th>Qty</th>
                                  <th>Product</th>
                                  <th>Serial #</th>
                                  <th>Description</th>
                                  <th>Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                  <td>1</td>
                                  <td>{{$data->ToolSet->Tool->name}}</td>
                                  <td>455-981-221</td>
                                  <td>El snort testosterone trophy driving gloves handsome</td>
                                  <td>฿64.50</td>
                                </tr>

                                </tbody>
                              </table>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                              <p class="lead">Payment Methods:</p>
                              <img src="https://adminlte.io/themes/dev/AdminLTE/dist/img/credit/visa.png" alt="Visa">
                              <img src="https://adminlte.io/themes/dev/AdminLTE/dist/img/credit/mastercard.png" alt="Mastercard">
                              <img src="https://adminlte.io/themes/dev/AdminLTE/dist/img/credit/american-express.png" alt="American Express">
                              <img src="https://adminlte.io/themes/dev/AdminLTE/dist/img/credit/paypal2.png" alt="Paypal">
                              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                                plugg
                                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                              </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                              <p class="lead">Amount Due 2/22/2014</p>

                              <div class="table-responsive">
                                <table class="table">
                                  <tbody><tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td>฿250.30</td>
                                  </tr>
                                  <tr>
                                    <th>Vat (7%)</th>
                                    <td>฿10.34</td>
                                  </tr>
                                  <tr>
                                    <th>Shipping:</th>
                                    <td>฿5.80</td>
                                  </tr>
                                  <tr>
                                    <th>Total:</th>
                                    <td>฿265.24</td>
                                  </tr>
                                </tbody></table>
                              </div>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <!-- this row will not appear when printing -->
                          <div class="row no-print">
                            <div class="col-12">

                              <a href="" onclick="myFunction()" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                              <a href="" onclick="myFunction()" target="_blank" class="btn btn-default"><i class="fa fa-envelope-o"></i> Sent To Member</a>
                            {{--}}  <button type="button" class="btn btn-success float-right">
                                  <i class="fa fa-credit-card"></i>
                                  Submit Payment
                              </button>--}}

                            {{--}}  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fa fa-download"></i> Generate PDF
                              </button>--}}

                            </div>
                          </div>

                        </div>
                        <!-- /.invoice -->
                      </div>


        </div>
</section>
    <script>
    function myFunction() {
      window.print();
    }
    </script>
@endsection
