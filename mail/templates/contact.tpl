    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>New Contact Request</title>
    </head>

    <body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f9f9f9;">
        <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f9f9f9; padding:20px;">
            <tr>
                <td align="center">
                    <table width=100% cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 4px rgba(0,0,0,0.1);">
                        <tr>
                            <td style="background-color:#4CAF50; padding:20px; color:#ffffff; text-align:center;">
                                <h1 style="margin:0; font-size:24px;">New Contact Request</h1>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:20px;">
                                <p style="font-size:16px; color:#333333;">You have received a new contact request with the following details:</p>
                                <table width="100%" cellpadding="5" cellspacing="0" style="font-size:16px; color:#333333;">
                                    <tr>
                                        <td style="width:150px; font-weight:bold;">Reason:</td>
                                        <td>[[[REASON]]]</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">First Name:</td>
                                        <td>[[[FIRSTNAME]]]</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Last Name:</td>
                                        <td>[[[LASTNAME]]]</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Email:</td>
                                        <td><a href="mailto:[[[email]]]" style="color:#4CAF50;">[[[EMAIL]]]</a></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold; vertical-align:top;">Message:</td>
                                        <td>[[[MESSAGE]]]</td>
                                    </tr>
                                </table>
                                <p style="margin-top:20px; font-size:14px; color:#888888;">This message was sent via your portfolio contact form.</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color:#f0f0f0; padding:15px; text-align:center; font-size:12px; color:#999999;">
                                &copy; <?= date('Y') ?> Your Portfolio. All rights reserved.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>

    </html>