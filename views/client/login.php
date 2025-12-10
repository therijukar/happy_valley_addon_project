<?php
use yii\helpers\Url;
$this->title = 'Login - Happy Valley';
?>
<style>
  .auth-card {
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    padding: 40px 30px;
    background: #fff;
    width: 100%;
    border: 1px solid #f1f1f1;
  }

  .logo-container {
      text-align: center;
      margin-bottom: 30px;
  }
  .logo-container img {
      height: 80px; /* Adjust based on logo aspect ratio */
      object-fit: contain;
  }

  .auth-title {
    font-weight: 700;
    font-size: 24px;
    text-align: center;
    color: #1e293b;
    margin-bottom: 10px;
  }
  
  .auth-subtitle {
      text-align: center;
      color: #64748b;
      margin-bottom: 30px;
      font-size: 15px;
  }

  .auth-form .form-control {
    height: 52px;
    padding: 12px 16px;
    box-shadow: none;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.2s;
  }
  
  .auth-form .form-control:focus {
    border-color: #BE151C;
    outline: none;
    box-shadow: 0 0 0 3px rgba(190, 21, 28, 0.1);
  }

  .btn-auth-submit {
    display: block;
    width: 100%;
    padding: 14px;
    background: #BE151C;
    border-color: #BE151C;
    color: #fff;
    font-size: 16px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s;
    margin-top: 10px;
  }

  .btn-auth-submit:hover {
    background: #a01217;
    border-color: #a01217;
    color: #fff;
    transform: translateY(-1px);
  }
  
  .btn-auth-submit:disabled {
      background: #e2e8f0;
      border-color: #e2e8f0;
      color: #94a3b8;
      transform: none;
  }
  
  .auth-link {
      display: block;
      text-align: center;
      margin-top: 25px;
      color: #64748b;
      font-size: 14px;
  }
  .auth-link a {
      color: #BE151C;
      font-weight: 600;
      text-decoration: none;
  }
  .auth-link a:hover { text-decoration: underline; }
</style>

<div class="auth-card">
    <div class="logo-container">
        <!-- Assuming generic logo path or text if image missing -->
        <img src="<?= Yii::getAlias('@web') . '/web/assets/images/logo.png' ?>" alt="Happy Valley Logo">
    </div>
    
    <h4 class="auth-title">Welcome Back</h4>
    <p class="auth-subtitle">Login to manage your bookings</p>
    
    <div id="step-phone">
        <div class="mb-4">
            <label class="form-label text-muted small fw-bold">Mobile Number</label>
            <input type="tel" class="form-control auth-form" id="phoneNumber" placeholder="Enter Mobile Number" maxlength="10">
        </div>
        <button class="btn btn-auth-submit" id="sendOtpBtn">Send OTP</button>
        <div class="auth-link">
            Don't have an account? <a href="<?= Url::to(['client/signup']) ?>">Sign Up</a>
        </div>
    </div>

    <div id="step-otp" style="display:none;">
        <div class="mb-4 text-center">
            <p class="text-muted mb-3">Enter the code sent to <span id="displayPhone" class="fw-bold text-dark"></span></p>
            <input type="text" class="form-control text-center auth-form" id="otpInput" placeholder="● ● ● ● ● ●" maxlength="6" style="letter-spacing: 8px; font-weight: bold; font-size: 22px;">
        </div>
        <button class="btn btn-auth-submit" id="verifyOtpBtn">Verify & Login</button>
        <button class="btn btn-link w-100 mt-3 text-muted small" id="backBtn" style="text-decoration: none;">Change Number</button>
    </div>

    <div class="alert alert-danger mt-3 text-center small border-0 bg-danger-subtle text-danger" id="errorMsg" style="display:none;"></div>
</div>

<script>
$(document).ready(function() {
    // If logged in, redirect
    if(localStorage.getItem('user_token')) {
        window.location.href = "<?= Url::to(['client/dashboard']) ?>";
        return;
    }

    $('#sendOtpBtn').click(function() {
        let phone = $('#phoneNumber').val();
        if(!/^\d{10}$/.test(phone)) {
            $('#errorMsg').text('Please enter a valid 10-digit number').show();
            return;
        }
        $('#errorMsg').hide();
        $(this).prop('disabled', true).text('Sending...');

        // Use new actionSendLoginOtp
        $.post("<?= Url::to(['auth/send-login-otp']) ?>", {phone_number: phone}, function(data) {
            if(data.status === 'success') {
                $('#step-phone').hide();
                $('#step-otp').show();
                $('#displayPhone').text(phone);
                // Auto focus OTP
                setTimeout(() => $('#otpInput').focus(), 100);
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

        // Use new actionVerifyLoginOtp
        $.post("<?= Url::to(['auth/verify-login-otp']) ?>", {phone_number: phone, entered_otp: otp}, function(data) {
            if(data.status === 'verified') {
                localStorage.setItem('user_token', data.user_token);
                window.location.href = "<?= Url::to(['client/dashboard']) ?>";
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
        $('#otpInput').val('');
    });
    
    // Allow Enter key
    $('#phoneNumber').keypress(function(e){ if(e.which == 13) $('#sendOtpBtn').click(); });
    $('#otpInput').keypress(function(e){ if(e.which == 13) $('#verifyOtpBtn').click(); });
});
</script>
