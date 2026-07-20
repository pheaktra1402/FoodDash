<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$email = 'tengsophanith@gmail.com';

// Ensure user exists
$user = \App\Models\User::where('email', $email)->first();
if (!$user) {
    $user = new \App\Models\User();
    $user->name = 'Test User';
    $user->email = $email;
    $user->phone = '012345678';
    $user->password = \Illuminate\Support\Facades\Hash::make('password');
    $user->save();
    echo "User created.\n";
}

// Instantiate AuthController and mock Request
$controller = new \App\Http\Controllers\AuthController();
$request = \Illuminate\Http\Request::create('/api/forgot-password', 'POST', ['email' => $email]);
$response = $controller->forgotPassword($request);

echo "Response status: " . $response->getStatusCode() . "\n";
echo "Response content: " . $response->getContent() . "\n";
