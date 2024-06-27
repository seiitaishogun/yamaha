<?php
/**
* Primary plugin API functions
*/

use Favorites\Entities\Favorite\FavoriteButton;
use Favorites\Entities\Post\FavoriteCount;
use Favorites\Entities\User\UserFavorites;
use Favorites\Entities\Post\PostFavorites;
use Favorites\Entities\Favorite\ClearFavoritesButton;

//$current_user = wp_get_current_user();



/* LOAD Wishlist button*/
function load_wishlist_button($post_id=0)
{
	if($post_id==0) $post_id = get_queried_object_id();
	
	echo get_wishlist_button($post_id, $site_id = null, $group_id = null);
	echo '<style>.simplefavorite-button.btn-clip.btn-border-red::after, .simplefavorite-link.btn-clip.btn-border-red::after{display: none;} .simplefavorite-button.btn-clip, .simplefavorite-link.btn-clip{line-height:40px; padding: 7px 9px !important;  width:45px !important; height:45px; border-radius:100%;  min-width:45px !important;border:0px solid !important; }
	.simplefavorite-button.preset i, .simplefavorite-link i, .simplefavorite-button i { position: relative;font-size: 1.6em;left: 0;}</style>';
	 
}

function load_unwishlist_button($post_id=0)
{
	if($post_id==0) $post_id = get_queried_object_id();
	
	//echo get_wishlist_button($post_id, $site_id = null, $group_id = null);
	echo '<button class="btn-remove-wishlist item border-0" data-id="'.$post_id.'"><img class="align-baseline" src="'.get_template_directory_uri().'/img/ic_close.svg" alt=""></button>';
	echo '<style>.btn-remove-wishlist{position:absolute;top: 5px;right: 6px;}</style>';
	 
}

