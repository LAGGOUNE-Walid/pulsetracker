<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulsetracker Email</title>
</head>

<body style="margin: 0; padding: 0; background-color: #000; color: #E7E9EA; font-family: Arial, sans-serif; line-height: 1.6;">

    <!-- Wrapper -->
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #000; margin: 0; padding: 0; width: 100%;">
        <tr>
            <td align="center" style="padding: 20px;">
                <!-- Email Container -->
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #16171C; border-radius: 10px; overflow: hidden; width: 100%; max-width: 600px;">
                    <tr>
                        <!-- Header -->
                        <td align="center" style="padding: 20px; text-align: left; background-color: #000;">
                            <img src="{{ url('assets/img/Circle%20Brand%20Identity.jpeg') }}" alt="Pulsetracker Logo" width="70" height="70" style="display: block; margin-bottom: 10px;">
                            <h3 style="margin: 0; color: #E7E9EA; font-size: 24px;">Pulsetracker</h3>
                        </td>
                    </tr>
                    <tr>
                        <!-- Content -->
                        <td style="padding: 20px; text-align: left; color: #E7E9EA; font-size: 16px;">
                            <hr style="border: none; border-top: 1px solid rgba(255, 255, 255, 0.1); margin: 20px 0;">
                            @yield('content')
                            <hr style="border: none; border-top: 1px solid rgba(255, 255, 255, 0.1); margin: 20px 0;">
                        </td>
                    </tr>
                    <tr>
                        <!-- Footer -->
                        <td align="center" style="padding: 20px; text-align: center; font-size: 12px; color: rgba(255, 255, 255, 0.6); background-color: #16171C;">
                            © 2024 Pulsetracker. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
