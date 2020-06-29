<!-- SweetAlert2 -->
<script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2@9.js"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/') ?>plugins/toastr/toastr.min.js"></script>



<!-- AJAX Form AddEpisode -->

<script>

  // for modal for edit episode STARTS

  function myFunction(item, index) {
    $('#inputan'+index).val(item);
  }
  function updateEpisode(anime_child_id) {

    $('#links_in_modal').empty(); // kosongkan dulu tampilan input  links di modal

    let url = "<?php echo base_url('getepisode/index/') ?>"+anime_child_id;
    $.get(url, function(data_mentah, status){
      let data = JSON.parse(data_mentah);
      // console.log(data.converted_links);
      $('#anime_child_id').val(data.anime_child_id);
      $('#anime_child_id').val(data.anime_child_id);

// alert(data.converted_links.length)
      let jumlah_link = data.converted_links.length; // mengetahui jumlah inputan yang sudah ada
      for (let id_now = 0; id_now < jumlah_link; id_now++) {
        // console.log(0)
        let id_plus_satu = id_now++;
        let to_be_append = '<input type="text" class="form-control col-md-8 mt-1 link_in_modal" placeholder="Link '+id_plus_satu+'..." id="inputan'+id_plus_satu+'" ><input type="text" class="form-control col-md-4 mt-1 nama_link" id="inputan'+id_now+'" placeholder="Nama link '+id_now+'...">';
        $('#links_in_modal').append(to_be_append);
      }

      data.converted_links.forEach(myFunction); // dimasukin ke inputan
    })
   }

   $("#simpan_perubahan_episode").click(function(){
      let jumlah_link = $('.link_in_modal').length; // mengetahui jumlah inputan yang sudah ada
      // alert(jumlah_link)
      for (let i = 0; i < jumlah_link*2; i++) {
        let data = $('#inputan'+i).val();
        if (data.length > 0) {
            let to_be_append = data+'@';
            let link_content_that_already_in = $('#links_edit').val();
            // Im exhausted
            $('#links_edit').val(link_content_that_already_in+to_be_append);
        }
        
      }
      
   })
  // for modal for edit episode ENDS

  $(document).ready(function(){

    $('#delete_all_episode').on('click',function() {
      delete_all_episode_Confirm();
    });

    $('#form_multiple_episode').on('submit',function(e) {
      e.preventDefault();
      // Disable button to avoid double submit
      $("#add_multiple_episodes_button").text('Wait...');
      $("#add_multiple_episodes_button").attr("disabled", "disabled");
      $("#add_multiple_episodes_button").addClass("disabled");
      $("#add_multiple_episodes_button").removeClass("btn-primary");
      $("#add_multiple_episodes_button").addClass("btn-secondary");

      $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function() {
          successAddEpsAlert();
          // Turn it back when success
          $("#add_multiple_episodes_button").text('Add multiple episodes');
          $("#add_multiple_episodes_button").removeAttr("disabled");
          $("#add_multiple_episodes_button").removeClass("disabled");
          $("#add_multiple_episodes_button").addClass("btn-primary");
          $("#add_multiple_episodes_button").removeClass("btn-secondary");

        }
      }
      );
    });


    $('#form_add_episode').on('submit',function(e) {
      e.preventDefault();
      // menyusun semua link dan nama link ke dalam textarea 'links'
      for (var i = 1; i < $('.nama_link').length+1; i++) {
        let link = $('#link'+i).val();
        let nama_link = $('#nama_link'+i).val();
        let to_be_append = link+'@'+nama_link+'@';
        let link_content_that_already_in = $('#links').val();
        // Am I clear? LOL wkwkwk
        $('#links').val(link_content_that_already_in+to_be_append);
      }
      // Disable button to avoid double submit
      $("#add_new_episode_button").text('Wait...');
      $("#add_new_episode_button").attr("disabled", "disabled");
      $("#add_new_episode_button").addClass("disabled");
      $("#add_new_episode_button").removeClass("btn-primary");
      $("#add_new_episode_button").addClass("btn-secondary");
      $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function() {
          successAddEpsAlert();
          // Turn it back when success
          $("#add_new_episode_button").text('Add a new episode');
          $("#add_new_episode_button").removeAttr("disabled");
          $("#add_new_episode_button").removeClass("disabled");
          $("#add_new_episode_button").addClass("btn-primary");
          $("#add_new_episode_button").removeClass("btn-secondary");

        }
      }
      );
    });

    $('#form_progress').on('submit',function(e) {
      e.preventDefault();
      // Disable button to avoid double submit
      $("#progress_submit").text('Wait...');
      $("#progress_submit").attr("disabled", "disabled");
      $("#progress_submit").addClass("disabled");
      $("#progress_submit").removeClass("btn-primary");
      $("#progress_submit").addClass("btn-secondary");
      $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function() {
          progressSimpan();
          // Turn it back when success
          $("#progress_submit").text('Add a new episode');
          $("#progress_submit").removeAttr("disabled");
          $("#progress_submit").removeClass("disabled");
          $("#progress_submit").addClass("btn-primary");
          $("#progress_submit").removeClass("btn-secondary");

        }
      }
      );
    });
