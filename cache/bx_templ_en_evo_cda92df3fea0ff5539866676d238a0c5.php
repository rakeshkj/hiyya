
<div class="bx_events_block_info">
    <div class="infoMain">        
        <?=$a['author_unit'];?>
        <div class="infoText bx-def-margin-sec-top">
            <div class="infoUnit infoUnitFontIcon">
               <b> Match Type : </b>  <?=$a['match_type'];?>
            </div>
			<!--div class="infoUnit infoUnitFontIcon">
               <b> Match Size : </b> <?=$this->parseSystemKey('match_size', $mixedKeyWrapperHtml);?>
            </div-->
			<div class="infoUnit infoUnitFontIcon">
              <b> Maximum Substitute : </b> <?=$a['max_subtitude'];?>
            </div>
			<!--div class="infoUnit infoUnitFontIcon">
               <b> Place : </b> <?=$a['place'];?>
            </div--> 
			<div class="infoUnit infoUnitFontIcon">
             <b> Start Date : </b> <?=$a['start_date'];?>
            </div> 
			<div class="infoUnit infoUnitFontIcon">
             <b> End Date : </b> <?=$a['end_date'];?>
            </div> 
			<div class="infoUnit infoUnitFontIcon">
             <b> Match Start Time : </b> <?=$a['match_time'];?>
            </div>
			<div class="infoUnit infoUnitFontIcon">
             <b> Block Booking : </b> <?=$a['block_booking'];?>
            </div>
			<div class="infoUnit infoUnitFontIcon">
             <b> Playground: </b> <a href="<?=$a['playground'];?>" target="_blank"><?=$a['pgtitle'];?> </a>
            </div>
			<!--div class="infoUnit infoUnitFontIcon">
              <b> Indoor : </b>  <?=$this->parseSystemKey('indoor', $mixedKeyWrapperHtml);?>
            </div--> 
			<div class="infoUnit infoUnitFontIcon">
              <b> Maximum Age : </b> <?=$a['max_age'];?>
            </div>
			<div class="infoUnit infoUnitFontIcon">
              <b> Gender : </b> <?=$a['gender'];?>
            </div>		
			<div class="infoUnit infoUnitFontIcon">
              <b> Payment : </b> <?=$a['payment'];?>
            </div>
			<div class="infoUnit infoUnitFontIcon">
              <b> Match Status : </b> <?=$a['match_status'];?>
            </div>
        </div>
    </div>
</div>

