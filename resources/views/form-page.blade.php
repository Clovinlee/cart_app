<x-app-layout>
    <form class="container p-5" method="POST" action="http://localhost:8001/api/v1/form"  onsubmit="handleForm(event)">
        {{-- @csrf --}}
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" value="chris@gmail.com" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                  </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="inpName">Name</label>
                    <input value="Chrisanto" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="name" placeholder="Enter Name" name="name">
                  </div>
            </div>
        </div>
        <br>
        <span>File Privacy</span>
        <div class="d-flex gap-4">
            <div>
                <input class="form-check-input" value="public" type="radio" name="privacy" id="flexRadioDefault1" checked>
                <label class="form-check-label" for="flexRadioDefault1">
                    Public
                </label>
            </div>
            <div>
                <input class="form-check-input" value="private" type="radio" name="privacy" id="flexRadioDefault2" >
                <label class="form-check-label" for="flexRadioDefault2">
                    Private
                </label>
            </div>
        </div>
        <br>
        <label for="inpfile" class="btn btn-secondary btn-lg btn-block w-100" style="">
            Choose File
            <input type="file" name="fileupload" id="inpfile" style="display:none">
            {{-- <input type="file" name="fileupload" id="inpfile" style="display:none" enctype="multipart/form-data"> --}}
        </label>
        <div id="fileDescription" style="display:none" class="mt-2">
            <div class="d-flex align-items-center">
                <span>File chosen: <b><span id="fileName"></span></b></span>
                <button id="clearButton" type="button" class="btn btn-danger mx-3" onclick="clearFile()">Clear</button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block w-100 mt-3">Submit</button>
    </form>
</x-app-layout>

<script>
    const inpFile = document.getElementById('inpfile');
    const fileDescription = document.getElementById("fileDescription");
    inpFile.addEventListener('change', function() {
        fileDescription.style.display = inpFile.files[0] == null ? "none" : "block";
        document.getElementById("fileName").innerText = inpFile.files[0].name;
    });

    function handleForm(e){
        e.preventDefault();
        const data = {};
        
        const formData = new FormData(e.target);
        formData.forEach((value, key) => {
            data[key] = value;
        });

        console.log("DATA====");
        console.log(data);

        axios.post('http://localhost:8000/api/v1/form', formData, {
            headers: {
            }
        }).then(res => {
            console.log("RES===");
            console.log(res);
        }).catch(err => {
            console.log("ERR===");
            console.log(err);
        });

    }

    function clearFile(){
        inpFile.value = "";
        fileDescription.style.display = "none";
    }


</script>