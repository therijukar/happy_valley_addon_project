#!/bin/bash

# 1. Send OTP
echo "Sending OTP..."
curl -s -X POST -d "phone_number=1234567890" http://127.0.0.1:8089/auth/send-otp > /dev/null

# 2. Fetch OTP
OTP=$(php fetch_otp.php)
echo "OTP: $OTP"

# 3. Verify OTP
echo "Verifying OTP..."
VERIFY_RES=$(curl -s -X POST -d "phone_number=1234567890&entered_otp=$OTP" http://127.0.0.1:8089/auth/verify-otp)
TOKEN=$(echo $VERIFY_RES | php -r "echo json_decode(file_get_contents('php://stdin'), true)['user_token'] ?? '';")

echo "Token: $TOKEN"

if [ -z "$TOKEN" ]; then
    echo "Failed to get token"
    exit 1
fi

# 4. Create Booking (Initiate Payment)
echo "Creating Booking..."
curl -s -X POST \
    -H "Authorization: Bearer $TOKEN" \
    -H "Content-Type: application/json" \
    -d '{"product": "4", "unit": 1, "amount": 100}' \
    http://127.0.0.1:8089/api-booking/create | json_pp
