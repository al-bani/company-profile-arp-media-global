@extends('Layout.layoutAdmin')

<x-layout>
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://assets.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p3/103/2025/04/04/IMG-20250404-WA0003-3237814259.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="..." class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="..." class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    <div class="mb-2">
        <h4>Daftar Data</h4>
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
