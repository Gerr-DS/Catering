<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Persetujuan Registrasi Admin</title>
</head>
<body style="font-family: 'Poppins', 'Inter', sans-serif; background-color: #f3f4f6; margin: 0; padding: 40px; color: #1b261e;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #e5e7eb;">
        <!-- Header -->
        <div style="background: linear-gradient(135deg, #1a472a 0%, #0f2b19 100%); padding: 30px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 1.8rem; font-weight: 700; letter-spacing: -0.5px;">Hafidz Catering<span style="color: #c28e67;">.</span></h1>
            <p style="color: #a3b899; margin: 5px 0 0 0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Portal Manajemen Admin</p>
        </div>
        
        <!-- Content -->
        <div style="padding: 40px 30px;">
            <h2 style="font-size: 1.3rem; font-weight: 600; color: #1a472a; margin-top: 0; margin-bottom: 20px;">Permintaan Persetujuan Registrasi</h2>
            <p style="font-size: 0.95rem; line-height: 1.6; color: #4b5563; margin-bottom: 25px;">
                Halo Administrator Utama,<br><br>
                Terdapat pengajuan pembuatan akun admin baru dengan rincian sebagai berikut:
            </p>
            
            <!-- Details Card -->
            <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; padding: 20px; margin-bottom: 30px;">
                <table style="width: 100%; font-size: 0.9rem; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; color: #9ca3af; font-weight: 500; width: 35%;">Nama Lengkap</td>
                        <td style="padding: 8px 0; color: #1f2937; font-weight: 600;">{{ $nama }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #9ca3af; font-weight: 500;">Email Akun</td>
                        <td style="padding: 8px 0; color: #1f2937; font-weight: 600; font-family: monospace;">{{ $email }}</td>
                    </tr>
                </table>
            </div>
            
            <p style="font-size: 0.95rem; line-height: 1.6; color: #4b5563; text-align: center; margin-bottom: 30px;">
                Apakah Anda menyetujui pembuatan akun admin <strong>{{ $email }}</strong>?
            </p>
            
            <!-- Actions -->
            <div style="text-align: center; margin-bottom: 30px;">
                <!-- Approve Button -->
                <a href="{{ url('/admin/approve/' . $token) }}" style="display: inline-block; background: linear-gradient(135deg, #1a472a 0%, #2d613e 100%); color: #ffffff; font-weight: 600; font-size: 0.95rem; padding: 14px 35px; border-radius: 50px; text-decoration: none; box-shadow: 0 8px 20px rgba(26, 71, 42, 0.2); margin-right: 15px;">Setuju</a>
                
                <!-- Reject Button -->
                <a href="{{ url('/admin/reject/' . $token) }}" style="display: inline-block; background: #ffffff; color: #b91c1c; font-weight: 600; font-size: 0.95rem; padding: 12px 33px; border-radius: 50px; text-decoration: none; border: 2px solid #b91c1c; box-shadow: 0 4px 10px rgba(0,0,0,0.02);">Tolak</a>
            </div>
            
            <hr style="border: 0; border-top: 1px solid #e5e7eb; margin: 30px 0;">
            
            <p style="font-size: 0.8rem; color: #9ca3af; line-height: 1.5; margin: 0; text-align: center;">
                Jika Anda tidak mengenali permintaan ini atau ingin membatalkannya, Anda cukup mengabaikan email ini atau mengklik tombol <strong>Tolak</strong>. Akun tidak akan pernah dimasukkan ke database utama jika tidak disetujui.
            </p>
        </div>
        
        <!-- Footer -->
        <div style="background-color: #fafdfb; border-top: 1px solid #e5e7eb; padding: 20px; text-align: center; font-size: 0.75rem; color: #9ca3af;">
            &copy; 2026 Hafidz Catering Management Portal. All Rights Reserved.
        </div>
    </div>
</body>
</html>
