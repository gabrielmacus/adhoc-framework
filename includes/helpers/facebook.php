<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 01/04/2017
 * Time: 17:46
 */

function getLoginUrlFB($config,$callback)
{
    $fb = new Facebook\Facebook([
        'app_id' => $config["app_id"], // Replace {app-id} with your app id
        'app_secret' => $config["app_secret"],
        'default_graph_version' =>$config["default_graph_version"],
    ]);



    $helper = $fb->getRedirectLoginHelper();

    $loginUrl = $helper->getLoginUrl($callback, $config["permissions"]);

   return htmlspecialchars($loginUrl);
}
function manageRedirectFB($config)
{

        $fb = new Facebook\Facebook([
            'app_id' => $config["app_id"], // Replace {app-id} with your app id
            'app_secret' => $config["app_secret"],
            'default_graph_version' => $config["default_graph_version"],
        ]);

    $helper = $fb->getRedirectLoginHelper();
    $accessToken = $helper->getAccessToken();



// The OAuth 2.0 client handler helps us manage access tokens
    $oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
    $tokenMetadata = $oAuth2Client->debugToken($accessToken);




// Validation (these will throw FacebookSDKException's when they fail)
    $tokenMetadata->validateAppId($GLOBALS["fbConfig"]["app_id"]); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
    $tokenMetadata->validateExpiration();

    if (! $accessToken->isLongLived()) {
        // Exchanges a short-lived access token for a long-lived one
        try {
            $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
            exit;
        }

    }

    return (string)$accessToken;


};