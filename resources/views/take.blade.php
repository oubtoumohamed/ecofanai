@extends('layouts.app')

@section('content')

<script src="{{ asset('assets/js/html5-qrcode.min.js') }}"></script>


<form id="scanbin" class="card" enctype="multipart/form-data">
    <div class="card-body">
        <ul class="nav nav-pills animation-nav nav-justified gap-2 mb-3" role="tablist">
            <li class="nav-item waves-effect waves-light">
                <a class="nav-link fs-12 active" data-bs-toggle="tab" href="#animation-home" role="tab"><i class="ri-qr-scan-2-line fs-16 rounded-circle align-middle me-2"></i>Scan Qrcode</a>
            </li>
            <li class="nav-item waves-effect waves-light">
                <a class="nav-link fs-12" data-bs-toggle="tab" href="#animation-profile" role="tab"><i class="ri-vidicon-2-line fs-16 bg-primary-subtle rounded-circle align-middle me-2"></i> Take a video</a>
            </li>
        </ul>
        <div class="tab-content text-muted">
            <div class="tab-pane active" id="animation-home" role="tabpanel">
                <!--p class="text-muted mb-3">Please fill scan bin qrcode</p-->
                
                <input type="text" id="qrcodetext" name="qrcodetext" class="form-control mb-2" placeholder="Qrcode ...." />
                <div id="qr-reader"></div>
            </div>
            <div class="tab-pane" id="animation-profile" role="tabpanel">
                <!--p class="text-muted mb-3">Record a Video from Camera</p-->
                
                <div>
                    <video id="video" style="border: solid 1px #ccc; width: 100%;" class="mb-3" autoplay controls=""></video>
                    
                    <button id="recordButton" type="button" class="btn btn-soft-secondary waves-effect waves-light material-shadow-none"> <i class="ri ri-play-circle-line fs-16"></i> Start Recording</button>
                    <button id="stopButton" disabled type="button" class="btn btn-soft-danger waves-effect waves-light material-shadow-none"> <i class="ri ri-stop-circle-line fs-16"></i>Stop</button>
                    
                    <button id="uploadButton" disabled type="button" class="w-100 mt-4 btn btn-soft-success waves-effect waves-light material-shadow-none"><i class="ri-upload-2-fill fs-20"></i>  Upload your video now</button>
                </div>
            </div>
            <div class="tab-pane" id="animation-messages" role="tabpanel">
                
            </div>
            <div class="tab-pane" id="animation-settings" role="tabpanel">
                
            </div>
        </div>
    </div>
</form>


    <script>
        async function onScanSuccess(decodedText, decodedResult = "") {
            if (html5QrcodeScanner && html5QrcodeScanner.html5Qrcode)
                html5QrcodeScanner.html5Qrcode.stop();

            $('#qrcodetext').val(decodedText);

            $('#qr-reader__dashboard_section_csr button').toggle();
            $('#qr-reader__dashboard_section_csr button').removeAttr('disabled');
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            }
        );
        html5QrcodeScanner.render(onScanSuccess);

        let mediaRecorder;
        let recordedBlobs;
        let videoElement = document.getElementById('video');
        let recordButton = document.getElementById('recordButton');
        let stopButton = document.getElementById('stopButton');
        let uploadButton = document.getElementById('uploadButton');

        // Access user's camera
        async function startCamera() {
            try {
                stream = await navigator.mediaDevices.getUserMedia({
                    //audio: true,
                    video: {
                        facingMode: {
                            exact: 'environment'
                        }
                    },
                });
                videoElement.srcObject = stream;

                // Create a MediaRecorder to record the video
                mediaRecorder = new MediaRecorder(stream);
                recordedBlobs = [];

                // Event when data is available to be recorded
                mediaRecorder.ondataavailable = handleDataAvailable;
                mediaRecorder.onstop = handleStop;
            } catch (err) {
                console.error("Error accessing camera:", err);
            }
        }

        // Handle when video data is available
        function handleDataAvailable(event) {
            if (event.data.size > 0) {
                recordedBlobs.push(event.data);
            }
        }

        // Handle when recording is stopped
        function handleStop() {
            const superBuffer = new Blob(recordedBlobs, { type: 'video/webm' });
            // Prepare to upload the video by creating a FormData object
            const videoFile = new File([superBuffer], 'recorded-video.webm', { type: 'video/webm' });
            console.log(URL.createObjectURL(superBuffer))
            videoElement.srcObject = null;
            videoElement.src = URL.createObjectURL(superBuffer);
            videoElement.load();
            videoElement.onloadeddata = function() {
                videoElement.play();
            }
            // Enable the upload button after recording is stopped
            uploadButton.disabled = false;

            // Set the video file for upload (via AJAX)
            uploadButton.onclick = () => uploadVideo(videoFile);
        }

        // Start recording
        recordButton.addEventListener('click', async () => {
            await startCamera();
            recordedBlobs = [];
            mediaRecorder.start();
            recordButton.disabled = true;
            stopButton.disabled = false;
            uploadButton.disabled = true; // Disable upload button until recording stops
            console.log('Recording started');
        });

        // Stop recording
        stopButton.addEventListener('click', () => {
            mediaRecorder.stop();
            stream.getTracks()[0].stop();
            recordButton.disabled = false;
            stopButton.disabled = true;
            uploadButton.disabled = false; // Enable upload button after recording stops
            console.log('Recording stopped');
        });

        // Upload the video via AJAX
        function uploadVideo(videoFile) {
            var formData = new FormData($('#scanbin')[0]);
            formData.append('video', videoFile);

            $.ajax({
                url: "{{ route('upload_video') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data : formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function(result){
                    if( result.error )
                        swal.fire({
                            title: '<strong>Error</strong>',
                            text: result.error ,
                            icon: 'error',
                        });
                    if( result.success )
                        swal.fire({
                            title: '<strong>Done!</strong>',
                            text: result.success ,
                            icon: 'success',
                        });
                }
            }).catch(e => {});
        }
    </script>

@endsection