<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\PendingAdmin;
use App\Mail\AdminApprovalRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminApprovalTest extends TestCase
{
    use RefreshDatabase;

    public function test_main_admin_can_register_directly(): void
    {
        Mail::fake();

        $response = $this->post('/register', [
            'nama' => 'Main Admin',
            'username' => 'gerry.dimasarya2006@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/admin/dashboard');

        $this->assertDatabaseHas('admins', [
            'username' => 'gerry.dimasarya2006@gmail.com',
            'nama' => 'Main Admin',
        ]);

        $this->assertDatabaseMissing('pending_admins', [
            'username' => 'gerry.dimasarya2006@gmail.com',
        ]);

        Mail::assertNothingSent();
    }

    public function test_regular_admin_registration_requires_approval(): void
    {
        Mail::fake();

        $response = $this->post('/register', [
            'nama' => 'Regular Admin',
            'username' => 'gerry@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/register');
        $response->assertSessionHas('status');

        // It should NOT be in the main admins table
        $this->assertDatabaseMissing('admins', [
            'username' => 'gerry@gmail.com',
        ]);

        // It SHOULD be in the pending_admins table
        $this->assertDatabaseHas('pending_admins', [
            'username' => 'gerry@gmail.com',
            'nama' => 'Regular Admin',
        ]);

        $pending = PendingAdmin::where('username', 'gerry@gmail.com')->first();
        $this->assertNotNull($pending->token);

        // Mail should be sent to the main admin
        Mail::assertSent(AdminApprovalRequest::class, function ($mail) use ($pending) {
            return $mail->hasTo('gerry.dimasarya2006@gmail.com') &&
                   $mail->nama === 'Regular Admin' &&
                   $mail->email === 'gerry@gmail.com' &&
                   $mail->token === $pending->token;
        });
    }

    public function test_main_admin_can_approve_pending_registration(): void
    {
        $pending = PendingAdmin::create([
            'nama' => 'Approve Me',
            'username' => 'approve@gmail.com',
            'password' => Hash::make('password123'),
            'token' => 'some-random-token',
        ]);

        $response = $this->get('/admin/approve/some-random-token');

        $response->assertStatus(200);
        $response->assertViewIs('auth.approval_result');
        $response->assertViewHas('status', 'approved');

        // It should be moved to the main admins table
        $this->assertDatabaseHas('admins', [
            'username' => 'approve@gmail.com',
            'nama' => 'Approve Me',
        ]);

        // It should be deleted from pending table
        $this->assertDatabaseMissing('pending_admins', [
            'username' => 'approve@gmail.com',
        ]);
    }

    public function test_main_admin_can_reject_pending_registration(): void
    {
        $pending = PendingAdmin::create([
            'nama' => 'Reject Me',
            'username' => 'reject@gmail.com',
            'password' => Hash::make('password123'),
            'token' => 'some-reject-token',
        ]);

        $response = $this->get('/admin/reject/some-reject-token');

        $response->assertStatus(200);
        $response->assertViewIs('auth.approval_result');
        $response->assertViewHas('status', 'rejected');

        // It should NOT be in the main admins table
        $this->assertDatabaseMissing('admins', [
            'username' => 'reject@gmail.com',
        ]);

        // It should be deleted from pending table
        $this->assertDatabaseMissing('pending_admins', [
            'username' => 'reject@gmail.com',
        ]);
    }
}
