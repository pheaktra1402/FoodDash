<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $email = 'hyleabheng21@gmail.com';
    $name = 'Test User';
    $otp = '1234';
    
    $dummyUser = (object) ['name' => $name, 'email' => $email];

    echo "Sending email...\n";
    \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\OtpEmail($dummyUser, $otp));
    echo "Email sent successfully!\n";
} catch (\Exception $e) {
    echo "Error sending email: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