<?php if (!empty($episodes)) : ?>
  // Untuk tombol delete yang banyak, sebanyak episodenya
  <?php foreach ($episodes as $eps) :?>
        //untuk button hapus episode
      $('#form_hapus_episode-<?= $eps['anime_child_id']; ?>').on('submit',function(e) {
        e.preventDefault();
        $("#episode-<?= $eps['anime_child_id']; ?>").addClass("d-none");
        $.ajax({
          type: $(this).attr('method'),
          url: $(this).attr('action'),
          data: $(this).serialize(),
          success: function() {
            successDeleteAlert();
          }
        }
        );
      })
  <?php endforeach; ?>
<?php endif; ?>
    function successAddEpsAlert() {
      swal.fire({
        title: "Episode berhasil ditambahkan",
        icon: "success",
        showCancelButton: true,
        confirmButtonText: "Refresh",
        cancelButtonText: "Close",
        allowOutsideClick: false,
      }).then((result) => {
        if (result.value) {
          location.href='<?= base_url("admin/episode_manager/" . "$id") ?>';
        }
      })
    }

    function successDeleteEpsAlert() {
      swal.fire({
        title: "Episode berhasil dihapus",
        icon: "success",
        showCancelButton: true,
        confirmButtonText: "Refresh",
        cancelButtonText: "Close",
        allowOutsideClick: false,
      }).then((result) => {
        if (result.value) {
          location.href='<?= base_url("admin/episode_manager/" . "$id") ?>';
        }
      })
    }

    function delete_all_episode_Confirm() {
      swal.fire({
        title: "Anda yakin ingin menghapus semuanya?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "DELETE ALL!",
        confirmButtonColor: 'red',
        cancelButtonText: "Close",
        allowOutsideClick: false,
      }).then((result) => {
        if (result.value) {
          location.href='<?php echo base_url('admin/delete_all_episode/' . $id); ?>';
        }
      })
    }

    function progressSimpan() {
      swal.fire({
        title: "Progres berhasil diubah",
        icon: "success",
        showCancelButton: true,
        confirmButtonText: "Refresh",
        cancelButtonText: "Close",
        allowOutsideClick: false,
      }).then((result) => {
        if (result.value) {
          location.href='<?= base_url("admin/episode_manager/" . "$id") ?>';
        }
      })
    }

  });


    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    function successDeleteAlert() {
      Toast.fire({
        type: 'success',
        title: 'Berkas episode berhasil dihapus'
      })
    }

</script>

<!-- DataTables -->
<script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#download_section").DataTable({
      "ordering": false,
      "border" : false
    });
  });
</script>

  <script type="text/javascript">
    function encodeBase64(string){
      // Encode the String
      var encodedString = window.btoa(string);
      return(encodedString);
    }
    function getMetaOfLink(nomor){
      if (nomor == 1) { // jika dan hanya jika yang diisi adalah yang input pertama
        $('#file_name'+nomor).addClass('bg-lime');
        $('#file_name'+nomor).val("Loading ...");
      }
      $('#nama_link'+nomor).val("Loading ...");
      $('#nama_link'+nomor).addClass('bg-lime');
      var link = $('#link'+nomor).val();
      var encodedLink = encodeBase64(link);
      var url = "<?php echo base_url('getlinkmetadata/index/') ?>"+encodedLink;
      // console.log(url)
      
      $.get(url, function(data_mentah, status){
        var data = JSON.parse(data_mentah); // ternyata json harus diparse dulu, hehe. gak bisa langsung diakses
          // console.log(data.og_title);
          
          if (data.og_title && $('#file_name'+nomor)) {
            $('#file_name'+nomor).val(data.og_title);
          }else{
            $('#file_name'+nomor).val(data.page_title);
          }
          if (data.og_site_name) {
            $('#nama_link'+nomor).val(data.og_site_name);
          }else{
            $('#nama_link'+nomor).attr("placeholder", "No data. Isi manual dong ...");
            $('#nama_link'+nomor).val("");
          }
          $('#file_name'+nomor).removeClass('bg-lime');
          $('#nama_link'+nomor).removeClass('bg-lime');

      });
    }
    function tambah_link(){
      let jumlah = $('.nama_link').length; // mengetahui jumlah inputan yang sudah ada
      // alert(jumlah);
      let id_now = jumlah+1;
      let to_be_append = '<input type="text" class="form-control col-md-8 mt-1" placeholder="Link '+id_now+'..." name="link'+id_now+'"  id="link'+id_now+'" onchange="getMetaOfLink('+id_now+')"><input type="text" class="form-control col-md-4 mt-1 nama_link" id="nama_link'+id_now+'" placeholder="Nama link '+id_now+'..." name="nama_link'+id_now+'" required>';
      $('#link_inputs').append(to_be_append);
    }
    function kurangi_link(){
      let jumlah = $('.nama_link').length; // mengetahui jumlah inputan yang sudah ada
      // alert(jumlah);
      if (jumlah>1) {
        $('#link'+jumlah).remove();
        $('#nama_link'+jumlah).remove();
      }
    }

  </script>
