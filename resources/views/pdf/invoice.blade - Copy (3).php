<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>Simple invoice page - Bootdey.com</title>
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
        <h4><strong>Client</strong> Details</h4>
        <ul class="list-unstyled">
        <li><strong>First Name:</strong> John</li>
        <li><strong>Last Name:</strong> Doe</li>
        <li><strong>Country:</strong> U.S.A.</li>
        <li><strong>DOB:</strong> YYYY/MM/DD</li>
        </ul>
        </div>
    </td>
    <td>
        <div class="col-md-6 col-sm-6 text-left">
        <h4><strong>Payment</strong> Details</h4>
        <ul class="list-unstyled">
        <li><strong>Bank Name:</strong> 012345678901</li>
        <li><strong>Account Number:</strong> 012345678901</li>
        <li><strong>SWIFT Code:</strong> SWITCH012345678CODE</li>
        <li><strong>V.A.T Reg #:</strong> VAT5678901CODE</li>
        </ul>
        </div>
    </td>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table table-condensed nomargin">
<thead>
<tr>
<th>Item Name</th>
<th>Quantity</th>
<th>Unit Price</th>

<th>Total Price</th>
</tr>
</thead>
<tbody>
<tr>
<td>
<div><strong>Unique side and front panel design</strong></div>
<small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
</td>
<td>2</td>
<td>$20.00</td>

<td>$23,78</td>
</tr>
<tr>
<td>
<div><strong>Side panel with TAC 2.0 ventilation</strong></div>
<small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
</td>
<td>2</td>
<td>$67.00</td>

<td>$68.80</td>
</tr>
<tr>
<td>
<div><strong>Mesh front panel design to improve air</strong></div>
<small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
</td>
<td>3</td>
<td>$335.00</td>

<td>$435.20</td>
</tr>
</tbody>
</table>
</div>
<hr class="nomargin-top">
<div class="row">
<table class="table table-condensed nomargin">
<tr>
    <td>
<div class="col-sm-6 text-left">
<h4><strong>Contact</strong> Details</h4>

<address>
PO Box 21132 <br>
Vivas 2355 Australia<br>
Phone: 1-800-565-2390 <br>
Fax: 1-800-565-2390 <br>

</address>
</div>
</td>
<td colspan="3">
<div class="col-sm-6 text-left">
<ul class="list-unstyled">
<li><strong>Sub - Total Amount:</strong> $2162.00</li>
<li><strong>Discount:</strong> 10.0%</li>
<li><strong>VAT ($6):</strong> $12.0</li>
<li><strong>Grand Total:</strong> $1958.0</li>
</ul>

</div>
</td>
</table>
</div>
</div>
</div>

</div>

    

</script>
</body>
</html>