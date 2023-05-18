<div class="modal-body">
    <div class="mb-3">
        <label for="nama_pasien">Nama Pasien</label>
        <input type="text" class="form-control" id="nama_pasien" value="<?= $nama_kk; ?>" disabled>
    </div>

    <div class="mb-3">
        <label for="anamnesa">Anamnesa Hasil Pemeriksaan</label>
        <textarea class="form-control" placeholder="Masukkan Anamnesa" id="anamnesa"></textarea>
    </div>

    <div class="mb-3">
        <label for="saran">Saran/Therapi</label>
        <textarea class="form-control" placeholder="Masukkan Saran" id="saran"></textarea>
    </div>
</div>
<div class="modal-footer">
    <button type="button" id="tombol_tambah_rekam" class="btn btn-success">Tambah</button>
</div>