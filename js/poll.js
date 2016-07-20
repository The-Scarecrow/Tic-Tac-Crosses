window.ttcPoll = (function() {
    var onReq = false;
    var loadListeners = [];

    function startPoll(cb) {
        if (onReq) {
            loadListeners.push(cb);
            return;
        }

        onReq = new XMLHttpRequest();
        onReq.addEventListener('load', pollLoaded);
        // todo: remove hardcoding
        onReq.open('GET', 'actions/poll.php?game=1&player=1');
        onReq.send();
    }

    function pollLoaded() {
        var responseData = JSON.parse(onReq.responseText);
        var listenerParams;
        if (!responseData.success) listenerParams = [responseData.error];
        else listenerParams = [null, responseData.messages];

        var listenersCopy = loadListeners;
        loadListeners = [];
        onReq = false;

        for (var i = 0; i < listenersCopy.length; i++) {
            listenersCopy[i].apply(this, listenerParams);
        }
    }

    return startPoll;
}());