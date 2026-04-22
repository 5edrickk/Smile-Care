<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 8px;
            padding: 40px;
            border: 1px solid #e0e0e0;
        }
        .logo {
            font-size: 22px;
            font-weight: bold;
            color: #1a73e8;
            margin-bottom: 24px;
        }
        h1 {
            font-size: 20px;
            color: #1a1a1a;
            margin-bottom: 12px;
        }
        p {
            font-size: 15px;
            color: #444;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            margin: 24px 0;
            padding: 14px 28px;
            background-color: #1a73e8;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: bold;
        }
        .expire {
            font-size: 13px;
            color: #888;
            margin-top: 16px;
        }
        .footer {
            margin-top: 32px;
            font-size: 12px;
            color: #aaa;
            border-top: 1px solid #eee;
            padding-top: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">SmileCare</div>

        <h1>Bonjour {{ $prenom }},</h1>

        <p>
            Une tentative de connexion a été détectée sur votre compte.
            Pour compléter votre authentification, cliquez sur le bouton ci-dessous.
        </p>

        <a href="{{ $lienVerification }}" class="btn">
            Vérifier ma connexion
        </a>

        <p class="expire">
            Ce lien expire dans {{ $expiration }} minutes.
            Si vous n'avez pas tenté de vous connecter, ignorez ce courriel.
        </p>

        <div class="footer">
            SmileCare — Clinique dentaire<br>
            Ce courriel a été envoyé automatiquement, merci de ne pas y répondre.
        </div>
    </div>
</body>
</html>
