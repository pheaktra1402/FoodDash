<!DOCTYPE html>
<html>
<head>
    <title>Your OTP Verification Code</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h2 style="color: #333333; text-align: center;">Verify Your Email</h2>
        <p style="color: #555555; font-size: 16px;">Hello {{ $user->name }},</p>
        <p style="color: #555555; font-size: 16px;">Thank you for registering. Please use the verification code below to complete your registration:</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <span style="display: inline-block; padding: 15px 30px; font-size: 32px; font-weight: bold; color: #E91E63; background-color: #FCE4EC; border-radius: 8px; letter-spacing: 5px;">
                {{ $otp }}
            </span>
        </div>
        
        <p style="color: #555555; font-size: 14px; text-align: center;">This code will expire in 10 minutes.</p>
        <p style="color: #555555; font-size: 14px; text-align: center; margin-top: 30px;">If you didn't request this, you can safely ignore this email.</p>
        <hr style="border: none; border-top: 1px solid #eeeeee; margin: 20px 0;">
        <p style="color: #999999; font-size: 12px; text-align: center;">&copy; {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.</p>
    </div>
</body>
</html>
