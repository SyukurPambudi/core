<script type="text/javascript">
//create autocomplete raw material
var config = {
	source: base_url+'processor/pdv/admin/tools/stakeholder?action=employee_list',					
	select: function(event, ui){
		var i = $('.vName_teami_div_cNip').index(this);
		$('.vName_teami_div_cNip').eq(i).val(ui.item.id);						
	},
	minLength: 2,
	autoFocus: true,
};
$(".vName_teami_div").livequery(function(){
	$(this).autocomplete(config);
	var i = $('.vName_teami_div').index(this);
	$(this).keypress(function(e){
		if(e.which != 13) {
			$('.vName_member_div_cNip').eq(i).val('');
		}			
	});
	$(this).blur(function(){
		if($('.vName_member_div_cNip').eq(i).val() == '') {
			$(this).val('');
		}			
	});
})
	
	// packdev admin tools stakeholder
$('.vName_teami_div_add').live('click', function() {
	var row = '<tr><td style="text-align: right"><span class="numberlist"></span></td><td style="text-align: center"><input class="vName_teami_div_cNip" name="nip[]" type="hidden" ><input class="input_rows-table vName_teami_div" style="width: 98%" name="name[]" type="text" ></td><td style="text-align: center">[ <a href="javascript:;" class="vName_teami_div_del">Hapus</a> ]</td></tr>';		
	$("span.numberlist:first").text('1');
	var n = $("span.numberlist:last").text();
	//alert(n);
	var no = parseInt(n);
	var c = no + 1;		
	$('table#vName_teami_div_table tbody tr:last').after(row);
	$("table#vName_teami_div_table tbody tr:last input").val("");
	$("span.numberlist:last").text(c);
})
		
$('.vName_teami_div_del').live('click', function() {
	var dis = $(this);
	custom_confirm('Delete Selected Record?', function(){
		if($('table#vName_teami_div_table tbody tr').length == 1) {
			custom_alert('Isi Minimal 1');
		}
		else {
			dis.parent().parent().remove();
		}
	})
})
	//end packdev
</script>
<style type="text/css">
	.ui-autocomplete { max-height: 200px; overflow-y: scroll; overflow-x: hidden;}
</style>
<div class="box-tambah">
	<div style="float: right"><button type="button" class="icon-tambah vName_teami_div_add">Tambah</button></div>
	<div class="clear"></div>
	<table style="width: 100%" id="vName_teami_div_table">
		<thead>
			<tr>
				<th style="width: 2%;"> No. </th>
				<th> Member </th>
				<th style="width: 10%;"> Action </th>
			</tr>
		</thead>
		<tbody>
			<?php
				if(isset($member)) {
					if(is_array($member) && count($member) > 0) {
						$n=1;
						foreach($member as $v) {
							
			?>
							<tr>
								<td style="text-align: right"><span class="numberlist"><?php echo $n; ?></span></td>
								<td style="text-align: center">
									<input class="vName_teami_div_cNip" value="<?php echo $v['vnip']; ?>" name="nip[]" type="hidden" >
									<input value="<?php echo $v['vName']; ?> - <?php echo $v['vnip']; ?>" class="input_rows-table vName_teami_div" style="width: 98%" name="name[]" type="text" ></td>
								<td style="text-align: center">[ <a href="javascript:;" class="vName_teami_div_del">Hapus</a> ]</td>
							</tr>
			<?php		$n++;}
					}
					else {
			?>
						<tr>
							<td style="text-align: right"><span class="numberlist">1</span></td>
							<td style="text-align: center">
								<input class="vName_teami_div_cNip" name="nip[]" type="hidden" >
								<input class="input_rows-table vName_teami_div" style="width: 98%" name="name[]" type="text" ></td>
							<td style="text-align: center">[ <a href="javascript:;" class="vName_teami_div_del">Hapus</a> ]</td>
						</tr>
			<?php
					}
				}
				else {
			?>
			<tr>
				<td style="text-align: right"><span class="numberlist">1</span></td>
				<td style="text-align: center">
					<input class="vName_teami_div_cNip" name="nip[]" type="hidden" >
					<input class="input_rows-table vName_teami_div" style="width: 98%" name="name[]" type="text" >
				</td>
				<td style="text-align: center">[ <a href="javascript:;" class="vName_teami_div_del">Hapus</a> ]</td>
			</tr>
			<?php
				}
			?>
		</tbody>
	</table>	
</div>