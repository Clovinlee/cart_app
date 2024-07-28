<x-app-layout>

   <div class="p-5">
    <div class="form-group">
        <label for="inpMsg">Message</label>
        <input value="Sample Message" type="text" class="form-control" id="inpMsg" aria-describedby="inpMsg" placeholder="Enter Message" name="msg">
    </div>

    <br>

    <div class="form-group">
        <label for="inp1">Number</label>
        <input type="number" value="1" class="form-control" id="inpnumber" aria-describedby="numberHelp"
            placeholder="Enter Number" name="inpNumber">
        <small id="numberHelp" class="form-text text-muted">Only number 1 are authorized for private channel</small>
    </div>

    <button class="btn btn-primary" onclick="handleWebsocket(0)">SEND PUBLIC WEBSOCKET TO ROUTE "/websocket-listen"</button>
    <button class="btn btn-primary" onclick="handleWebsocket(1)">SEND PRIVATE WEBSOCKET TO ROUTE "/websocket-listen"</button>
   </div>
</x-app-layout>

<script>
    // WEBSOCKET
    
    // 0 = public
    // 1 = private
    function handleWebsocket(mode = 0) {
        const message = document.getElementById('inpMsg').value;
        const number = document.getElementById('inpnumber').value;

        axios.post('http://localhost:8001/api/v1/notify', {
                message: message,
                userId: number,
                mode: mode
            })
            .then(response => {
                console.log("Response from server:", response.data);
            })
            .catch(error => {
                console.error("Error:", error);
            });

        console.log("SENT!");
    }

</script>