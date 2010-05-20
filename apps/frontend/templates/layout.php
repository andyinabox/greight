<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
		<script type="text/javascript" src="http://use.typekit.com/hlm0vlh.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
  </head>
  <body>

		<div id="Container">
			<div id="Header">
				<div id="logo"><a href="/">Greee</a></div>
				<ul id="MainNav">
					<li><a href="#">About</a></li>
					<li><a href="#">Plans</a></li>
					<li><a href="#">Lists</a></li>
					<li><a href="#">Stats</a></li>
				</ul>
				<div id="login"><a href="#">sign up</a> | <a href="#">login</a></div>
			</div>
			<div id="Main">
				<div id="Ads">
					<img src="" width="130" height="100" alt="Fusion Ads" />
					<p>Ad text goes here</p>
				</div>
				<div id="FlashCard">
					<?php include_partial('words/flashCard', array('content' => $sf_data->getRaw('sf_content')	)) ?>
					<!-- <div id="word-count"><strong>4</strong> of <strong>8</strong> words for today.</div>
										<div id="display-size"><a href="#">Larger</a> / <a href="#">Smaller</a> / <a href="#">Fullscreen</a></div>
										<div id="preferences"><a href="#">Lists</a> / <a href="#">Plan controls</a></div>
										<div id="controls"><a href="#">Show controls</a></div>
										<div id="content"><?php echo $sf_content ?></div> -->
				</div>
			</div>
			<div id="Footer">
			<?php include_partial('global/footer') ?>
			</div>
  </body>
</html>
