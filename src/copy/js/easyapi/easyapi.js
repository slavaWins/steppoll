var EasyApi = {};

EasyApi.Post = function (url, date, callback, callbackError) {
    date._token = $('meta[name="csrf-token"]').attr('content');
    $.post(url, date, function (response) {
        var error = null;
        if (response['error']) {
            console.log(url + " ERROR: " + response.message);
            error = response.message;
        }
        callback(response, error);
    });
}

EasyApi.new = function () {
    var self = {};
    return self;
};


window.EasyApi = EasyApi;
