<!DOCTYPE html>
<html>
<head>
    <title>Generate PDF using Laravel TCPDF - ItSolutionStuff.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        
body{margin-top:20px;
background:#eee;
}




/**    17. Panel
 *************************************************** **/
/* pannel */
.panel {
    position:relative;

    background:transparent;

    -webkit-border-radius: 0;
       -moz-border-radius: 0;
            border-radius: 0;

    -webkit-box-shadow: none;
       -moz-box-shadow: none;
            box-shadow: none;
}
.panel.fullscreen .accordion .panel-body,
.panel.fullscreen .panel-group .panel-body {
    position:relative !important;
    top:auto !important;
    left:auto !important;
    right:auto !important;
    bottom:auto !important;
}
    
.panel.fullscreen .panel-footer {
    position:absolute;
    bottom:0;
    left:0;
    right:0;
}


.panel>.panel-heading {
    text-transform: uppercase;

    -webkit-border-radius: 0;
       -moz-border-radius: 0;
            border-radius: 0;
}
.panel>.panel-heading small {
    text-transform:none;
}
.panel>.panel-heading strong {
    font-family:Arial,Helvetica,Sans-Serif;
}
.panel>.panel-heading .buttons {
    display:inline-block;
    margin-top:-3px;
    margin-right:-8px;
}
.panel-default>.panel-heading {
    padding: 15px 15px;
    background:#fff;
}
.panel-default>.panel-heading small {
    color:#9E9E9E;
    font-size:12px;
    font-weight:300;
}
.panel-clean {
    border: 1px solid #ddd;
    border-bottom: 3px solid #ddd;

    -webkit-border-radius: 0;
       -moz-border-radius: 0;
            border-radius: 0;
}
.panel-clean>.panel-heading {
    padding: 11px 15px;
    background:#fff !important;
    color:#000; 
    border-bottom: #eee 1px solid;
}
.panel>.panel-heading .btn {
    margin-bottom: 0 !important;
}

.panel>.panel-heading .progress {
    background-color:#ddd;
}

.panel>.panel-heading .pagination {
    margin:-5px;
}

.panel-default {
    border:0;
}

.panel-light {
    border:rgba(0,0,0,0.1) 1px solid;
}
.panel-light>.panel-heading {
    padding: 11px 15px;
    background:transaprent;
    border-bottom:rgba(0,0,0,0.1) 1px solid;
}

.panel-heading a.opt>.fa {
    display: inline-block;
    font-size: 14px;
    font-style: normal;
    font-weight: normal;
    margin-right: 2px;
    padding: 5px;
    position: relative;
    text-align: right;
    top: -1px;
}

.panel-heading>label>.form-control {
    display:inline-block;
    margin-top:-8px;
    margin-right:0;
    height:30px;
    padding:0 15px;
}
.panel-heading ul.options>li>a {
    color:#999;
}
.panel-heading ul.options>li>a:hover {
    color:#333;
}
.panel-title a {
    text-decoration:none;
    display:block;
    color:#333;
}

.panel-body {
    background-color:#fff;
    padding: 15px;

    -webkit-border-radius: 0;
       -moz-border-radius: 0;
            border-radius: 0;
}
.panel-body.panel-row {
    padding:8px;
}

.panel-footer {
    font-size:12px;
    border-top:rgba(0,0,0,0.02) 1px solid;
    background-color:rgba(0255,255,255,1);

    -webkit-border-radius: 0;
       -moz-border-radius: 0;
            border-radius: 0;
}
.list-unstyled{
    list-style-type: none;
  margin: 0;
  padding: 0;
}

#invoice>table,#invoice>td,#invoice>th {  
  border: 1px solid #000;
  text-align: left;
}

    </style>
</head>
<body>
    <div class="container bootstrap snippets bootdey">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <table class="table table-condensed nomargin">
                        <tr>
                            <td>
                                <div class="col-md-6 col-sm-6 text-left">
                                <h4><strong>Billing To:</strong></h4>
                                <ul class="list-unstyled">
                                <li>{{$vendorDetails->name_of_store}}</li>
                                <li><strong>A:</strong> {{$vendorDetails->store_address}}, {{$vendorDetails->dist}}, {{$vendorDetails->state}} - {{$vendorDetails->pincode}}</li>
                                <li><strong>P:</strong> {{$vendorDetails->phone}}</li>
                                <li><strong>E:</strong> {{$vendorDetails->email}}</li>
                                </ul>
                                </div>
                            </td>
                            <td>
                                <div class="col-md-6 col-sm-6 text-left">
                                <h4><strong>Invoice:</strong></h4>
                                <ul class="list-unstyled">
                                <li><strong>ID:</strong> #{{$prescription->order_id}}</li>
                                <li><strong>Issue Date:</strong> {{Carbon\Carbon::now()->format('m-d-Y')}}</li>
                                
                                </ul>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive">
                    <table id="invoice" class="table  table-bordered" >
                        <thead>
                        <tr>
                        <td>Sl.No.</td>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>

                        <th>Total Price</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                            $total_amount = '0.00';

                            @endphp
                            @forelse($allmedicines as $key => $med)
                            @php
                            $total_amount = $total_amount+$med->total_price;
                            @endphp
                            <tr>
                            <td>{{$key+1}}</td>
                            <td>
                            {{$med->medicine_name}}
                            </td>
                            <td>{{$med->quantity}}</td>
                            <td>Rs. {{number_format($med->price,2)}}</td>

                            <td> Rs.{{number_format($med->total_price,2)}}</td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <hr class="nomargin-top">
                <div class="row">
                    <table class="table table-condensed nomargin">
                        <tr>
                            <td></td><td></td><td></td><td></td>
                            <td colspan="5">
                                <div class="col-sm-12 text-right">
                                <ul class="list-unstyled">
                                <li><strong>Sub - Total Amount:</strong>Rs.{{number_format($total_amount,2)}}</li>
                                @php
                                $tax = 2;
                                $total_discount =($total_amount*($vendorDetails->discount/100));
                                $tax_amount  = (($total_amount-$total_discount)*($tax/100));
                                $total_final = number_format(($total_amount-$total_discount+$tax_amount),2);

                                $total_discount =number_format($total_discount,2);
                                $tax_amount  = number_format($tax_amount,2);

                                @endphp
                                <li><strong>Discount ({{$vendorDetails->discount}}%):</strong> Rs. {{$total_discount}}</li>
                                <li><strong> Tax ({{$tax}}%):</strong> Rs. {{$tax_amount}}</li>
                                <li><strong>Grand Total:</strong> {{$total_final}}</li>
                                </ul>

                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>