<?php
use yii\helpers\Url;
$this->title = 'Sign Up - Happy Valley';
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
      margin-bottom: 25px;
  }
  .logo-container img {
      height: 60px;
      object-fit: contain;
  }

  .auth-title {
    font-weight: 700;
    font-size: 24px;
    text-align: center;
    color: #1e293b;
    margin-bottom: 25px;
  }

  .auth-form .form-control {
    height: 50px;
    padding: 12px 16px;
    box-shadow: none;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 15px;
    margin-bottom: 15px;
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
    margin-top: 5px;
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
      margin-top: 20px;
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
        <img src="<?= Yii::getAlias('@web') . '/web/assets/images/logo.png' ?>" alt="Happy Valley Logo">
    </div>

    <h4 class="auth-title">Create Account</h4>
    
    <div id="step-details">
        <div class="auth-form">
            <input type="text" class="form-control" id="uName" placeholder="Full Name" required>
            <input type="email" class="form-control" id="uEmail" placeholder="Email Address" required>
            <input type="tel" class="form-control" id="uPhone" placeholder="Mobile Number" maxlength="10" required>
        </div>
        <button class="btn btn-auth-submit" id="sendSignupOtpBtn">Send OTP</button>
        <div class="auth-link">
            Already have an account? <a href="<?= Url::to(['client/login']) ?>">Login</a>
        </div>
    </div>

    <div id="step-otp" style="display:none;">
        <div class="mb-4 text-center">
            <p class="text-muted mb-3">OTP sent to <span id="displayPhone" class="fw-bold text-dark"></span></p>
            <input type="text" class="form-control text-center" id="otpInput" placeholder="● ● ● ● ● ●" maxlength="6" style="letter-spacing: 8px; font-weight: bold; font-size: 22px;">
        </div>
        <button class="btn btn-auth-submit" id="registerBtn">Verify & Signup</button>
        <button class="btn btn-link w-100 mt-2 text-muted small" id="backBtn" style="text-decoration: none;">Change Details</button>
    </div>

    <div class="alert alert-danger mt-3 text-center small border-0 bg-danger-subtle text-danger" id="errorMsg" style="display:none;"></div>
</div>

<script>
$(document).ready(function() {
    if(localStorage.getItem('user_token')) {
        window.location.href = "<?= Url::to(['client/dashboard']) ?>";
        return;
    }

    $('#sendSignupOtpBtn').click(function() {
        let name = $('#uName').val();
        let email = $('#uEmail').val();
        let phone = $('#uPhone').val();

        if(!name || !email || !phone) {
            $('#errorMsg').text('Please fill all fields').show();
            return;
        }
        if(!/^\d{10}$/.test(phone)) {
             $('#errorMsg').text('Please enter a valid 10-digit number').show();
             return;
        }

        $('#errorMsg').hide();
        $(this).prop('disabled', true).text('Sending...');

        // Use actionSendSignupOtp
        $.post("<?= Url::to(['auth/send-signup-otp']) ?>", {phone_number: phone}, function(data) {
            if(data.status === 'success') {
                $('#step-details').hide();
                $('#step-otp').show();
                $('#displayPhone').text(phone);
                setTimeout(() => $('#otpInput').focus(), 100);
            } else {
                $('#errorMsg').text(data.message || 'Failed to send OTP').show();
                $('#sendSignupOtpBtn').prop('disabled', false).text('Send OTP');
            }
        }).fail(function() {
            $('#errorMsg').text('Network error').show();
            $('#sendSignupOtpBtn').prop('disabled', false).text('Send OTP');
        });
    });

    $('#registerBtn').click(function() {
        let name = $('#uName').val();
        let email = $('#uEmail').val();
        let phone = $('#uPhone').val();
        let otp = $('#otpInput').val();
        
        // Get Referral Code from URL
        const urlParams = new URLSearchParams(window.location.search);
        const referralCode = urlParams.get('ref');
        
        if(!otp) return;

        $(this).prop('disabled', true).text('Creating Account...');

        // Use actionRegister
        $.post("<?= Url::to(['auth/register']) ?>", {
            name: name, 
            email: email, 
            phone: phone, 
            otp: otp,
            referral_code: referralCode
        }, function(data) {
            if(data.status === 'success') {
                localStorage.setItem('user_token', data.user_token);
                // Redirect to Dashboard
                window.location.href = "<?= Url::to(['client/dashboard']) ?>";
            } else {
                $('#errorMsg').text(data.message || 'Registration failed').show();
                $('#registerBtn').prop('disabled', false).text('Verify & Signup');
            }
        }).fail(function() {
            $('#errorMsg').text('Network error').show();
            $('#registerBtn').prop('disabled', false).text('Verify & Signup');
        });
    });

    $('#backBtn').click(function() {
        $('#step-otp').hide();
        $('#step-details').show();
        $('#sendSignupOtpBtn').prop('disabled', false).text('Send OTP');
        $('#errorMsg').hide();
        $('#otpInput').val('');
    });
    
    // Allow Enter key
    $('#uPhone').keypress(function(e){ if(e.which == 13) $('#sendSignupOtpBtn').click(); });
    $('#otpInput').keypress(function(e){ if(e.which == 13) $('#registerBtn').click(); });
});
</script>
