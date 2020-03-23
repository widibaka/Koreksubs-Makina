<?php 
$total_page = count($pagination)-1; // Minus 1 to discount 'Prev' or 'Next' button, you know what i mean right? LOL
// var_dump($total_page);
?>
<?php if ($total_page > 1) :?>
<div class="row">
  <div class="col-12">
    <nav class="Page navigation" aria-label="...">
      <ul class="pagination pagination-sm justify-content-center">

        <?php foreach ($pagination as $value) :?>

          <?php 
          # ini adalah pagination buatan saya sendiri.
          # ternyata pusing ya bikin kek begini?
          # I'm doing this because codeigniter has a bug in pagination, so I need to do it manually
          $prev = $current_page-1;
          $next = $current_page+1;

            if ($value == 'Prev') {
              echo '<li class="page-item"><a class="page-link text-'.$theme['accent_color'].' bg-'.$theme['accent_color']
              .'" href="'.$link . $prev . '.asp" id="page-link">' . $value . '</a></li>';
            }
            elseif ($value == 'Next') {
              echo '<li class="page-item"><a class="page-link text-'.$theme['accent_color'].' bg-'.$theme['accent_color']
              .'" href="'.$link . $next . '.asp" id="page-link">' . $value . '</a></li>';
            }
            elseif ($value == $current_page) {
              echo '<li class="page-item disabled"><a class="page-link text-'.$theme['accent_color'].' bg-'.$theme['accent_color']
              .'" href="">' . $value . '</a></li>';
            } 
            //--------------------------------------------------------------
            else {
              echo '<li class="page-item"><a class="page-link text-'.$theme['accent_color']
              .' " href="'.$link . $value . '.asp" id="page-link">' . $value . '</a></li>';
            }   ?>

        <?php endforeach; ?>
      </ul>
    </nav>
  </div>
</div>

<?php endif; ?>

