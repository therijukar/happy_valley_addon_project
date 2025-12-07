<style>
  .asterisk{
    color:#f00;
  }
  body {
    display: none;
  }
</style>
<?php
use yii\widgets\ActiveForm;
?>
  <div style="margin:200px 0px 200px 200px">
    <?php $form = ActiveForm::begin(['action' =>$action,'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal','name' => 'payuForm']]); ?>
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <table>
        <tr>
          <td>Name <span class="asterisk">*</span>: </td>
          <td><input type="text" name="firstname" value="<?php echo $name ?>" id="firstname" required readonly /></td>
          <td>Phone <span class="asterisk">*</span>: </td>
          <td><input type="text" name="phone" value="<?php echo $phone; ?>" required readonly /></td>
        </tr>
        <tr>
          <td>Amount <span class="asterisk">*</span>: </td>
          <td><input name="amount" value="<?php echo $amount; ?>" readonly /></td>
          <td>Email <span class="asterisk">*</span>: </td>
          <td><input name="email" id="email" value="<?php echo $email; ?>" readonly /></td>
        </tr>
        <tr hidden>
          <td>Product Info: </td>
          <td colspan="3"><textarea name="productinfo"><?php echo $product; ?></textarea></td>
        </tr>
        <tr hidden>
          <td>Success URI: </td>
          <td colspan="3"><input name="surl" value="<?php echo $surl ?>" size="64" /></td>
        </tr>
        <tr hidden>
          <td>Failure URI: </td>
          <td colspan="3"><input name="furl" value="<?php echo $furl?>" size="64" /></td>
        </tr>

        <tr>
          <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
        </tr>
            <td colspan="4"><input type="submit" value="Submit" /></td>
        </tr>
      </table>
      <?php ActiveForm::end(); ?>
  </div>

  <script>
    window.onload = function(e){ 
      payuForm.submit(); 
    }
  </script>