add_action('wp_ajax_load_unwishlist_button', 'load_unwishlist_button'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_load_unwishlist_button', 'load_unwishlist_button'); // wp_ajax_nopriv_{action}

/** AJAX LOAD user wishlist count */
function load_user_wishlist_count(){
	
	echo get_user_favorites_count($user_id = null, $site_id = null, $filters = null, $html = true);
}
add_action('wp_ajax_load_user_wishlist_count', 'load_user_wishlist_count'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_load_user_wishlist_count', 'load_user_wishlist_count'); // wp_ajax_nopriv_{action}
 

/** AJAX LOAD wishlist */
function load_wishlist_handler()
{
	global $wishlist_count;
	
    $us_wishlist = get_user_favorites($user_id = null, $site_id = null, $filters = null);

	/*if(!isset($_COOKIE['simplefavorite'])) {
		$cookie = json_decode(stripslashes($_COOKIE['simplefavorites']), true);
	}  */
 
	if ($us_wishlist) : $wishlist_count = count($us_wishlist); ?>
		<div class="container-fluid my-wishlist">
		<?php 
			$posts = $us_wishlist ;

			foreach ($posts as $k => $item) :
		
				$group = get_field("feature_product", $item);
				$group1 = get_field("list_image", $item ); 
				$postType = get_post_type($item);
				//print_r($group1[0]['image'][0]['sizes']);
	
				if(isset($group['feature_price']))
					$price = $group['feature_price'];
				else 
					$price = get_field("price", $item );
	
				if(isset($group['feature_img'])){
					$feature_img = $group['feature_img'];
				}else{
					if(isset($group1)){							 
						$feature_img = $group1[0]['image'][0]['sizes']['thumbnail'];
					}
				}
				if($postType == 'package'){
					$feature_img = get_field("image", $item);
				}
	
				$price_old = intval(str_replace(".","",get_field("price_old", $item )));
				$deposit = intval(str_replace(".","",get_field("deposit", $item )));
				$price_old = intval(str_replace(".","", $price_old));
				$deposit = intval(str_replace(".","", $deposit));
				?>
				<div class="row product-item mt-3 pb-2 pt-2" data-id="<?php echo $item; ?>"  data-title="<?php echo get_the_title($item)?>">
					<div class="col-lg-2 px-5 pt-1 text-center">
						<img src="<?php echo $feature_img; ?>" alt="<?php echo get_the_title($item)?>">
					</div><?php //echo  $item; ?>
					<div class="col-lg-5 align-self-center" data-id="<?php echo $item; ?>">
						<p class="name-product mb-2"><?php echo get_the_title($item); ?></p>
						<a href="<?php echo get_permalink($item) ?>" alt="<?php echo get_the_title($item) ?>" class="view-detail hide-mobile"><strong>Xem chi tiết<i class="fas fa-chevron-right ml-2" style="color: #FF0000;"></i></strong></a>
					</div>
					<div class="col-lg-5 align-self-center text-right" style="padding-right: 82px;">
						
						<?php if($postType=='bike' || $postType == 'product'){ if($deposit<=0) $deposit = 10000000; ?>
							<?php if($deposit>0){ ?>
							 <p class="sub-total-product mb-0"><?= currencyFormat($deposit); ?></p>
							 <?php } ?>
							<p class="deposit">(Giá niêm yết: <?php echo currencyFormat($price); ?>)</p>
						<?php } else { ?>
								<p class="sub-total-product mb-0"><span class="price"><?php echo currencyFormat($price); ?> </p>
						<?php } ?>

						<?php if($price_old>0){ ?>
						 <span class="fnt-oswald colorLGray price-old"><?php echo currencyFormat($price_old); ?></span> 
						 <?php } ?> 
					</div>
					<div class="hide-pc view-detail-mb">
						<a href="<?php echo get_permalink($item) ?>" alt="<?php echo get_the_title($item) ?>" class="btn-clip btn-border-red"><strong>Xem chi tiết</strong></a>
						
					</div>
					<?php echo load_unwishlist_button($item);?>
				</div>
			 <?php endforeach; ?> 
		  </div>
		  
	<?php else: ?>
		<div class="box-shadow03rem" style="text-align: center; padding: 50px 20px;">
			<div>Bạn chưa thêm sản phẩm yêu thích nào</div><br/>
			<a class="readmore-link btn-clip btn-red" href="<?= get_site_url() ?>">QUAY VỀ TRANG CHỦ</a>
		</div> 
	<?php endif; ?>
<?php 
     
}

add_action('wp_ajax_load_wishlist', 'load_wishlist_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_load_wishlist', 'load_wishlist_handler'); // wp_ajax_nopriv_{action}
 

/**
* Get the favorite button
* @param $post_id int, defaults to current post
* @param $site_id int, defaults to current blog/site
* @return html
*/
function get_favorites_button($post_id = null, $site_id = null, $group_id = null)
{
	global $blog_id;
	if ( !$post_id ) $post_id = get_the_id();
	if ( !$group_id ) $group_id = 1;
	$site_id = ( is_multisite() && is_null($site_id) ) ? $blog_id : $site_id;
	if ( !is_multisite() ) $site_id = 1;
	$button = new FavoriteButton($post_id, $site_id);
	return $button->display();
}

function get_wishlist_button($post_id = null, $site_id = null, $group_id = null){
	
	$bt_html = get_favorites_button($post_id, $site_id, $group_id);
	$bt_html = str_replace("simplefavorite-button", "simplefavorite-button btn-clip btn-border-red", $bt_html);
	$bt_html = str_replace("simplefavorite-link", "simplefavorite-link btn-clip btn-border-red", $bt_html);
	$bt_html = str_replace("btn-clip btn-border-red-count", "red-count", $bt_html);
	 
	return($bt_html);
}


/**
* Echos the favorite button
* @param $post_id int, defaults to current post
* @param $site_id int, defaults to current blog/site
* @return html
*/
function the_favorites_button($post_id = null, $site_id = null, $group_id = null)
{	
	echo get_favorites_button($post_id, $site_id, $group_id);
}


/**
* Get the Favorite Total Count for a Post
* @param $post_id int, defaults to current post
* @param $site_id int, defaults to current blog/site
* @param $html bool, whether to return html (returns simple integer if false)
* @return html
*/
function get_favorites_count($post_id = null, $site_id = null, $html = true)
{
	global $blog_id;
	$site_id = ( is_multisite() && is_null($site_id) ) ? $blog_id : $site_id;
	if ( !$post_id ) $post_id = get_the_id();
	$count = new FavoriteCount();
	$count = $count->getCount($post_id, $site_id);
	$out = "";
	if ( $html ) $out .= '<span data-favorites-post-count-id="' . $post_id . '" data-siteid="' . $site_id . '">';
	$out .= $count;
	if ( $html ) $out .= '</span>';
	return $out;
}


/**
* Echo the Favorite Count
* @param $post_id int, defaults to current post
* @param $site_id int, defaults to current blog/site
* @return html
*/
function the_favorites_count($post_id = null, $site_id = null, $html = true)
{
	echo get_favorites_count($post_id, $site_id, $html);
}


/**
* Get an array of User Favorites
* @param $user_id int, defaults to current user
* @param $site_id int, defaults to current blog/site
* @param $filters array of post types/taxonomies
* @return array
*/
function get_user_favorites($user_id = null, $site_id = null, $filters = null)
{
	global $blog_id;
	$site_id = ( is_multisite() && is_null($site_id) ) ? $blog_id : $site_id;
	if ( !is_multisite() ) $site_id = 1;
	$favorites = new UserFavorites($user_id, $site_id, $links = false, $filters);
	return $favorites->getFavoritesArray();
}


/**
* HTML List of User Favorites
* @param $user_id int, defaults to current user
* @param $site_id int, defaults to current blog/site
* @param $filters array of post types/taxonomies
* @param $include_button boolean, whether to include the favorite button for each item
* @param $include_thumbnails boolean, whether to include the thumbnail for each item
* @param $thumbnail_size string, the thumbnail size to display
* @param $include_excpert boolean, whether to include the excerpt for each item
* @return html
*/
function get_user_favorites_list($user_id = null, $site_id = null, $include_links = false, $filters = null, $include_button = false, $include_thumbnails = false, $thumbnail_size = 'thumbnail', $include_excerpt = false)
{
	global $blog_id;
	$site_id = ( is_multisite() && is_null($site_id) ) ? $blog_id : $site_id;
	if ( !is_multisite() ) $site_id = 1;
	$favorites = new UserFavorites($user_id, $site_id, $include_links, $filters);
	return $favorites->getFavoritesList($include_button, $include_thumbnails, $thumbnail_size, $include_excerpt);
}


/**
* Echo HTML List of User Favorites
* @param $user_id int, defaults to current user
* @param $site_id int, defaults to current blog/site
* @param $filters array of post types/taxonomies
* @param $include_button boolean, whether to include the favorite button for each item
* @param $include_thumbnails boolean, whether to include the thumbnail for each item
* @param $thumbnail_size string, the thumbnail size to display
* @param $include_excpert boolean, whether to include the excerpt for each item
* @return html
*/
function the_user_favorites_list($user_id = null, $site_id = null, $include_links = false, $filters = null, $include_button = false, $include_thumbnails = false, $thumbnail_size = 'thumbnail', $include_excerpt = false)
{
	echo get_user_favorites_list($user_id, $site_id, $include_links, $filters, $include_button, $include_thumbnails, $thumbnail_size, $include_excerpt);
}


/**
* Get the number of posts a specific user has favorited
* @param $user_id int, defaults to current user
* @param $site_id int, defaults to current blog/site
* @param $filters array of post types/taxonomies
* @param $html boolean, whether to output html (important for AJAX updates). If false, an integer is returned
* @return int
*/
function get_user_favorites_count($user_id = null, $site_id = null, $filters = null, $html = false)
{
	$favorites = get_user_favorites($user_id, $site_id, $filters);
	$posttypes = ( isset($filters['post_type']) ) ? implode(',', $filters['post_type']) : 'all';
	$count = ( isset($favorites[0]['site_id']) ) ? count($favorites[0]['posts']) : count($favorites);
	$out = "";
	if ( !$site_id ) $site_id = 1;
	if ( $html ) $out .= '<span class="simplefavorites-user-count" data-posttypes="' . $posttypes . '" data-siteid="' . $site_id . '">';
	$out .= $count;
	if ( $html ) $out .= '</span>';
	return $out;
}


/**
* Print the number of posts a specific user has favorited
* @param $user_id int, defaults to current user
* @param $site_id int, defaults to current blog/site
* @param $filters array of post types/taxonomies
* @return html
*/
function the_user_favorites_count($user_id = null, $site_id = null, $filters = null)
{
	echo get_user_favorites_count($user_id, $site_id, $filters);
}


/**
* Get an array of users who have favorited a post
* @param $post_id int, defaults to current post
* @param $site_id int, defaults to current blog/site
* @param $user_role string, defaults to all
* @return array of user objects
*/
function get_users_who_favorited_post($post_id = null, $site_id = null, $user_role = null)
{
	$users = new PostFavorites($post_id, $site_id, $user_role);
	return $users->getUsers();
}


/**
* Get a list of users who favorited a post
* @param $post_id int, defaults to current post
* @param $site_id int, defaults to current blog/site
* @param $separator string, custom separator between items (defaults to HTML list)
* @param $include_anonmyous boolean, whether to include anonmyous users
* @param $anonymous_label string, label for anonymous user count
* @param $anonymous_label_single string, singular label for anonymous user count
* @param $user_role string, defaults to all
*/
function the_users_who_favorited_post($post_id = null, $site_id = null, $separator = 'list', $include_anonymous = true, $anonymous_label = 'Anonymous Users', $anonymous_label_single = 'Anonymous User', $user_role = null)
{
	$users = new PostFavorites($post_id, $site_id, $user_role);
	echo $users->userList($separator, $include_anonymous, $anonymous_label, $anonymous_label_single);
}

/**
 * Get the number of anonymous users who favorited a post
 * @param  $post_id int Defaults to current post
 * @return int Just anonymous users
 */
function get_anonymous_users_who_favourited_post( $post_id = null ) {
	$user = new PostFavorites( $post_id );
	return $users->anonymousCount();
}

/**
 * Echo the number of anonymous users who favorited a post
 * @param  $post_id int Defaults to current post
 * @return string Just anonymous users
 */
function the_anonymous_users_who_favourited_post( $post_id = null ) {
	echo get_anonymous_users_who_favourited_post( $post_id );
}

/**
* Get the clear favorites button
* @param $site_id int, defaults to current blog/site
* @param $text string, button text - defaults to site setting
* @return html
*/
function get_clear_favorites_button($site_id = null, $text = null)
{
	$button = new ClearFavoritesButton($site_id, $text);
	return $button->display();
}


/**
* Print the clear favorites button
* @param $site_id int, defaults to current blog/site
* @param $text string, button text - defaults to site setting
* @return html
*/
function the_clear_favorites_button($site_id = null, $text = null)
{
	echo get_clear_favorites_button($site_id, $text);
}

/**
* Get the total number of favorites, for all posts and users
* @param $site_id int, defaults to current blog/site
* @return html
*/
function get_total_favorites_count($site_id = null)
{
	$count = new FavoriteCount();
	return $count->getAllCount($site_id);
}

/**
* Print the total number of favorites, for all posts and users
* @param $site_id int, defaults to current blog/site
* @return html
*/
function the_total_favorites_count($site_id = null)
{
	echo get_total_favorites_count($site_id);
}