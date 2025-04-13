<x-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perusahaan</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Buat Data Perusahaan</a>
    </div>
    <form action="">
        @csrf
        <div class="mb-3">
            <div class="card" style="width: 18rem;">
                <img src="https://coffective.com/wp-content/uploads/2018/06/default-featured-image.png.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <p class="card-text">Upload dengan Format JPG atau PNG (MAX 5MB)</p>
                  <a href="#" class="btn btn-primary">Upload Logo Perusahaan</a>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1">NIB</label>
            <input class="form-control" id="exampleFormControlInput1" type="Number" placeholder="1234567890123">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1">Notaris</label>
            <input class="form-control" id="exampleFormControlInput1" type="Text" placeholder="No. 05 Tanggal 12 Februari 2023 oleh Notaris Rina Dewi, S.H., M.Kn.">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1">NPWP</label>
            <input class="form-control" id="exampleFormControlInput1" type="Number" placeholder="12.345.678.9-123.000">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1">Deskripsi</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1">Alamat</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="mb-3 row">
            <div class="col">
                <label for="exampleFormControlInput1">Email</label>
                <input class="form-control" id="exampleFormControlInput1" type="email" placeholder="name@example.com">
            </div>
            <div class="col">
                <label for="exampleFormControlInput1">No Telp</label>
                <input class="form-control" id="exampleFormControlInput1" type="number" placeholder="629831267321">
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col">
                <label for="exampleFormControlInput1">Instagram</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col">
                <label for="exampleFormControlInput1">Facebook</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col">
                <label for="exampleFormControlInput1">Tiktok</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col">
                <label for="exampleFormControlInput1">Twitter</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="moto">Moto</label>
            <input class="form-control" id="moto" type="text">
        </div>
        <div class="mb-3 row">
            <div class="col">
                <label for="visi">Visi</label>
                <input class="form-control" id="visi" type="text">
            </div>
            <div class="col">
                <label for="misi">Misi</label>
                <input class="form-control" id="misi" type="text">
            </div>
        </div>
        <select class="btn btn-primary dropdown-toggle form-select" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <option selected>Status</option>
            <option value="anak">Anak Perusaahan</option>
            <option value="perusahaan">Induk Perusahaan</option>
          </select>
    </form>

</x-layout>
