<div title="监察权限管理" style="padding:10px">
    <form id="jcPri">
	  <table style="border:none;background: #fff;">
		<?php 
		$pt_tree = showlist::get_pt_tree();
		foreach($pt_tree as $key=>$item){ ?>
		<tr>
		<td><input type="checkbox" sptag="1" name="jcqxDep_<?php echo $item['father']['id']; ?>" value="<?php echo $item['father']['id']; ?>"/></td>
		<td colspan="3"><?php echo $item['father']['name']; ?></td></tr>
		<tr>
			<td></td>
			<td>
				<?php foreach($item['children'] as $sval){ ?>
				<div style="width:33%;float:left">
					<input type="checkbox" sptag="2" name="jcqxPart_<?php echo $item['father']['id']; ?>_<?php echo $sval['id']; ?>" value="<?php echo $sval['id']; ?>"/><?php echo $sval['name']; ?>
				</div>
				<?php } ?>
			</td>
		</tr>
		<?php
		} ?>
	  </table>
  </form>
</div>