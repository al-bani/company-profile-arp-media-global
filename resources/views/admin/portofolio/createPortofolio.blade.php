<x-layout>

    <!-- Card Wrapper -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Portofolio</h6>
        </div>
        <div class="card-body"> 

            <form action="">     #carouselExample 
                @csrf

                <div class="mb-3">
                    <label for="Nama_Perusahaan">Nama Project</label>
                    <input class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Nama Project" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi">Deskripsi Project</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                </div>

                <div class="mb-2">
                    <label for="deskripsi">Deskripsi Client</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="Nama_Perusahaan">Logo Client</label>
                    <input type="file" id="logo" name="logo" class="form-control" accept="image/*" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi">Konsep Project</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                </div>


                <label for="timeline">Timeline</label>
                <div id="input-container" class="timeline">
                    <div class="mb-3">
                        <input type="text" name="fields[]" class="form-control" placeholder="Masukkan sesuatu">
                    </div>
                </div>
        
                <button type="button" class="btn btn-secondary mb-3" id="add-field">+ Tambah Field</button>

                <div class="mb-3 text-center">
                    <a href="/dashboard/homePortofolio" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const maxFields = 5;
        const container = document.getElementById('input-container');
    
        document.getElementById('add-field').addEventListener('click', function () {
            const currentFields = container.querySelectorAll('input[name="fields[]"]').length;
    
            if (currentFields < maxFields) {
                const newField = document.createElement('div');
                newField.classList.add('mb-3');
                newField.innerHTML = `<input type="text" name="fields[]" class="form-control" placeholder="Masukkan sesuatu">`;
                container.appendChild(newField);
            } else {
                alert("Maksimal hanya 5 field yang boleh ditambahkan.");
            }
        });
    </script>
</x-layout>
