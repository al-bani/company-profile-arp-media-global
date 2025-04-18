@extends('Layout.layoutAdmin')

<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Banner Perusahaan</h1>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </div>

    <form method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center mb-4">
            <!-- Banner 1 -->
            <div class="col-auto">
                <div class="card" style="width: 20rem;">
                    <img id="preview1" src="/img/default.jpg" class="card-img-top" alt="..." style="height: 10rem; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Banner 1</h5>
                        <p class="card-text">Upload dengan Format JPG atau PNG (MAX 5MB)</p>
                        <input type="file" name="banner1" class="form-control" accept="image/*" onchange="previewImage(event, 1)">
                    </div>
                </div>
            </div>

            <!-- Banner 2 -->
            <div class="col-auto">
                <div class="card" style="width: 20rem;">
                    <img id="preview2" src="/img/default.jpg" class="card-img-top" alt="..." style="height: 10rem; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Banner 2</h5>
                        <p class="card-text">Upload dengan Format JPG atau PNG (MAX 5MB)</p>
                        <input type="file" name="banner2" class="form-control" accept="image/*" onchange="previewImage(event, 2)">
                    </div>
                </div>
            </div>

            <!-- Banner 3 -->
            <div class="col-auto">
                <div class="card" style="width: 20rem;">
                    <img id="preview3" src="/img/default.jpg" class="card-img-top" alt="..." style="height: 10rem; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Banner 3</h5>
                        <p class="card-text">Upload dengan Format JPG atau PNG (MAX 5MB)</p>
                        <input type="file" name="banner3" class="form-control" accept="image/*" onchange="previewImage(event, 3)">
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mb-4">
            <!-- Banner 4 -->
            <div class="col-auto">
                <div class="card" style="width: 20rem;">
                    <img id="preview4" src="/img/default.jpg" class="card-img-top" alt="..." style="height: 10rem; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Banner 4</h5>
                        <p class="card-text">Upload dengan Format JPG atau PNG (MAX 5MB)</p>
                        <input type="file" name="banner4" class="form-control" accept="image/*" onchange="previewImage(event, 4)">
                    </div>
                </div>
            </div>

            <!-- Banner 5 -->
            <div class="col-auto">
                <div class="card" style="width: 20rem;">
                    <img id="preview5" src="/img/default.jpg" class="card-img-top" alt="..." style="height: 10rem; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Banner 5</h5>
                        <p class="card-text">Upload dengan Format JPG atau PNG (MAX 5MB)</p>
                        <input type="file" name="banner5" class="form-control" accept="image/*" onchange="previewImage(event, 5)">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function previewImage(event, index) {
            const reader = new FileReader();
            reader.onload = function () {
                const preview = document.getElementById('preview' + index);
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-layout>
