
<div class="bx-social-sharing">

    <?php if(is_array($a['bx_repeat:buttons'])) for($i=0; $i<count($a['bx_repeat:buttons']); $i++){ ?>
        <div class="bx-social-sharing-btn bx-def-margin-sec-top">
            <?=$a['bx_repeat:buttons'][$i]['button'];?>
        </div>
    <?php } else if(is_string($a['bx_repeat:buttons'])) echo $a['bx_repeat:buttons']; ?>

</div>

