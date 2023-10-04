<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keycloak - PHP</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <script type="text/javascript" src="http://localhost:9090/auth/js/keycloak.js"></script>
    <script type="text/javascript">
        var _kc = new Keycloak();
        function initKeycloak() {
            _kc.init({
                onLoad: 'check-sso',
                pkceMethod: 'S256',
            }).then(function(authenticated) {
                if (authenticated) {
                    document.getElementsByClassName('btn-keycloak-logout')[0].style.display = 'block';
                } else {
                    document.getElementsByClassName('btn-keycloak-login')[0].style.display = 'block';
                }
            }).catch(function() {
                alert('failed to initialize');
            });
        }
    </script>
</head>
<body class="antialiased" onload="initKeycloak()">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div><h2>localhost:9094</h2></div>
    <div>
        <button class="btn-keycloak-login" onClick="_kc.login()" style="display: none">Login</button>
        <button class="btn-keycloak-logout" onClick="_kc.logout()" style="display: none">Logout</button>
    </div>
</div>
</body>
</html>
