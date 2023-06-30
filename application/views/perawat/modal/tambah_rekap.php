<div class="modal-body">
    <div class="mb-3">
        <label for="pilih_pasien" class="form-label">Pilih Pasien</label>
        <select class="form-select" aria-label="pilih_pasien" id="pilih_pasien"></select>
    </div>

    <div class="mb-3">
        <label for="pilih_ruang" class="form-label">Pilih Ruang</label>
        <select class="form-select" aria-label="pilih_ruang" id="pilih_ruang"></select>
    </div>

    <div class="mb-3">
        <label for="kajian_subjektif">Kajian Subjektif</label>
        <textarea class="form-control" placeholder="Leave a comment here" id="kajian_subjektif" style="height: 300px"></textarea>
    </div>

    <div class="mb-3">
        <label for="kajian_objektif">Kajian Objektif</label>
        <textarea class="form-control" placeholder="Leave a comment here" id="kajian_objektif" style="height: 300px"></textarea>
    </div>

    <div class="mb-3">
        <label for="asuhan">Asuhan Keperawatan/Kebidanan</label>
        <textarea class="form-control" placeholder="Leave a comment here" id="asuhan" style="height: 300px"></textarea>
    </div>

    <div class="mb-3">
        <label for="paraf_paramedis">Paraf Paramedis</label>
        <select class="form-select" name="paraf_paramedis" id="paraf_paramedis">
            <option selected disabled value="">Pilih Paraf Paramedis</option>
            <option value="terima">Terima</option>
            <option value="tolak">Tolak</option>
        </select>
    </div>
</div>
<div class="modal-footer">
    <button type="button" id="tombol_tambah_rekap" class="btn btn-success">Tambah</button>
</div>