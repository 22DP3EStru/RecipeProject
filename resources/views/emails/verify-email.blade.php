<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apstiprini e-pastu</title>
</head>
<body style="margin:0; padding:0; background:#eee5da; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#eee5da; padding:40px 16px;">
    <tr>
        <td align="center">
            <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; background:#fffdf9; border:1px solid #ddcfc0; box-shadow:0 16px 40px rgba(79,59,42,0.07);">
                <tr>
                    <td style="padding:32px 32px 16px 32px; text-align:center; font-family:Georgia, 'Times New Roman', serif; font-size:30px; color:#7a5a43;">
                        Vecmāmiņas Receptes
                    </td>
                </tr>

                <tr>
                    <td style="padding:8px 32px 0 32px; font-size:13px; letter-spacing:0.14em; text-transform:uppercase; color:#7b6d61; font-weight:700;">
                        E-pasta apstiprināšana
                    </td>
                </tr>

                <tr>
                    <td style="padding:14px 32px 0 32px; font-family:Georgia, 'Times New Roman', serif; font-size:34px; line-height:1.2; color:#7a5a43;">
                        Apstiprini savu e-pastu
                    </td>
                </tr>

                <tr>
                    <td style="padding:20px 32px 0 32px; font-size:16px; line-height:1.8; color:#7b6d61;">
                        Sveiks, {{ $userName }}!
                    </td>
                </tr>

                <tr>
                    <td style="padding:14px 32px 0 32px; font-size:16px; line-height:1.8; color:#7b6d61;">
                        Paldies par reģistrāciju vietnē <strong style="color:#2f241d;">Vecmāmiņas Receptes</strong>.
                        Lai pabeigtu reģistrāciju, lūdzu apstiprini savu e-pasta adresi.
                    </td>
                </tr>

                <tr>
                    <td align="center" style="padding:30px 32px;">
                        <a href="{{ $verificationUrl }}"
                           style="display:inline-block; background:#7a5a43; color:#fffaf4; text-decoration:none; padding:14px 28px; font-size:15px; font-weight:700; border:1px solid #7a5a43;">
                            Apstiprināt e-pastu
                        </a>
                    </td>
                </tr>

                <tr>
                    <td style="padding:0 32px; font-size:15px; line-height:1.8; color:#7b6d61;">
                        Ja neveidoji šo kontu, vari šo e-pastu droši ignorēt.
                    </td>
                </tr>

                <tr>
                    <td style="padding:28px 32px 32px 32px; font-size:15px; line-height:1.8; color:#7b6d61;">
                        Ar cieņu,<br>
                        <strong style="color:#2f241d;">Vecmāmiņas Receptes</strong>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>