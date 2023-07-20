<?php
session_start();
/**** calls SL connexion and redirects to SMF root's index file with account info in session variables ****/
/* see https://hybridauth.github.io/introduction.html */
/* and https://hybridauth.github.io/developer-ref-user-authentication.html */

// Include Composer's autoloader
include 'vendor/autoload.php';

// constant vars
define('JSONFILE', 'accounts/networks.json');

// local vars

if (isset($_SESSION['social_login'])) $network = $_SESSION['social_login'];
else {
    $network = array_key_first($_GET);
    $_SESSION['social_login'] = $network;
}

if (!isset($_SESSION['path'])) $_SESSION['path'] = $_GET['path'];
$path = $_SESSION['path'];
$json = file_get_contents(JSONFILE);
$json_data = json_decode($json,true);
$id = "";
$secret = "";

// get credential keys from the json file
if ($json_data) {
    foreach ($json_data as $key => $value) {
        // from here : key : "keys". value : "network + id + secret"
        foreach ($value as $key => $value) {
            if ($network == $value['network']) {
                $id = $value['id'];
                $secret = $value['secret'];
            }
        }
    }
} else {
    $errorMsgTag = "emptyNetworkJsonFile";
}

// Build configuration array with the keys
$config = [
    // Location where to redirect users once they authenticate with the network provider is this same script's 
    // Don't gorget to add the url to the "Authorized redirect URLs for your app" social networks 
    'callback' => $path . '/social_login?' . $network,
    // network provider's application credentials
    'keys' => [
        'id' => $id,
        'secret' => $secret
    ]
];

$isConnected = false;

try {
    // will not go further if network json file is empty
    if (isset($errorMsgTag)) throw new Exception($errorMsgTag, 1);
    
    // Instantiate network provider's adapter directly
    $classInstancier = "Hybridauth\\Provider\\".$network;
    $adapter = new $classInstancier($config);

    if (!$adapter->isConnected()) {
        // Attempt to authenticate the user with Facebook
        $adapter->authenticate();

        // Returns a boolean of whether the user is connected with the network provider
        $isConnected = $adapter->isConnected();
     
        // Retrieve the user's profile
        $userProfile = $adapter->getUserProfile();

        // Inspect profile's public attributes
        // var_dump($userProfile);

        // Disconnect the adapter (log out)
        $adapter->disconnect();
    } else {
        $isConnected = true;
        $userProfile = $adapter->getUserProfile();
        $adapter->disconnect();
    }
}
catch(\Exception $e){
    // creating the error msg tag
    if (isset($errorMsgTag)) $_SESSION['connection_pb'] = $errorMsgTag;
    // SL errors only pop up
    else echo '<script type="text/javascript">alert("', $e->getMessage(), '");', '</script>';
}

?>
<!DOCTYPE html>
<html>
<!-- if no error, will send the user login elements to the default index page -->
<?php if ($isConnected) {
    // needed for naytheet to handle social login
    $_SESSION['firstnameLastname'] = $userProfile->displayName;
    $_SESSION['email'] = $userProfile->email;
    $_SESSION['photoURL'] = $userProfile->photoURL;
}
?>
    <script type="text/javascript">window.location.href = "<?php echo $path; ?>/index.php?action=login";</script>
</html>