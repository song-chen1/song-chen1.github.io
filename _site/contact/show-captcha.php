<?PHP
/*
    Contact Form from HTML Form Guide.
    show-captcha.php is used to display and validate image captcha.

    This program is free software published under the
    terms of the GNU Lesser General Public License.
*/
require_once("./include/fgcontactform.php");
require_once("./include/captcha-creator.php");
session_start();

if(isset($_POST['fg_validate_captcha']))
{
    $captchaobj = new FGCaptchaCreator('scaptcha');
    header("pragma: no-cache");
    header("cache-control: no-cache");

    if(!$captchaobj->ValidateCaptcha($_POST['scaptcha']))
    {
        echo "The code does not match. Please try again!";
    }
    else
    {
        echo "success";
    }
}
else
{
    $captcha = new FGCaptchaCreator('scaptcha');
    header("pragma: no-cache");
    header("cache-control: no-cache");
    $captcha->DisplayCaptcha();
}
?>