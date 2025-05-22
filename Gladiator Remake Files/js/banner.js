function mmoDetectDeviceOS()
{
    return (function(ua)
    {
        if(/iPhone/i.test(ua)||/iPad/.test(ua)||/iPod/.test(ua)){return'ios';}
        else if(/Android/.test(ua)){return'android';}
        else if(/Windows Phone OS 7\.0/.test(ua)){return'winphone7';}
        else if(/BlackBerry/.test(ua)){return'rim';}
        else{return'desktop';}})(navigator.userAgent);
}
function mmoSetBannerDeviceOS(iframeStr, os, kid, containerId)
{
    iframeStr = iframeStr.replace('{$random_number}', new Date().getTime());
    iframeStr = iframeStr.replace('{$os}', os);
    iframeStr = iframeStr.replace('{$kid}', kid);

    document.getElementById(containerId).innerHTML = iframeStr;
}