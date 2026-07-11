<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 480px; margin: 40px auto; background: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); overflow: hidden; }
        .header { background: #1e40af; padding: 24px; text-align: center; }
        .header h2 { color: #ffffff; margin: 0; font-size: 20px; }
        .body { padding: 32px 24px; text-align: center; }
        .otp-code { font-size: 36px; font-weight: 700; letter-spacing: 8px; color: #1e40af; background: #eff6ff; border-radius: 8px; padding: 16px 24px; display: inline-block; margin: 20px 0; }
        .footer { text-align: center; padding: 16px; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb; }
        p { color: #4b5563; line-height: 1.6; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>FleetMIS Login Verification</h2>
        </div>
        <div class="body">
            <p>Hello {{ $userName }},</p>
            <p>Use the one-time password below to complete your login. This code expires in <strong>10 minutes</strong>.</p>
            <div class="otp-code">{{ $code }}</div>
            <p style="margin-top: 16px;">If you did not attempt to log in, please ignore this email and your account remains secure.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} FleetMIS. All rights reserved.
        </div>
    </div>
</body>
</html>
