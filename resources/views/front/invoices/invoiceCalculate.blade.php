@extends('layouts.master')

@section('content')

@endsection










{{--
<!-- make dynamic input field -->
<div class="col-md-12">
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>Info.</th>
                <th>Medicine Name</th>
                <th>Quantity</th>
                <th>Unit/Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="row_container">
            <tr id="div_{{$row_num}}">
                <td>
                    <a href="javascript:0" class="btn btn-warning"><i class="fa fa-info-circle"></i></a>
                </td>
                <td>
                    <input type="text" name="medicine_name" class="form-control" placeholder="Medicine Name">
                </td>
                <td>
                    <input type="text" name="quantity" class="form-control" placeholder="Quantity" id="quantity">
                </td>
                <td>
                    <input type="text" name="unit_price" class="form-control" placeholder="Unit Price" id="unitprice">
                </td>
                <td>
                    <input type="text" name="total" class="form-control" placeholder="Total" id="total"
                        style="cursor: pointer;" readonly>
                </td>
                <td>
                    <a href="javascript:0" class="btn btn-danger"><i class="fa fa-minus"
                            onclick="$('#div_{{$row_num}}').remove();"></i></a>
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td colspan="3"></td>
                <td></td>
                <td></td>
                <td>
                    <a href="javascript:0" class="btn btn-success" onclick="addrow();"><i class="fa fa-plus"></i></a>
                </td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td> <strong>Sub Total:</strong> </td>
                <td>
                    <input type="text" name="subtotal" class="form-control" id="subtotal" value="0.00" readonly>
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td> <strong>VAT(%):</strong> </td>
                <td>
                    <input type="text" name="" class="form-control" id="vat">
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td> <strong>VAT+Sub Total:</strong> </td>
                <td>
                    <input type="text" name="" class="form-control" id="vatsubtotal" value="0.00" readonly>
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td> <strong>Paid:</strong> </td>
                <td>
                    <input type="text" name="" class="form-control" id="paid">
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td> <strong>Due:</strong> </td>
                <td>
                    <input type="text" name="" class="form-control" id="due" value="0.00" readonly>
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td> <strong>Grand Total:</strong> </td>
                <td>
                    <input type="text" name="" class="form-control" id="grandtotal" value="0.00" readonly>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() { 
$("#total").click(function() { 
/*var quantity = document.getElementById("quantity").value;*/ 
var quantity = $("#quantity").val(); 
var unitprice = $("#unitprice").val(); 
var total = (quantity*unitprice); 
$('#total').val(total); 
$('#subtotal').val(total); 
});

$('#vat').change(function() { 
var vInput = this.value; 
var subtotal = $("#subtotal").val(); 
var vInput = ((vInput*subtotal)/100); 
var vstotal = (parseFloat(subtotal)+parseFloat(vInput)).toFixed(1); $('#vatsubtotal').val(vstotal); 
});

$('#paid').change(function() { 
var pInput = this.value; 
var vatsubtotal = $("#vatsubtotal").val(); 
if((pInput < vatsubtotal) || (pInput <= vatsubtotal)){ $('#paid').val(pInput); 
var dInput = (vatsubtotal-pInput); 
$('#due').val(dInput); 
var total = $("#total").val(); 
var subtotal = $("#subtotal").val(); 
var gtInput = (parseFloat(total)+parseFloat(subtotal)+parseFloat(vatsubtotal)).toFixed(1); $('#grandtotal').val(gtInput); 
}else{ 
alert('You are paying so much amount'); 
} 
});
});
</script> --}}