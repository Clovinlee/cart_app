<x-app-layout>
    Now Listening to Websocket! <br><i>(Check Console)</i>
</x-app-layout>

<script>
    // PRIVATE CHANNEL

    setTimeout(() => {
        // Usually, this is used to ensure that the user is authenticated before listening to the private channel
        // window.Echo.private("TestChannelPrivate.user.{{Auth::id()}}")

        // But for testing purpose, the channel only listen to user.1
        window.Echo.private("TestChannelPrivate.user.1").listen("TestPrivateEvent", (e) => {
            console.log("Message from Private Websocket :");
            console.log(e);
        });
    }, 200);
    // DELAY of 200ms (example) are needed, otherwise Echo are not initialized first


    // PUBLIC CHANNEL

    setTimeout(() => {
        //TestChannel <- name of the class
        window.Echo.channel('TestChannel').listen('TestEvent', (e) => {
            console.log("Message from Public Websocket :");
            console.log(e);
        });
    }, 200);
</script>