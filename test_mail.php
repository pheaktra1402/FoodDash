
use Illuminate\Support\Facades\Mail;

try {
    Mail::raw('Test email', function ($msg) { 
        $msg->to('pheaktrathorn474@gmail.com')->subject('Test'); 
    });
    echo 'Email sent successfully!';
} catch (\Exception $e) {
    echo 'Error sending email: ' . $e->getMessage();
}
