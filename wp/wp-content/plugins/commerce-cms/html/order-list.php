<?php
/**
* Order LIST
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$customer_list_orders = get_customer_list_orders($limit=100);

?>

<section class="order-list container-fluid">

	<div class="spacer-20"></div>
	<?php foreach($customer_list_orders as $order) { ?>

	<div class="row single-order">
		<div class="col-4">
		<p class="id-order">đơn hàng <?= '#'.$order['ID']; ?></p>
		<p class="create-date">Ngày tạo: <?= date("d/m/Y",strtotime($order['date_created'])); ?></p>
		<p class="order-quantity mb-0">Số lượng: <?= $order['item_quantity'] ; ?></p>
		</div>
		<div class="col-3 align-self-center">
		<p class="order-status"><?=  ORDER_STATUS[$order['order_status']];  ?></p>
		</div>
		<div class="col-3 align-self-center">
		<p class="price"><?= currencyFormat($order['totals']); ?></p>
		</div>
		<div class="col-2 align-self-center">
		<a href="<?php echo get_permalink( get_page_by_path( 'order-detail' )).'?order-id='.$order['ID']; ?>" id="check-out" class="btn-clip btn-red">Xem chi tiết&nbsp;<i class="fas fa-chevron-right" style="color:white;"></i></a>
		</div>
	</div>
  	<div class="spacer-20"></div>
  <?php }?>

	
	<?php /*
  <div  class="row single-order">
    <div class="col-4">
	<p class="id-order">order #1hdbcn586jO</p>
	<p class="create-date">Ngay tao: 99/99/2022</p>
	<p class="order-quantity">quantity 01</p>
	</div>
	<div class="col-3 align-self-center">
	<p class="order-status checked">Đã thanh toán</p>
	</div>
	<div class="col-3 align-self-center">
	<p class="price">990.000.000đ</p>
	</div>
	<div class="col-2 align-self-center">
	<a href="<?php echo get_permalink( get_page_by_path( 'order-detail' )).'?id=1'; ?>" id="check-out" class="btn-clip btn-red">Xem chi tiet&nbsp<i class="fas fa-chevron-right" style="color:white;"></i></a>
	</div>
  </div> */ ?>
</section>