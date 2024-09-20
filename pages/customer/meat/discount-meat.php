<?php if($_REQUEST['err'] == 1){?>
<div class="alert alert-danger">
<button type="button" class="close" data-dismiss="alert">×</button>
<i class="fa fa-ban-circle"></i><strong>Oh snap!</strong> The Voucher you provided is invalid. Please try submitting again.
</div>
<?php } ?>

<form action="../helpers/discount.php" class="panel-body wrapper-lg" data-validate="parsley" method = 'post'>

<div class="form-group">
<div class="h4">Do you have discount voucher ?</div>
<br>

<input type = "text" name = "discountVoucher" class="form-control parsley-validated" data-required="true" placeholder="" class="form-control" style = "max-width:34%">
</div>
<br>
<div class="modal-footer">
      <a href="../helpers/noDiscountCode.php" class="btn btn-default" data-dismiss="modal">No I dont have</a>
      <button type = "submit" class="btn btn-primary">Apply</button>
    </div>


	
</form>