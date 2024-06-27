<?php
$total = $total_discount = 0;
?>
<html>
<head>
<title>Booking Order Success</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
	.svg-icon {
	  	width: 20px;
	  	height: 20px;
	  	margin-right: 10px;
	}
	.svg-icon path, .svg-icon polygon, .svg-icon rect {
	  	fill: #4691f6;
	}
	.svg-icon circle {
	  	stroke: #4691f6;
	  	stroke-width: 1;
	}
	.center-svg-content{
		display: flex;
	    flex-direction: row;
	    align-items: center;
	}
	.color-blue{
		color: #096cf1;
	}
	table{
		background-color: #f1f1f1;
		padding: 20px;
		line-height: 1.6;
	}
</style>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table id="Table_01" width="640" border="0" cellpadding="0" cellspacing="0" style="margin: auto;font-family: 'Montserrat', sans-serif;">
	<tr>
		<td>
			<div style="background-color: #ffffff;padding: 10px;border-radius: 6px; margin-bottom: 20px;">
				<p>
					<b>Cảm ơn Quý khách <?= $data['fullname'] ?> đã đặt hàng,</b><br>
					Revzone Yamaha Motor rất vui thông báo đơn hàng #<? $data['order_number'] ?> của Quý khách đã được ghi nhận thành công trên hệ thống và đang trong quá trình xử lý.
				</p>	

				<div>
					<p>
						<b>THÔNG TIN ĐƠN HÀNG #<?= $data['order_code']?></b> (Ngày 24 Tháng 09 Năm 2021 21:50:20)
					</p>
					<hr>
					<table style="width: 100%;">
						<thead>
							<td>
								<b>Thông tin thanh toán</b>
							</td>
							<td>
								<b>Địa chỉ giao hàng</b>
							</td>
						</thead>
						<tr>
							<td>
								<?= $data['fullname'] ?><br/>
								<?= $data['email'] ?><br/>
								<?= $data['phone'] ?>
							</td>
							<td>
								<?= $data['rec_fullname'] ?><br/>
								<?= $data['rec_address']?><br/>
								<?= $data['rec_phone']?>
							</td>
						</tr>
					</table>
					<p>
						<b>Phương thức thanh toán:</b> <?= $data['payment_method'] ?><br/>
						<!-- <b>Thời gian giao hàng dự kiến:</b> Dự kiến giao hàng Thứ ba, 12/10 - không giao ngày Chủ Nhật<br/> -->
						<b>Phí vận chuyển:</b> <?= $data['shipping_fee'] ?>đ
					</p>
				</div>

				<div>
					<p><b>CHI TIẾT THANH TOÁN</b></p>
					<hr>
					<table style="width: 100%;">
						<thead style=" background-color: #44c9ed; color: #ffffff;">
							<td>Sản phẩm</td>
							<td>Đơn giá</td>
							<td>Số lượng</td>
							<td>Giảm giá</td>
							<td>Tổng tạm</td>
						</thead>

						<?php foreach ($data['details_order'] as $key => $item_details_order) { ?>
							<tr>
								<td>
									Đơn hàng #<?= $item_details_order['order']->ID ?>
								</td>
								<td>
									
								</td>
								<td>
								</td>
								<td><?= $item_details_order['order']->discount?currencyFormat($item_details_order['order']->discount):'' ?></td>
								<td>
									<?= currencyFormat($item_details_order['order']->order_total) ?>
								</td>
							</tr>
							<?php foreach ($item_details_order['detail'] as $key => $item_details_order_detail) { ?>
								<tr>
									<td style="padding-left: 10px;"><?= $item_details_order_detail->product_name ?></td>
									<td>
										<?= currencyFormat($item_details_order_detail->price) ?>
									</td>
									<td><?= $item_details_order_detail->quantity ?></td>
									<td>
									</td>
									<td><?= currencyFormat($item_details_order_detail->price * $item_details_order_detail->quantity) ?></td>
								</tr>
							<?php } ?>	
						<?php } ?>						

						<tr>
							<td colspan="4">Tổng giảm giá</td>
							<td><?= currencyFormat($data['discount']) ?></td>
						</tr>
						<tr>
							<td colspan="4">Phí vận chuyển</td>
							<td><?= currencyFormat($data['shipping_fee']) ?></td>
						</tr>
						<tr>
							<td colspan="4"><b>Tổng giá trị đơn hàng</b></td>
							<td><?= currencyFormat($data['order_sum']->order_total);  ?></td>
						</tr>
					</table>
				</div>

				<p>
					<center>
						<a style="padding:10px 20px;background-color:red;color: #ffffff; text-decoration: none;"  href="<?= $data['order_url'] ?>">Theo dõi đơn hàng</a>
					</center>
				</p>
				<p>
					Mọi thắc mắc và góp ý, Quý khách vui lòng liên hệ với Revzone Yamaha Motor qua email: <a href="mailto:xxx @yamaha-motor.com.vn">xxx @yamaha-motor.com.vn</a>. Đội ngũ Revzone Yamaha Motor luôn sẵn sàng hỗ trợ Quý khách.
				</p>
				<p>
					<b>Một lần nữa Revzone Yamaha Motor cảm ơn Quý khách.</b>
				</p>
				<p>
					Trân trọng.
				</p>
			</div>


		</td>		
	</tr>
	<tr>
		<td>
			<div class="color-blue">
				<div>
					Quý khách nhận được email này vì đã đăng ký tài khoản tại website <a href="www.revzoneyamaha-motor.com.vn" href="_blank">www.revzoneyamaha-motor.com.vn</a>
				</div>
				<div>Văn phòng Revzone Yamaha Motor:</div>
				<div class="center-svg-content">
					<svg class="svg-icon">
						<path d="M10,1.375c-3.17,0-5.75,2.548-5.75,5.682c0,6.685,5.259,11.276,5.483,11.469c0.152,0.132,0.382,0.132,0.534,0c0.224-0.193,5.481-4.784,5.483-11.469C15.75,3.923,13.171,1.375,10,1.375 M10,17.653c-1.064-1.024-4.929-5.127-4.929-10.596c0-2.68,2.212-4.861,4.929-4.861s4.929,2.181,4.929,4.861C14.927,12.518,11.063,16.627,10,17.653 M10,3.839c-1.815,0-3.286,1.47-3.286,3.286s1.47,3.286,3.286,3.286s3.286-1.47,3.286-3.286S11.815,3.839,10,3.839 M10,9.589c-1.359,0-2.464-1.105-2.464-2.464S8.641,4.661,10,4.661s2.464,1.105,2.464,2.464S11.359,9.589,10,9.589"></path>
					</svg> Số 6 Tân Trào, Phường Tân Phú, Quận 7, Thành phố Hồ Chí Minh, Việt Nam
				</div>
				<div class="center-svg-content">
					<svg class="svg-icon" viewBox="0 0 20 20">
						<path d="M13.372,1.781H6.628c-0.696,0-1.265,0.569-1.265,1.265v13.91c0,0.695,0.569,1.265,1.265,1.265h6.744c0.695,0,1.265-0.569,1.265-1.265V3.045C14.637,2.35,14.067,1.781,13.372,1.781 M13.794,16.955c0,0.228-0.194,0.421-0.422,0.421H6.628c-0.228,0-0.421-0.193-0.421-0.421v-0.843h7.587V16.955z M13.794,15.269H6.207V4.731h7.587V15.269z M13.794,3.888H6.207V3.045c0-0.228,0.194-0.421,0.421-0.421h6.744c0.228,0,0.422,0.194,0.422,0.421V3.888z"></path>
					</svg> <a href="tel:0901 33 53 53">0901 33 53 53</a>
				</div>
				<div class="center-svg-content">
					<svg class="svg-icon">
						<path d="M17.388,4.751H2.613c-0.213,0-0.389,0.175-0.389,0.389v9.72c0,0.216,0.175,0.389,0.389,0.389h14.775c0.214,0,0.389-0.173,0.389-0.389v-9.72C17.776,4.926,17.602,4.751,17.388,4.751 M16.448,5.53L10,11.984L3.552,5.53H16.448zM3.002,6.081l3.921,3.925l-3.921,3.925V6.081z M3.56,14.471l3.914-3.916l2.253,2.253c0.153,0.153,0.395,0.153,0.548,0l2.253-2.253l3.913,3.916H3.56z M16.999,13.931l-3.921-3.925l3.921-3.925V13.931z"></path>
					</svg> <a href="mailto:xxx@yamaha-motor.com.vn">xxx@yamaha-motor.com.vn</a>
				</div>
				<div>Email này được gửi tự động và không nhận trả lời</div>
			</div>		
		</td>		
	</tr>


</table>
</body>
</html>


