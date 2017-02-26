<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 * @author     Your Name <email@example.com>
 */
class Minigal_Nano_Wp_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $minigal_nano_wp;
	private $minigal_nano_wp_options =
	  	array(
			'gallery_width' => "100%",
			'templatefile' => "squares",
			// 'title' => "",
			// 'author' => "John Doe",
			'skip_objects' => [],
			'folder_color' => "black",
			'sorting_folders' => "name",
			'sorting_files' => "name",
			'sortdir_folders' => SORT_ASC,
			'sortdir_files' => SORT_ASC,
			'lazyload' => 1,
			'background_color_button_top' => "#000",
			'color_button_top' => "#FFF",
			//LANGUAGE STRINGS
			'label_home' => "Home",
			'label_noimages' => "No images... yet !",
			'label_noimages_advice' => "Use your FTP to upload some picture !",
			'label_loading' => "Loading...",
			'breadcrumb_separator' => ">",
			//ADVANCED SETTINGS
			'thumb_size' => 250,
			'label_max_length' => 40,
			'display_exif' => 0,
			'display_filename' => 0,
			'mediabox_css' => "mediaboxBlack",
		);
	private $thumbnails = "";
	private $messages = "";
	private $images = "";
	private $breadcrumb_navigation = "";
	private $comment = "";

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $minigal_nano_wp, $version ) {

		$this->minigal_nano_wp = $minigal_nano_wp;
		$this->version = $version;

		$minigal_nano_wp_filters_customize = get_option('minigal_nano_wp_filters_customize');
		$minigal_nano_wp_filters_settings = get_option('minigal_nano_wp_filters_settings');
		foreach ($minigal_nano_wp_filters_customize as $key => $value) {
			if ($value !== "") {
				$this->minigal_nano_wp_options[$key] = $value;
			}
		}
		if (isset($minigal_nano_wp_filters_settings)){
			foreach ($minigal_nano_wp_filters_settings as $key => $value) {
				if ($value !== "") {
					$this->minigal_nano_wp_options[$key] = $value;
				}
			}
		}

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->minigal_nano_wp, plugin_dir_url( __FILE__ ) . 'css/' . $this->minigal_nano_wp_options['mediabox_css']. '.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( "lazy", plugin_dir_url( __FILE__ ) . 'js/lazy.js', array( 'jquery' ), $this->version, 0 );
		wp_enqueue_script( "script_minigal", plugin_dir_url( __FILE__ ) . 'js/minigal-nano-wp-public.js', array( 'jquery' ), $this->version, 1 );
		wp_enqueue_script( "mootools", plugin_dir_url( __FILE__ ) . 'js/mootools1.5.0.js', array( 'jquery' ), $this->version, 0 );
		wp_enqueue_script( "mediabox", plugin_dir_url( __FILE__ ) . 'js/mediabox1.5.4.js', array( 'jquery' ), $this->version, 0 );

	}


  	public function minigal_nano_wp($atts = [], $content = null){
  		foreach ($atts as $key => $value) {
  			if (substr($value, 0, 1) == "/"){
  				$this->minigal_nano_wp_options['folder'] = $value;
  			}
  			if (substr($value, 0, 1) == "-"){
  				$this->minigal_nano_wp_options['skip_objects'][] = substr($value, 1);
  			}

  		}
//
  		// echo"<pre>";
		// var_export($minigal_nano_wp_options);
		// die();
  		// require_once(sprintf("%s/index.php", dirname(__FILE__)));
   		// $Minigal_nano_wp = new Minigal_nano_wp();
  		// $Minigal_nano_wp->display_minigal_nano();
		$this->display_minigal_nano();

  	}

	/**
	 * Registers all shortcodes at once
	 *
	 * @return [type] [description]
	 */
	public function register_shortcodes() {
		add_shortcode( 'minigal_nano_wp', array( $this, 'minigal_nano_wp' ) );
	} // register_shortcodes()

	public function padstring($name, $length) {
		// global $minigal_nano_wp_options['label_max_length'];
		if (!isset($length)) {
			$length = $this->minigal_nano_wp_options['label_max_length'];
		}
		if (strlen($name) > $length) {
			return substr($name, 0, $length) . "...";
		}
		$name = explode('.', $name);
		return ucfirst(str_replace('_', ' ', $name[0]));
	}

	public function getfirstImage($dirname) {
		$imageName = false;
		$extensions = array("jpg", "png", "jpeg", "gif");
		if ($handle = opendir($dirname)) {
			while (false !== ($file = readdir($handle))) {
				if ($file[0] == '.') {
					continue;
				}
				$pathinfo = pathinfo($file);
				if (empty($pathinfo['extension'])) {
					continue;
				}
				$ext = strtolower($pathinfo['extension']);
				if (in_array($ext, $extensions)) {
					$imageName = $file;
					break;
				}
			}
			closedir($handle);
		}
		return $imageName;
	}

	public function parse_fraction($v, $round = 0) {
		list($x, $y) = array_map('intval', explode('/', $v));
		if (empty($x) || empty($y)) {
			return $v;
		}
		if ($x % $y == 0) {
			return $x / $y;
		}
		if ($y % $x == 0) {
			return "1/" . $y / $x;
		}
		return round($x / $y, $round);
	}

	public function readEXIF($file) {
		$exif_arr = array();
		$exif_data = @exif_read_data($file);

		$exif_val = @$exif_data['Model'];
		if (!empty($exif_val)) {
			$exif_arr[] = $exif_val;
		}

		$exif_val = @$exif_data['FocalLength'];
		if (!empty($exif_val)) {
			$exif_arr[] = $this->parse_fraction($exif_val) . "mm";
		}

		$exif_val = @$exif_data['ExposureTime'];
		if (!empty($exif_val)) {
			$exif_arr[] = $this->parse_fraction($exif_val, 2) . "s";
		}

		$exif_val = @$exif_data['FNumber'];
		if (!empty($exif_val)) {
			$exif_arr[] = "f" . $this->parse_fraction($exif_val);
		}

		$exif_val = @$exif_data['ISOSpeedRatings'];
		if (!empty($exif_val)) {
			$exif_arr[] = "ISO " . $exif_val;
		}

		if (count($exif_arr) > 0) {
			return "::" . implode(" | ", $exif_arr);
		} else {
			return "";
		}
	}

	public function checkpermissions($file) {

		if (!is_readable($file)) {
			$this->messages = "At least one file or folder has wrong permissions. "
			. "Learn how to <a href='http://minigal.dk/faq-reader/items/"
			. "how-do-i-change-file-permissions-chmod.html' target='_blank'>"
			. "set file permissions</a>";
		}
	}

	public function guardAgainstDirectoryTraversal($path) {
	    $pattern = "/^(.*\/)?(\.\.)(\/.*)?$/";
	    $directory_traversal = preg_match($pattern, $path);

	    if ($directory_traversal === 1) {
	        die("ERROR: Could not open " . htmlspecialchars(stripslashes($path)) . " for reading! Please verify your shortcode");
	    }
	}

	// public function load_image_to_edit_path( $attachment_id, $size = 'full' ) {
	//     $filepath = get_attached_file( $attachment_id );
	//     if ( $filepath && file_exists( $filepath ) ) {
	//         if ( 'full' != $size && ( $data = image_get_intermediate_size( $attachment_id, $size ) ) ) {
	//             $filepath = apply_filters( 'load_image_to_edit_filesystempath', path_join( dirname( $filepath ), $data['file'] ), $attachment_id, $size );
	//         }
	//     } elseif ( function_exists( 'fopen' ) && function_exists( 'ini_get' ) && true == ini_get( 'allow_url_fopen' ) ) {
	//         $filepath = apply_filters( 'load_image_to_edit_attachmenturl', wp_get_attachment_url( $attachment_id ), $attachment_id, $size );
	//     }
	//     return apply_filters( 'load_image_to_edit_path', $filepath, $attachment_id, $size );
	// }

	// public function get_attachment_url_by_slug( $slug ) {
	//   $args = array(
	//     'post_type' => 'attachment',
	//     'name' => sanitize_title($slug),
	//     'posts_per_page' => 1,
	//     'post_status' => 'inherit',
	//   );
	//   $_header = get_posts( $args );
	//   $header = $_header ? array_pop($_header) : null;
	//   // var_dump(isset($header->guid) ? $header->guid : '');
	//   return isset($header->ID) ? $header->ID : '';
	// }

	public function display_minigal_nano(){

		$requestedDir = '';
		if (!empty($_GET['dir'])) {
			$requestedDir = $_GET['dir'];
		}
		$this->upload_dir = wp_upload_dir();
		$thumbdir = rtrim($this->upload_dir['basedir']. $this->minigal_nano_wp_options['folder'] . '/' . $requestedDir, '/');
		// var_dump($thumbdir);
		$current_dir = $thumbdir;

		$this->guardAgainstDirectoryTraversal($current_dir);
		//-----------------------
		// READ FILES AND FOLDERS
		//-----------------------
		$files = array();
		$dirs = array();
		$img_captions = array();
		if (is_dir($current_dir) && $handle = opendir($current_dir)) {

			// 1. LOAD CAPTIONS
			$caption_filename = "$current_dir/captions.txt";
			if (is_readable($caption_filename)) {
				$caption_handle = fopen($caption_filename, "rb");
				while (!feof($caption_handle)) {
					$caption_line = fgetss($caption_handle);
					if (empty($caption_line)) {
						continue;
					}
					list($img_file, $img_text) = explode('|', $caption_line);
					$img_captions[$img_file] = trim($img_text);
				}
				fclose($caption_handle);
			}
			while (false !== ($file = readdir($handle))) {
				// 2. LOAD FOLDERS
				$file_origin = $file;
				if (!in_array($file, $this->minigal_nano_wp_options['skip_objects'])){
					if (is_dir($current_dir . "/" . $file)) {
						if ($file != "." && $file != "..") {

							$this->checkpermissions($current_dir . "/" . $file); // Check for correct file permission

							// Set thumbnail to first image found (if any):
							unset($firstimage);
							$firstimage = $this->getfirstImage("$current_dir/" . $file);

							if ($firstimage != "") {
								$linkParams = http_build_query(
									array('dir' => ltrim("$requestedDir/$file", '/')),
									'',
									'&amp;'
								);
								$linkUrl = "?$linkParams";

								$imgParams = http_build_query(
									array(
										'filename' => "$thumbdir/$file/$firstimage",
										'size' => $this->minigal_nano_wp_options['thumb_size'],
										'upload_dir' => $this->upload_dir
									),
									'',
									'&amp;'
								);

								$imgUrl = plugin_dir_url( __FILE__ ) ."createthumb.php?$imgParams";

								$label_loading = $this->minigal_nano_wp_options['label_loading'];
								$dirs[] = array(
									"name" => $file,
									"date" => filemtime($current_dir . "/" . $file),
									"html" => "<li><a href=\"{$linkUrl}\"><em>" . $this->padstring($file, $this->minigal_nano_wp_options['label_max_length']) . "</em><span></span><img src=\"{$imgUrl}\"  alt='$label_loading' /></a></li>",
								);
							} else {
								// If no folder.jpg or image is found, then display default icon:
								$linkParams = http_build_query(
									array('dir' => ltrim("$requestedDir/$file", '/')),
									'',
									'&amp;'
								);
								$linkUrl = "?$linkParams";
								$imgUrl = plugin_dir_url( __FILE__ ) .  'images/folder_' . strtolower($this->minigal_nano_wp_options['folder_color']) . '.png';
								$thumb_size = $this->minigal_nano_wp_options['thumb_size'];
								$label_loading = $this->minigal_nano_wp_options['label_loading'];
								$dirs[] = array(
									"name" => $file,
									"date" => filemtime($current_dir . "/" . $file),
									"html" => "<li><a href=\"{$linkUrl}\"><em>" . $this->padstring($file, $this->minigal_nano_wp_options['label_max_length']) . "</em><span></span><img src=\"{$imgUrl}\" width='$thumb_size' height='$thumb_size' alt='$label_loading' /></a></li>",
								);
							}
						}
					}

					// 3. LOAD FILES
					if ($file != "." && $file != ".." && $file != "folder.jpg") {
						if ($this->minigal_nano_wp_options['display_filename']) {
							$filename_caption = "<em>" . $this->padstring($file, $this->minigal_nano_wp_options['label_max_length']) . "</em>";
						} else {
							$filename_caption = "";
						}

						// JPG, GIF and PNG
						if (preg_match("/.jpg$|.gif$|.png$/i", $file)) {
							//Read EXIF
							if (!array_key_exists($file, $img_captions)) {
								if ($this->minigal_nano_wp_options['display_exif'] == 1) {
									$exifReaden = $this->readEXIF($current_dir . "/" . $file);
									//Add to the caption all the EXIF information
									$img_captions[$file] = $file . $exifReaden;
								} else {
									//If no EXIF, just use the filename as caption
									$img_captions[$file] = $file;
								}
							}



							// Read the optionnal image title and caption in html file (image.jpg --> image.jpg.html)
							// Format: title::caption
							// Example: My cat::My cat like to <i>roll</i> on the floor.
							// If file is not provided, image filename will be used instead.
							$this->checkpermissions($current_dir . "/" . $file);

							if (is_file($current_dir . '/' . $file . '.html')) {
								$img_captions[$file] = $img_captions[$file] . '::' . htmlspecialchars(file_get_contents($current_dir . '/' . $file . '.html'), ENT_QUOTES);
							}

							if (isset($_GET['dir'])){
								$linkUrl = str_replace('%2F', '/', $this->upload_dir['baseurl'] . $this->minigal_nano_wp_options['folder'] . "/" .$_GET['dir'] . "/$file");
							} else {
								$linkUrl = str_replace('%2F', '/', $this->upload_dir['baseurl'] . $this->minigal_nano_wp_options['folder']  . "/$file");
							}
							// $file_name = explode('.', $file_origin);
							// $id_image = $this->get_attachment_url_by_slug($file_name[0]);
							// $image_output = $this->load_image_to_edit_path( $id_image, 'thumbnail');
							// if ($image_output){
								$imgParams = http_build_query(
									array(
										'filename' => "$thumbdir/$file",
										'size' => $this->minigal_nano_wp_options['thumb_size'],
										'upload_dir' => $this->upload_dir['basedir']
										),
									'',
									'&amp;'
								);



								$imgUrl = plugin_dir_url( __FILE__ ) . "createthumb.php?$imgParams";

								if ($this->minigal_nano_wp_options['lazyload']) {
									$imgopts = "class=\"b-lazy\" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src=\"$imgUrl\"";
								} else {
									$imgopts = "src=\"{$imgUrl}\"";
								}
								$label_loading = $this->minigal_nano_wp_options['label_loading'];
								$files[] = array(
									"name" => $file,
									"date" => filemtime($current_dir . "/" . $file),
									"size" => filesize($current_dir . "/" . $file),
									"html" => "<li><a href=\"{$linkUrl}\" rel='lightbox[billeder]' title=\"" . htmlentities($img_captions[$file]) . "\"><img $imgopts alt='$label_loading' />" . $filename_caption . "</a></li>");
							// }
						}
						// Other filetypes
						$extension = "";
						if (preg_match("/\.pdf$/i", $file)) {
							$extension = "PDF";
						}
						// PDF
						if (preg_match("/\.zip$/i", $file)) {
							$extension = "ZIP";
						}
						// ZIP archive
						if (preg_match("/\.rar$|\.r[0-9]{2,}/i", $file)) {
							$extension = "RAR";
						}
						// RAR Archive
						if (preg_match("/\.tar$/i", $file)) {
							$extension = "TAR";
						}
						// TARball archive
						if (preg_match("/\.gz$/i", $file)) {
							$extension = "GZ";
						}
						// GZip archive
						if (preg_match("/\.doc$|\.docx$/i", $file)) {
							$extension = "DOCX";
						}
						// Word
						if (preg_match("/\.ppt$|\.pptx$/i", $file)) {
							$extension = "PPTX";
						}
						//Powerpoint
						if (preg_match("/\.xls$|\.xlsx$/i", $file)) {
							$extension = "XLXS";
						}
						// Excel
						if (preg_match("/\.ogv$|\.mp4$|\.mpg$|\.mpeg$|\.mov$|\.avi$|\.wmv$|\.flv$|\.webm$/i", $file)) {
							$extension = "VIDEO";
						}
						// video files
						if (preg_match("/\.aiff$|\.aif$|\.wma$|\.aac$|\.flac$|\.mp3$|\.ogg$|\.m4a$/i", $file)) {
							$extension = "AUDIO";
						}
						// audio files

						if ($extension != "") {
							$current_dir_url = $this->upload_dir['baseurl'] . $this->minigal_nano_wp_options['folder'] . '/' . $requestedDir;
							$thums_size = $this->minigal_nano_wp_options['thumb_size'];
							$files[] = array(
								"name" => $file,
								"date" => filemtime($current_dir . "/" . $file),
								"size" => filesize($current_dir . "/" . $file),
								"html" => "<li><a href='$current_dir_url/$file' title='$file'><span></span><img src='" . plugin_dir_url( dirname( __FILE__ ) ) . "public/images/filetype_" . $extension . ".png' width='$thums_size' height='$thums_size' alt='$file' />$filename_caption</a></li>");
						}
					}
				}
			}
			closedir($handle);
		} else {
			die("ERROR: Could not open " . htmlspecialchars(stripslashes($current_dir)) . " for reading! Please verify your shortcode");
		}

		//-----------------------
		// SORT FILES AND FOLDERS
		//-----------------------
		if (sizeof($dirs) > 0) {
			foreach ($dirs as $key => $row) {
				if ($row["name"] == "") {
					unset($dirs[$key]); //Delete empty array entries
					continue;
				}
				$name[$key] = strtolower($row['name']);
				$date[$key] = strtolower($row['date']);
			}
			$sorting_folders = $this->minigal_nano_wp_options['sorting_folders'];
			@array_multisort($$sorting_folders, constant($this->minigal_nano_wp_options['sortdir_folders']), $name, constant($this->minigal_nano_wp_options['sortdir_folders']), $dirs);
		}

		if (sizeof($files) > 0) {
			foreach ($files as $key => $row) {
				if ($row["name"] == "") {
					unset($files[$key]); //Delete empty array entries
					continue;
				}
				$name[$key] = strtolower($row['name']);
				$date[$key] = strtolower($row['date']);
				$size[$key] = strtolower($row['size']);
			}

			$sorting_files = $this->minigal_nano_wp_options['sorting_files'];
			$sortdir_files = constant($this->minigal_nano_wp_options['sortdir_files']);
			@array_multisort($$sorting_files, $sortdir_files, $name, SORT_DESC, $files);
		}

		//-----------------------
		// OFFSET DETERMINATION
		//-----------------------
		if (!isset($_GET["page"])) {
			$_GET["page"] = 1;
		}

		$offset_start = 0;
		// $offset_start = ($_GET["page"] * $this->thumbs_pr_page) - $this->thumbs_pr_page;
		$offset_end = $offset_start + 10;
		// $offset_end = $offset_start + $this->thumbs_pr_page;
		if ($offset_end > sizeof($dirs) + sizeof($files)) {
			$offset_end = sizeof($dirs) + sizeof($files);
		}

		if ($_GET["page"] == "all" || $this->minigal_nano_wp_options['lazyload']) {
			$offset_start = 0;
			$offset_end = sizeof($dirs) + sizeof($files);
		}

		//-----------------------
		// BREADCRUMB NAVIGATION
		//-----------------------
		if ($requestedDir != "" && $requestedDir != "photos") {
			$this->breadcrumb_navigation = "<div class=\"NavWrapper\">";
			$label_home = $this->minigal_nano_wp_options['label_home'];
			$breadcrumb_separator = $this->minigal_nano_wp_options['breadcrumb_separator'];
			$this->breadcrumb_navigation .= "<a href='?dir='>" . $label_home . "</a> $breadcrumb_separator ";
			$navitems = explode("/", htmlspecialchars($_REQUEST['dir']));
			for ($i = 0; $i < sizeof($navitems); $i++) {
				if ($i == sizeof($navitems) - 1) {
					$this->breadcrumb_navigation .= $navitems[$i];
				} else {
					$this->breadcrumb_navigation .= "<a href='?dir=";
					for ($x = 0; $x <= $i; $x++) {
						$this->breadcrumb_navigation .= $navitems[$x];
						if ($x < $i) {
							$this->breadcrumb_navigation .= "/";
						}

					}
					$this->breadcrumb_navigation .= "'>" . $navitems[$i] . "</a> $this->breadcrumb_separator ";
				}
			}
			$this->breadcrumb_navigation .= "</div>";
		}

		//Include hidden links for all images BEFORE current page so lightbox is able to browse images on different pages
		for ($y = 0; $y < $offset_start - sizeof($dirs); $y++) {
			$breadcrumb_navigation .= "<a href='" . $current_dir . "/" . $files[$y]["name"] . "' class='hidden' title='" . $img_captions[$files[$y]["name"]] . "'></a>";
		}

		//-----------------------
		// DISPLAY FOLDERS
		//-----------------------
		if (count($dirs) + count($files) == 0) {
			$label_noimages = $this->minigal_nano_wp_options['label_noimages'];
			$label_noimages_advice = $this->minigal_nano_wp_options['label_noimages_advice'];
			$this->thumbnails .= "<div class=\"Empty\">$label_noimages</div> <div class=\"EmptyAdvice\">$label_noimages_advice</div>"; //Display 'no images' text
			// if ($current_dir == "photos") {
			// 	$this->messages =
			// 	"It looks like you have just installed MiniGal Nano.
		 //            Please run the <a href='system_check.php'>system check tool</a>. <br>
		 //            And why not have a look to config.php and customize some values ?";
			// }
		}
		$offset_current = $offset_start;
		for ($x = $offset_start; $x < sizeof($dirs) && $x < $offset_end; $x++) {
			$offset_current++;
			$this->thumbnails .= $dirs[$x]["html"];
		}

		//-----------------------
		// DISPLAY FILES
		//-----------------------
		for ($i = $offset_start - sizeof($dirs); $i < $offset_end && $offset_current < $offset_end; $i++) {
			if ($i >= 0) {
				$offset_current++;
				$this->thumbnails .= $files[$i]["html"];
			}
		}

		//Include hidden links for all images AFTER current page so lightbox is able to browse images on different pages
		if ($i < 0) {
			$i = 1;
		}

		for ($y = $i; $y < sizeof($files); $y++) {
			$this->page_navigation .= "<a href='" . $current_dir . "/" . $files[$y]["name"] . "'  class='hidden' title='" . $img_captions[$files[$y]["name"]] . "'></a>";
		}

		//-----------------------
		// OUTPUT MESSAGES
		//-----------------------
		if ($this->messages != "") {
			$this->messages = $this->messages . "<div><a id=\"closeMessage\" class=\"closeMessage\" href=\"#\"><img src=\"images/close.png\" /></a><div>";
		}

		// Read folder comment.
		$comment_filepath = $current_dir . $file . "/comment.html";
		if (file_exists($comment_filepath)) {
			$fd = fopen($comment_filepath, "r");
			$this->comment = "<div class=\"Comment\">" . fread($fd, filesize($comment_filepath)) . "</div>";
			fclose($fd);
		}

		//PROCESS TEMPLATE FILE
		$this->minigal_nano_wp_options['templatefile'] = plugin_dir_path( dirname( __FILE__ ) ) . "templates/" . $this->minigal_nano_wp_options['templatefile'] . ".html";
		if (!$fd = fopen($this->minigal_nano_wp_options['templatefile'], "r")) {
			echo "Template " . htmlspecialchars(stripslashes($this->minigal_nano_wp_options['templatefile'])) . " not found!";
			exit();
		} else {
			$gallery_width = $this->minigal_nano_wp_options['gallery_width'];
			$thumb_size = $this->minigal_nano_wp_options['thumb_size'];
			$background_color_button_top = $this->minigal_nano_wp_options['background_color_button_top'];
			$color_button_top = $this->minigal_nano_wp_options['color_button_top'];
			$template = fread($fd, filesize($this->minigal_nano_wp_options['templatefile']));
			fclose($fd);
			$template = stripslashes($template);
			// $template = preg_replace("/<% title %>/", $this->minigal_nano_wp_options['title'], $template);
			$template = preg_replace("/<% messages %>/", $this->messages, $template);
			// $template = preg_replace("/<% author %>/", $this->minigal_nano_wp_options['author'], $template);
			// $template = preg_replace("/<% gallery_root %>/", GALLERY_ROOT, $template);
			$template = preg_replace("/<% images %>/", "$this->images", $template);
			$template = preg_replace("/<% thumbnails %>/", "$this->thumbnails", $template);
			$template = preg_replace("/<% breadcrumb_navigation %>/", "$this->breadcrumb_navigation", $template);
			// $template = preg_replace("/<% page_navigation %>/", "$this->page_navigation", $template);
			$template = preg_replace("/<% folder_comment %>/", "$this->comment", $template);
			$template = preg_replace("/<% gallery_width %>/", "$gallery_width", $template);
			$template = preg_replace("/<% background_color_button_top %>/", "$background_color_button_top", $template);
			$template = preg_replace("/<% color_button_top %>/", "$color_button_top", $template);
			// $template = preg_replace("/<% thumb_size %>/", "$thumb_size", $template);
			echo "$template";
		}
	}


}
