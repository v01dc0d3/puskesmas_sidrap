<script>
$(document).ready(function() {
    let full_name;
    let no_hp;
    $("a#edit_profil").hover(function() {
        $(this).css('cursor','pointer');
    });
    $("a#edit_profil").click(function() {
        $("div.modal_crud").remove();

        let url, modal_id, update_url, post_data;
        if ("<?= $this->session->userdata('id_role'); ?>" == 6) {
            window.location.replace("templates/edit_profil_pasien");
        } else {
            url = "templates/modal_body_edit_profil_pegawai";
            modal_id = "modal_edit_profil_pegawai";
            update_url = "templates/update_profil_pegawai";
        }

        $.ajax({
            url: "<?= base_url(); ?>" + url,
            success: function(result) {
                $("body").append(result);

                $("div#" + modal_id).modal("show");

                if ("<?= $this->session->has_userdata('full_name'); ?>" == "") {
                    $("input#full_name").val(full_name);
                    $("input#no_hp").val(no_hp);
                } else {
                    $("input#full_name").val("<?= $this->session->userdata('full_name'); ?>");
                    $("input#no_hp").val("<?= $this->session->userdata('no_hp') ?>");
                }
                

                $("button#tombol_edit_profil").click(function() {
                    full_name = $("input#full_name").val();
                    no_hp = $("input#no_hp").val();
                    $.ajax({
                        url: "<?= base_url(); ?>" + update_url,
                        data: {
                            "full_name": full_name,
                            "no_hp": no_hp,
                            "id_user": "<?= $this->session->userdata('id_user'); ?>",
                        },
                        method: "POST",
                        success: function(result) {
                            $("div#" + modal_id).modal("hide");
                            if(result == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Perubahan Profil Tersimpan',
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                                $("input#full_name").val(full_name);
                                $("input#no_hp").val(no_hp);
                                $("#topbar_name").html(full_name);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Perubahan Profil Tidak Tersimpan',
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                            }
                        },
                    });
                });
            }
        });
    });
});
</script>