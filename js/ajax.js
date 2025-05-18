function sendRequest(method, url, data, showSpinnerId, spinnerClass, spinnerImage, spinnerContent)
{
    data = data + '&a='+ new Date().getTime();
    data = data + '&sh=' + secureHash;

    if (typeof showSpinnerId != 'undefined')
    {
        var showSpinnerObject = $(showSpinnerId);
        if (showSpinnerObject != null)
        {
            var spinnerImageObject = new Object();
            var spinnerContentObject = new Object();
            if (typeof spinnerImage != 'undefined')
                spinnerImageObject['class'] = spinnerImage;
            if (typeof spinnerContent != 'undefined')
                spinnerContentObject['class'] = spinnerContent;

            if (typeof spinnerClass != 'undefined')
                var loadingSpinner = new Spinner(showSpinnerId, {'class': spinnerClass, img: spinnerImageObject, content: spinnerContentObject});
            else
                var loadingSpinner = new Spinner(showSpinnerId, {img: spinnerImageObject, content: spinnerContentObject});
            var req = new Request({
                method: method,
                url: url,
                data: data,
                onRequest: loadingSpinner.show(),
                onComplete: function(response) {
                    loadingSpinner.hide();
                    eval(response);
                },
                onFailure: function(xhr)
                {
                    if (typeof HostApp != 'undefined')
                        HostApp.ShowNoConnectionScreen();
                }
            }).send();
        }
    }
    else
    {
        var req = new Request({
            method: method,
            url: url,
            data: data,
            onComplete: function(response)
            {
                eval(response);
            },
            onFailure: function(xhr)
            {
                if (typeof HostApp != 'undefined')
                    HostApp.ShowNoConnectionScreen();
            }
        }).send();
    }
}