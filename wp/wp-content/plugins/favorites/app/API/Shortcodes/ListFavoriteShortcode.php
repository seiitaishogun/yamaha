<?php 
namespace Favorites\API\Shortcodes;

class ListFavoriteShortcode 
{
	/**
	* Shortcode Options
	* @var array
	*/
	private $options;

	public function __construct()
	{
		add_shortcode('favorite_list', [$this, 'renderView']);
	}

	/**
	* Shortcode Options
	*/
	private function setOptions($options)
	{
		$this->options = shortcode_atts([
			'user_id' => null,
			'site_id' => null,
			'include_links' => false,
			'filters'=>null,
			'include_button'=>false,
			'include_thumbnails'=>true,
			'thumbnail_size'=>'thumbnail',
			'include_excerpt'=>false,
		], $options);
	}

	/**
	* Render the List Favorites
	* @param $options, array of shortcode options
	*/
	public function renderView($options)
	{
		$this->setOptions($options);
		
		//get_user_favorites_list($user_id = null, $site_id = null, $include_links = false, $filters = null, $include_button = false, $include_thumbnails = false, $thumbnail_size = 'thumbnail', $include_excerpt = false);
			
		return get_user_favorites_list($this->options['user_id'], $this->options['site_id'], $this->options['include_links'], $this->options['filters'], $this->options['include_button'], $this->options['include_thumbnails'], $this->options['thumbnail_size'], $this->options['include_excerpt']);
	}
}