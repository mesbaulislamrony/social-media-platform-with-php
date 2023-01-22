<?php
if (isset($_SESSION['flash'])) {
$style = '#DDD';
if ($_SESSION['flash']['type'] == 'error') {
	$style = '#FF0000';
} 
if ($_SESSION['flash']['type'] == 'success') {
	$style = '#008000';
} 
?>
<div id="alert" style="background-color: <?php echo $style; ?>; color: #FFF">
	<p style="text-transform: capitalize;"><strong><?php echo $_SESSION['flash']['type']; ?></strong></p>
	<p><?php echo $_SESSION['flash']['message'];?></p>
	<button type="button" onclick="removeAlert()" style="float: right;">OK</button>
</div>
<?php
unset($_SESSION['flash']);
}
?>
</body>
<script type="text/javascript">
function removeAlert(){
    document.getElementById('alert').remove();
}
$(document).ready(function(){
	$('#messages').scrollTop($('#messages')[0].scrollHeight);
    // $("#form").on("submit", function(event){
    //     event.preventDefault(); 
    //     $.post('server.php',$("#form").serialize());
    // });
});
</script>
</html>
