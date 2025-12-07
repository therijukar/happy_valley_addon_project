<?php
use yii\helpers\Url;
$this->title = 'Login - Happy Valley';
?>
<div class="card mt-5 shadow-sm">
    <div class="card-body">
        <h4 class="card-title text-center mb-4">Welcome Back!</h4>
        
        <div id="step-phone">
            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <input type="tel" class="form-control form-control-lg" id="phoneNumber" placeholder="Enter 10 digit number" maxlength="10">
            </div>
            <button class="btn btn-primary w-100 btn-lg" id="sendOtpBtn">Send OTP</button>
        </div>

        <div id="step-otp" style="display:none;">
            <div class="mb-3">
                <label for="otpInput" class="form-label">Enter OTP</label>
                <input type="text" class="form-control form-control-lg" id="otpInput" placeholder="XXXXXX" maxlength="6">
                <div class="form-text">OTP sent to <span id="displayPhone" class="fw-bold"></span></div>
            </div>
            <button class="btn btn-success w-100 btn-lg" id="verifyOtpBtn">Verify & Login</button>
            <button class="btn btn-link w-100 mt-2" id="backBtn">Change Number</button>
        </div>

        <div class="alert alert-danger mt-3" id="errorMsg" style="display:none;"></div>
    </div>
</div>

<script>
$(document).ready(function() {
    // If already logged in, redirect to Dashboard
    if(localStorage.getItem('user_token')) {
        window.location.href = "<?= Url::to(['client/dashboard']) ?>";
        return;
    }

    $('#sendOtpBtn').click(function() {
        let phone = $('#phoneNumber').val();
        if(phone.length < 10) {
            $('#errorMsg').text('Please enter a valid 10-digit number').show();
            return;
        }
        $('#errorMsg').hide();
        $(this).prop('disabled', true).text('Sending...');

        $.post("<?= Url::to(['auth/send-otp']) ?>", {phone_number: phone}, function(data) {
            if(data.status === 'success') {
                $('#step-phone').hide();
                $('#step-otp').show();
                $('#displayPhone').text(phone);
                
                // DEV HELPER: Log OTP for debugging, but do not autofill in production
                if(data.otp_dev) {
                   console.log('Dev OTP:', data.otp_dev);
                   // $('#otpInput').val(data.otp_dev); // Disabled for production feel
                   // $('#errorMsg').removeClass('alert-danger').addClass('alert-success').text('Dev Mode: OTP Auto-filled').show();
                }

            } else {
                $('#errorMsg').text(data.message || 'Failed to send OTP').show();
                $('#sendOtpBtn').prop('disabled', false).text('Send OTP');
            }
        }).fail(function() {
            $('#errorMsg').text('Network error').show();
            $('#sendOtpBtn').prop('disabled', false).text('Send OTP');
        });
    });

    $('#verifyOtpBtn').click(function() {
        let phone = $('#phoneNumber').val();
        let otp = $('#otpInput').val();
        
        if(!otp) return;

        $(this).prop('disabled', true).text('Verifying...');

        $.post("<?= Url::to(['auth/verify-otp']) ?>", {phone_number: phone, entered_otp: otp}, function(data) {
            if(data.status === 'verified') {
                localStorage.setItem('user_token', data.user_token);
                const urlParams = new URLSearchParams(window.location.search);
                const returnUrl = urlParams.get('returnUrl');
                // Redirect to Dashboard by default, or returnUrl if set
                window.location.href = returnUrl ? decodeURIComponent(returnUrl) : "<?= Url::to(['client/dashboard']) ?>";
            } else {
                $('#errorMsg').text(data.message || 'Invalid OTP').show();
                $('#verifyOtpBtn').prop('disabled', false).text('Verify & Login');
            }
        }).fail(function() {
            $('#errorMsg').text('Network error').show();
            $('#verifyOtpBtn').prop('disabled', false).text('Verify & Login');
        });
    });

    $('#backBtn').click(function() {
        $('#step-otp').hide();
        $('#step-phone').show();
        $('#sendOtpBtn').prop('disabled', false).text('Send OTP');
        $('#errorMsg').hide();
    });
});
</script>
