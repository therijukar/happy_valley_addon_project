<div class="container" style="min-height: 400px; margin-top: 50px; background-color: #ffffff; border-radius: 10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); padding: 30px;">
    <h2 style="color: #333; font-size: 28px; margin-bottom: 30px;">				<span class="glyphicon glyphicon-ok"></span></i> Order Confirmation</h2>
    <div style="background-color: #f9f9f9; border-radius: 8px; padding: 20px; box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);">
        <p style="color: #333; font-size: 18px; margin-bottom: 15px;">Thank you for your order! Your transaction was successful.</p>
        <p style="color: #666; font-size: 16px; margin-bottom: 10px;">Order Status: <span style="color: #4CAF50;"><?php echo $status; ?></span></p>
        <p style="color: #666; font-size: 16px; margin-bottom: 10px;">Transaction ID: <span style="color: #007bff;"><?php echo $txn_id; ?></span></p>
        <p style="color: #666; font-size: 16px; margin-bottom: 10px;">Amount Paid: <span style="color: #007bff;">Rs. <?php echo $amount; ?></span></p>
        <p style="color: #666; font-size: 16px;">You will soon receive an email with the booking voucher. If you don't receive it, please check your spam folder.</p>
    </div>
</div>
