		<footer class="row">
			<div class="col">
				<p>&copy;2018 by Amir</p>
			</div>
		</footer>	
	<div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.shopping_modal').on('shown.bs.modal', function (e) {
				var rmv_btn = $('.remove_btn').siblings();
				jQuery.each(rmv_btn.prevObject, function(key,value){
					var rmv_btn_id = rmv_btn.prevObject[key].id;
					console.log(rmv_btn_id);
					$('#'+rmv_btn_id).on('click', function (){
						var parent = $('#'+rmv_btn_id).parents();
						parent[1].remove();
						var rmv_btn = rmv_btn_id.split('_');
						var rmv_btn_a = rmv_btn[2];
						$.ajax({
							url: 'http://localhost/vinyl/orders/cart',
							type: 'POST',
							data: {
								single_cart: 1,
								rmv_btn: rmv_btn_a								
							},
							success: function(response){
								var resp = JSON.parse(response);
								console.log(resp);
								var a = $('#cart_body').children().length;
								$('#cart_count').text(a);
								console.log(a);

								if (resp.cart_total) {
									console.log(resp.cart_total);
									$('#cart_foot').children().remove();
									var cart_total = "<tr><th>Total:</th><th></th><th></th><th></th><th id='total'>$&nbsp;"+resp.cart_total+"</th><th></th></tr>";
									$('#cart_foot').html(cart_total);
								} else {
									$('#total').remove();
								}											
							},
							dataType: 'text'
						});
					});
				});
			});
		});
	</script>
</body>
</html>