<?php echo "(Collection A-Z)";

$huruf_awalan = '';

?>
	<table>
<?php foreach ($anime as $key => $value): ?>

	<?php if (substr($value['title'], 0, 1) != $huruf_awalan): 
		$huruf_awalan = substr($value['title'], 0, 1);
		echo '<tr><td><strong>' . $huruf_awalan . '</strong></td></tr>';
	endif; ?>

		<tr class="border bg-light">
	<td><a class="ml-2"><?php echo $key+1; ?>.</a></td> <td><a href="<?php echo base_url('client/anime/'.$value['anime_parent_id']); ?>"><?php echo $value['title']; ?></a></td>
		</tr>
<?php endforeach ?>
	</table>
	