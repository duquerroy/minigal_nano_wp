<div class="clearfix">
	<div class="">
		<h3><?php _e('How to use Minigal Nano Wp', 'minigal-nano-wp'); ?></h3>
		<p><?php _e('This plugin doesn\'t use Wordpress default gallery.', 'minigal-nano-wp'); ?></p>
		<ol>
			<li>
				<p><?php _e('Upload your photos with FTP in a folder in /wp-content/uploads', 'minigal-nano-wp'); ?></p>
				<pre><code><?php _e('Example', 'minigal-nano-wp') ?>: /wp-content/uploads/portfolio</code></pre>
				<pre><code>/wp-content/uploads/portfolio/ad</code></pre>
				<pre><code>/wp-content/uploads/portfolio/project</code></pre>
				<pre><code>/wp-content/uploads/portfolio/creation</code></pre>
			</li>
			<li>
				<p><?php _e('Use shortcode in a page like this to display all sub folder', 'minigal-nano-wp'); ?></p>
				<pre><code>[minigal_nano_wp /portfolio]</pre></code>
			</li>

			<li>
				<p><?php _e('If you have many sub folder, you can remove one with', 'minigal-nano-wp'); ?></p>
				<pre><code>[minigal_nano_wp /portfolio -creation]</code></pre>
			</li>
		</ol>


		<h4><?php _e('Adding a comment to a gallery', 'minigal-nano-wp') ?></h4>
	    <p><?php _e("Simple create comment.html in the gallery's folder.", "minigal-nano-wp") ?> </p>
		<h4><?php _e('Adding a comment to an image', 'minigal-nano-wp') ?></h4>
	    <p><?php _e("Create an html file. Filename must be the image filename plus .html. (eg. myimage.jpg -> myimage.jpg.html)", "minigal-nano-wp") ?></p>
	    <p><?php _e("The html file can contain:", "minigal-nano-wp") ?> </p>
	        <pre><code>comment</code></pre></code></pre>
			<pre><code>title::comment</code></pre>

		<h4><?php _e('How does file captions work?', 'minigal-nano-wp') ?></h4>

		<p><?php _e("Create a file called captions.txt in the same subfolder to /photos as your image(s). To bind a comment to a photo, captions.txt must contain this structure:", "minigal-nano-wp") ?> </p>

			<pre><code>image1.jpg|Caption<br>image2.jpg|Caption 2</code></pre>

			<p><?php _e("etc...", "minigal-nano-wp") ?> </p>

			<p><?php _e("But remember: captions.txt MUST be placed in the same folder as the image you want to comment!", "minigal-nano-wp") ?> </p>

		<h4><?php _e('Thumbnails', 'minigal-nano-wp') ?></h4>
		<p><?php _e('You do not have to care about thumbnails: They are automatically created in the thumbs directory. If some thumbnails are wrong, you can purge this directory: Thumbnails will be automatically re-created.', 'minigal-nano-wp'); ?> </p>
		<h4><?php _e('Customisation', 'minigal-nano-wp') ?></h4>
		<p><?php _e('If you need further customisation, you can create your own template. Start by duplicating one of the existing templates in the templates directory (/wp-content/plugins/minigal-nano-wp/templates/), then alter the CSS (which is included in the HTML file).', 'minigal-nano-wp'); ?> </p>
		<h4><?php _e('Mediabox', 'minigal-nano-wp') ?></h4>
		<p><?php _e('Mediabox is desactivated for width screen < 451 px', 'minigal-nano-wp'); ?> </p>
	</div>
</div>