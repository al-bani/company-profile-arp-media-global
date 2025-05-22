<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Edit Partner</h1>
    </div>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Data Partner</h6>
        </div>
        <div class="card-body">
            <form action="/dashboard/partner/{{ $partner->id }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <!-- Nama Partner -->
                <div class="mb-3">
                    <label for="nama_partner" class="form-label">Nama Partner</label>
                    <input class="form-control" id="nama_partner" name="nama_partner" type="text"
                        placeholder="Masukkan nama partner">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" id="email" name="email" type="email"
                        placeholder="partner@example.com">
                </div>

                <!-- foto -->
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img id="preview" src="/img/default.jpg" class="card-img-top border" alt="Logo Partner"
                            style="height: 10rem; width: 10rem; object-fit: cover;">
                    </div>
                    <div class="mb-3">  
                        <label for="foto">Logo</label>
                        @if ($partner->foto)
                            <img src="{{ asset($partner->foto) }}"  alt="foto" width="100" class="mb-2">
                        @endif
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    </div>
                </div>


            </form>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-layout>
