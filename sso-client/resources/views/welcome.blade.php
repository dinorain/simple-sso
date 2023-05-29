<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="referrer" content="no-referrer-when-downgrade" />

        
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body>
        <meta name="auto_height" content="true"/>
        <meta name="auto_width" content="true"/>
        <script src="https://accounts.google.com/gsi/client" referrerpolicy="same-origin-allow-popups" async defer></script>
        <div id="fb-root"></div>
        <script>
            function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
                console.log('statusChangeCallback');
                console.log(response);                   // The current login status of the person.
                if (response.status === 'connected') { 
                    console.log('acces token, ' + response.authResponse.accessToken + '.');  // Logged into your webpage and Facebook.
                    testAPI();  
                } else {                                 // Not logged into your webpage or we are unable to tell.
                    document.getElementById('status').innerHTML = 'Please log ' +
                    'into this webpage.';
                }
            }
            function checkLoginState() {               // Called when a person is finished with the Login Button.
                FB.getLoginStatus(function(response) {   // See the onlogin handler
                    statusChangeCallback(response);
                });
            }
            window.fbAsyncInit = function() {
                FB.init({
                    appId            : '833596231683665',
                    autoLogAppEvents : true,
                    xfbml            : false,
                    version          : 'v17.0'
                });

                FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
                    statusChangeCallback(response);        // Returns the login status.
                });
                // FB.login(function(response){
                //     if (response.status === 'connected') {
                //         console.log('Welcome!  Fetching your information.... ');
                //         console.log('acces token, ' + response.authResponse.accessToken + '.');
                //         FB.api('/me', function(response) {
                //             console.log('Good to see you, ' + response.name + '.');
                //             console.log('Email, ' + response.email + '.');
                //         });
                //     } else {
                //         console.log('User cancelled login or did not fully authorize.');
                //     }
                // }, {scope: 'public_profile,email'});

                // FB.logout(function(response) {
                //     // Person is now logged out
                // });
            };

            function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
                console.log('Welcome!  Fetching your information.... ');
                FB.api('/me', function(response) {
                console.log('Successful login for: ' + response.name);
                document.getElementById('status').innerHTML =
                    'Thanks for logging in, ' + response.name + '!';
                });
            }
            </script>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v17.0&appId=833596231683665&autoLogAppEvents=1" nonce="RXgYKalC"></script>
        <script>
            function decodeJwtResponse(token) {
                let base64Url = token.split('.')[1]
                let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                let jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                }).join(''));
                return JSON.parse(jsonPayload)
            }
        
            let responsePayload;
            function handleCredentialResponse(response) {
                // decodeJwtResponse() is a custom function defined by you
                // to decode the credential response.
                responsePayload = decodeJwtResponse(response.credential);
        
                console.log("ID: " + responsePayload.sub);
                console.log('Full Name: ' + responsePayload.name);
                console.log('Given Name: ' + responsePayload.given_name);
                console.log('Family Name: ' + responsePayload.family_name);
                console.log("Image URL: " + responsePayload.picture);
                console.log("Email: " + responsePayload.email);
                console.log("token: " + response.credential);
            }
        </script>

        <div id="g_id_onload"
        data-client_id="437985830816-df512vs6vq9p1l1fbgjh2g53n89a1s9d.apps.googleusercontent.com"
        data-context="signin"
        data-ux_mode="popup"
        data-callback="handleCredentialResponse"
        data-nonce=""
        data-auto_prompt="false">
        </div>

        <div class="g_id_signin"
        data-type="standard"
        data-shape="pill"
        data-theme="outline"
        data-text="signin_with"
        data-size="large"
        data-logo_alignment="left">
        </div>

        <br>
        <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
        </fb:login-button>

        <br>
        <div id="appleid-signin"></div>

        <script type="text/javascript" src="https://appleid.cdn-apple.com/appleauth/static/jsapi/appleid/1/en_US/appleid.auth.js"></script>
        <script type="text/javascript">
            AppleID.auth.init({
                clientId : 'com.depatu.stagingid',
                scope : 'email',
                redirectURI : 'https://staging.depatu.com/api/auth/apple-callback',
                state : 'origin:web',
                nonce : '[NONCE]',
                usePopup : true
            });

            document.addEventListener('AppleIDSignInOnSuccess', (event) => {
                // Handle successful response.
                console.log(event.detail.data);
            });

            document.addEventListener('AppleIDSignInOnFailure', (event) => {
                // Handle error.
                console.log(event.detail.error);
            });
        </script>
    </body>
</html>
