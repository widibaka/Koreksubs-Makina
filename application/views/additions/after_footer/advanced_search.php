
<!-- Untuk mengubah pagination link agar parameternya tidak hilang-->
<script>

  $(document).ready(function(){
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };

    function getParameterCustomed(param) {
      if (getUrlParameter(param) === undefined) {
        return '';
      }
      else {
        return getUrlParameter(param);
      }
    };

    var nama_anime = getParameterCustomed('nama_anime');
    var rating_from = getParameterCustomed('rating_from');
    var rating_to = getParameterCustomed('rating_to');
    var season = getParameterCustomed('season');
    var year = getParameterCustomed('year');
    var suffix = "?nama_anime=" + nama_anime + "&rating_from=" + rating_from + "&rating_to=" + rating_to + "&season=" + season + "&year=" + year + "";
    $('.page-link').each(function(){ 
        var oldUrl = $(this).attr("href"); // Get current url
        var newUrl = oldUrl.concat("", suffix); // Create new url
        $(this).attr("href", newUrl); // Set herf value
    });

  });
</script>

<!-- Ion Slider -->
<script src="<?= base_url('assets/'); ?>plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
<script>

    $("#rating_range").ionRangeSlider({
        skin    : 'round',
        min     : 0,
        max     : 99,
        from    : 60,
        to      : 99,
        type    : 'float',
        step    : 0.1,
        postfix  : '%',
        prettify: false,
        hasGrid : true,
        onStart: function (data) {

            // Called right after range slider instance initialised
            $('#rating_from').val(data.from);         // FROM value
            $('#rating_to').val(data.to);           // TO value
            $('#a_rating_from').text(data.from); 
            $('#a_rating_to').text(data.to);  
        },
    
        onChange: function (data) {
            // Called every time handle position is changed
    
            $('#rating_from').val(data.from);
            $('#a_rating_from').text(data.from); 
        },
    
        onFinish: function (data) {
            // Called then action is done and mouse is released
    
            $('#rating_to').val(data.to);
            $('#a_rating_to').text(data.to); 
        }
    });
</script>


